<?php
session_start();

// Your database connection code here
require_once("pdo-config-ts.php");

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

// Fetch years from database
$sql_years = "SELECT DISTINCT year FROM cresults";
$result_years = $conn->query($sql_years);

// Fetch semesters from database
$sql_semesters = "SELECT DISTINCT semester FROM cresults";
$result_semesters = $conn->query($sql_semesters);

// Close connection
$conn->close();

// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate captcha
    if ($_POST["captcha"] != $_SESSION["captcha"]) {
        $captcha_error = "Incorrect captcha!";
    } else {
        // Validate other fields
        $year = $_POST["year"];
        $semester = $_POST["semester"];
        $enrollment_number = $_POST["enrollment_number"];
        
        // Redirect to cresult.php with validated inputs
        header("Location: student-result-show.php?reg_id=$enrollment_number&sem=$semester&year=$year");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            background: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M10 12l-6-6h12l-6 6z"/></svg>') no-repeat right 10px center;
            background-size: 14px;
            padding-right: 30px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        canvas {
            display: block;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body class="container">
    <h2>Student Result Checker</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="year">Year:</label>
        <select name="year" id="year">
            <?php while ($row = $result_years->fetch_assoc()): ?>
                <option value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label for="semester">Semester:</label>
        <select name="semester" id="semester">
            <?php while ($row = $result_semesters->fetch_assoc()): ?>
                <option value="<?php echo $row['semester']; ?>"><?php echo $row['semester']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label for="enrollment_number">Enrollment Number:</label>
        <input type="text" name="enrollment_number" id="enrollment_number"><br><br>
        
        <!-- Captcha canvas -->
        <label for="captcha">Captcha:</label>
        <canvas id="captchaCanvas" width="120" height="30"></canvas><br>
        <input type="text" name="captcha" id="captcha"><br>
        
        <input type="submit" value="Submit">
    </form>

    <script>
        // Function to draw captcha on canvas
        function drawCaptcha(captcha) {
            var canvas = document.getElementById("captchaCanvas");
            var ctx = canvas.getContext("2d");
            ctx.font = "20px Arial";
            ctx.fillStyle = "black";
            ctx.fillText(captcha, 10, 25);
        }

        // Fetch captcha from PHP script
        fetch('captcha.php')
            .then(response => response.text())
            .then(data => {
                drawCaptcha(data);
            });
    </script>

    <?php if (!empty($captcha_error)): ?>
        <p style="color: red;"><?php echo $captcha_error; ?></p>
    <?php endif; ?>
</body>
</html>
