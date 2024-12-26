<?php
require_once("../pdo-config-ts.php");

// Define database connection variables
$servername = DBHOST;
$username = DBUSER;
$password = DBPASS;
$dbname = DBNAME;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create cresults table if not exists
$sql = "CREATE TABLE IF NOT EXISTS cresults (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    reg_id INT(6) UNSIGNED NOT NULL,
    year VARCHAR(255) NOT NULL,
    semester VARCHAR(255) NOT NULL,
    data JSON NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
    exit;
}

// Check if JSON data is posted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Decode the JSON data from the request
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data);

    // Check if JSON decoding was successful
    if ($data === null) {
        echo "Error: JSON decoding failed";
        exit;
    }

    // Extract data
    $reg_id = $data->reg_id;
    $year = $data->year;
    $semester = $data->semester;
    $data_json = json_encode($data->data);

    // Check if a row with the same reg_id, year, and semester exists
    $sql = "SELECT id FROM cresults WHERE reg_id = ? AND year = ? AND semester = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("iss", $reg_id, $year, $semester);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;

    $stmt->close();

    // If a row exists, update the data; otherwise, insert new data
    if ($num_rows > 0) {
        $sql = "UPDATE cresults SET data = ? WHERE reg_id = ? AND year = ? AND semester = ?";
    } else {
        $sql = "INSERT INTO cresults (reg_id, year, semester, data) VALUES (?, ?, ?, ?)";
    }

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    if ($num_rows > 0) {
        $stmt->bind_param("siss", $data_json, $reg_id, $year, $semester);
    } else {
        $stmt->bind_param("isss", $reg_id, $year, $semester, $data_json);
    }

    if ($stmt->execute() === TRUE) {
        echo "Data " . ($num_rows > 0 ? "updated" : "inserted") . " successfully";
    } else {
        echo "Error " . ($num_rows > 0 ? "updating" : "inserting") . " data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
