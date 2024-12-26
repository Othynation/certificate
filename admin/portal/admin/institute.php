<?php require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}
       include("functions.php");
?>
<?php
require_once("../pdo-config-ts.php");
// Establish database connection (assuming MySQL)
$servername = DBHOST;
$username = DBUSER;
$password = DBPASS;
$dbname = DBNAME;

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to create institute table if not exist
function createInstituteTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS institute (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(15) NOT NULL,
        address VARCHAR(255) NOT NULL,
        tc_number VARCHAR(20) NOT NULL,
        logo VARCHAR(255),
        password VARCHAR(255) NOT NULL,
        created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        return "Table created successfully";
    } else {
        return "Error creating table: " . $conn->error;
    }
}

// Function to insert data into institute table
function insertData($conn, $name, $email, $phone, $address, $tc_number, $logo, $password) {
    $sql = "INSERT INTO institute (name, email, phone, address, tc_number, logo, password) 
            VALUES ('$name', '$email', '$phone', '$address', '$tc_number', '$logo', '$password')";
    try {
        $conn->query($sql);
        return "success";
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            return "Error: Email already exists.";
        } else {
            return "Error: " . $e->getMessage();
        }
    }
}

$errors = array(); // Initialize an array to store errors
$success_message = ""; // Initialize variable to store success message

// Initialize variables to store form data
$name = $email = $phone = $address = $tc_number = $password = $confirm_password = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $tc_number = $_POST['tc_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $errors[] = "Password and confirm password do not match.";
    } else {
        // Handle file upload for logo
        $logo_path = '';
        if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logo_tmp_name = $_FILES['logo']['tmp_name'];
            $logo_name = uniqid() . '_' . basename($_FILES['logo']['name']); // Generate unique filename
            $logo_path = 'uploads/' . $logo_name;
            if (!move_uploaded_file($logo_tmp_name, $logo_path)) {
                $errors[] = "Error uploading logo.";
            }
        }
        
        // Create institute table if not exist
        $table_creation_result = createInstituteTable($conn);
        if ($table_creation_result !== "Table created successfully") {
            $errors[] = $table_creation_result;
        }

        // Insert data into institute table
        $insert_result = insertData($conn, $name, $email, $phone, $address, $tc_number, $logo_path, $password);
        if ($insert_result === "success") {
            $success_message = "New record created successfully.";
            $name = $email = $phone = $address = $tc_number = $password = $confirm_password = ''; // Reset form fields
        } else {
            $errors[] = $insert_result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Login Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include("header.php"); ?>
                <?php include("sidebar.php"); ?>
                <div class="">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php foreach ($errors as $error): ?>
                                <?php echo $error; ?><br>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($success_message !== ""): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    <form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tc_number">TC Number:</label>
                                <input type="text" class="form-control" id="tc_number" name="tc_number" value="<?php echo $tc_number; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="logo">Logo:</label>
                                <input type="file" class="form-control-file" id="logo" name="logo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $confirm_password; ?>" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
</body>
</html>
