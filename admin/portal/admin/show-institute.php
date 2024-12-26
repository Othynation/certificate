<?php require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}
       include("functions.php");
?>
<?php
// Establish database connection (assuming MySQL)
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

// Function to retrieve institutes from the database
function getInstitutes($conn) {
    $sql = "SELECT * FROM institute";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array();
    }
}

// Function to delete institute from the database
// Function to delete institute from the database
function deleteInstitute($conn, $id, $password) {
    // Check if password matches
    if ($password == '') {
        echo "<script>alert('Error: Password is required.');</script>";
        return;
    }
    // Fetch institute password from the database based on ID
    $sql = "SELECT password FROM institute WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];
        // Check if the provided password matches the stored password
        if ($password !== $storedPassword) {
            echo "<script>alert('Error: Incorrect password. Deletion canceled.');</script>";
            return;
        }
    } else {
        echo "<script>alert('Error: Institute not found.');</script>";
        return;
    }

    // If password matches, proceed with deletion
    $sql = "DELETE FROM institute WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Function to update institute data in the database
function updateInstitute($conn, $id, $name, $email, $phone, $address, $tc_number, $logo, $password) {
    // Check if the updated email already exists
    $check_sql = "SELECT * FROM institute WHERE email='$email' AND id != $id";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        echo "<script>alert('Error: Updated email already exists.');</script>";
        return;
    }

    $sql = "UPDATE institute SET name='$name', email='$email', phone='$phone', address='$address', tc_number='$tc_number', password='$password', logo='$logo' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

// Check if delete request is sent
if (isset($_POST['delete_id'])&&isset($_POST['password'])) {
    $id = $_POST['delete_id'];
    $password = $_POST['password']; // Fetch institute password from form
    deleteInstitute($conn, $id, $password);
}

// Check if update request is sent
if (isset($_POST['update_id'])) {
    // Retrieve form data
    $id = $_POST['update_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $tc_number = $_POST['tc_number'];
    $password = $_POST['password'];
    $logo = '';

    // Handle file upload for logo if a file is uploaded
    if ($_FILES['logo']['error'] == UPLOAD_ERR_OK) {
        $logo_name = $_FILES['logo']['name'];
        $logo_tmp_name = $_FILES['logo']['tmp_name'];
        $logo_dest = 'uploads/' . $logo_name;
        move_uploaded_file($logo_tmp_name, $logo_dest);
        $logo = $logo_dest;
    }

    // Update institute data
    updateInstitute($conn, $id, $name, $email, $phone, $address, $tc_number, $logo, $password);
}

// Get institutes from database
$institutes = getInstitutes($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institutes</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        th{
            text-wrap:nowrap;
        }
    </style>
</head>
<body>
<?php include("header.php"); ?>
                <?php include("sidebar.php"); ?>
                <div class="">
    <div class="container d-flex align-items-center justify-content-center">
        <table class="bg-white table table-bordered w-50">
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>TC Number</th>
                <th>Action</th>
            </tr>
        <?php foreach ($institutes as $institute): ?>
            <tr>
                <td><?php if (!empty($institute['logo'])): ?>
                                <img height="100" width="100" src="<?php echo $institute['logo']; ?>" class="card-img-top rounded-circle" alt="Logo">
                            <?php else: ?>
                                <i class="fas fa-university fa-5x"></i> <!-- Font Awesome icon for no logo -->
                            <?php endif; ?></td>
                <td><?php echo $institute['name']; ?></td>
                <td><?php echo $institute['email']; ?></td>
                <td><?php echo $institute['phone']; ?></td>
                <td><?php echo $institute['address']; ?></td>
                <td><?php echo $institute['tc_number']; ?></td>
                <td>
                <form id="deleteForm<?php echo $institute['id']; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $institute['id']; ?>">
                                <input type="hidden" name="password" id="del_pass<?php echo $institute['id']; ?>">

                                <button type="button" onclick="deleteInstituteConfirm(<?php echo $institute['id']; ?>)" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal<?php echo $institute['id']; ?>">
                                Edit
                            </button>
                </td>
            </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $institute['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Institute</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="update_id" value="<?php echo $institute['id']; ?>">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $institute['name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $institute['email']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $institute['phone']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $institute['address']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tc_number">TC Number:</label>
                                        <input type="text" class="form-control" id="tc_number" name="tc_number" value="<?php echo $institute['tc_number']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo:</label>
                                        <input type="file" class="form-control-file" id="logo" name="logo">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password<?php echo $institute['id']; ?>" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="clearfix"></div>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
    <script>
    // Function to confirm institute deletion
    function deleteInstituteConfirm(id) {
        var password = prompt("Please enter your password to confirm deletion:");
        if (password) {
            // Set the password value in the password field
            document.getElementById('del_pass'+id).value = password;
            // Submit the form
            document.getElementById('deleteForm' + id).submit();
        } else {
            // If password is not provided, show a warning message
            swal("warning","Deletion canceled.","warning");
        }
    }
</script>

</body>
</html>
