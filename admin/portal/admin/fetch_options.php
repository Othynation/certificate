<?php
// Include your database configuration file or establish a database connection here
require_once("../pdo-config-ts.php");

// Check if the type parameter is set in the GET request
if (isset($_GET['type'])) {
    // Get the requested type from the GET request
    $type = $_GET['type'];

    // Initialize an empty variable to store the HTML options
    $optionsHtml = '';

    // Connect to your database
    $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database based on the requested type
    switch ($type) {
        case 'year':
            // Fetch options for year from the cyear table
            $sql = "SELECT * FROM cyear";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Loop through the results and format them into HTML options
                while ($row = $result->fetch_assoc()) {
                    $optionsHtml .= '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
                }
            }
            break;
        case 'semester':
            // Fetch options for semester from the csemester table
            $sql = "SELECT * FROM csemester";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Loop through the results and format them into HTML options
                while ($row = $result->fetch_assoc()) {
                    $optionsHtml .= '<option value="' . $row['semester'] . '">' . $row['semester'] . '</option>';
                }
            }
            break;
        case 'subject':
            // Fetch options for subject from the csubject table
            $sql = "SELECT * FROM csubject";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Loop through the results and format them into HTML options
                while ($row = $result->fetch_assoc()) {
                    $optionsHtml .= '<option value="' . $row['subject'] . '">' . $row['subject'] . '</option>';
                }
            }
            break;
        default:
            // Invalid type parameter
            echo 'Invalid type';
            exit;
    }

    // Close the database connection
    $conn->close();

    // Send the HTML options as the response
    echo $optionsHtml;
} else {
    // Type parameter is not set
    echo 'Type parameter is missing';
}
?>
