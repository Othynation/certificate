<?php
require_once("../pdo-config-ts.php");
function checkExistingTxnid($txnid) {
    // Define your database connection parameters
    $host = DBHOST; // Change this to your database host
    $dbname = DBNAME; // Change this to your database name
    $username = DBUSER; // Change this to your database username
    $password = DBPASS; // Change this to your database password
    try {
        // Create a new PDO database connection
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Convert txnid to lowercase for accuracy
        $txnid = strtolower($txnid);

        // Prepare and execute the SQL query
        $statement = $pdo->prepare("SELECT COUNT(*) FROM pregistrations WHERE LOWER(txnid) = ?");
        $statement->execute([$txnid]);
        
        // Fetch the result
        $count = $statement->fetchColumn();

        // Return true if the count is greater than 0 (indicating the txnid exists), otherwise false
        return $count > 0;
    } catch (PDOException $e) {
        // Handle database connection error
        die("Database connection failed: " . $e->getMessage());
    }
}

?>