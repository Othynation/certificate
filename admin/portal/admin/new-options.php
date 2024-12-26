<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>
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

// Create tables if not exists
$sql = "CREATE TABLE IF NOT EXISTS csubject (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS cyear (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(255) NOT NULL
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS csemester (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    semester VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'add_subject':
                handleFormData($_POST, 'csubject', 'subject', $conn);
                break;
            case 'add_year':
                handleFormData($_POST, 'cyear', 'year', $conn);
                break;
            case 'add_semester':
                handleFormData($_POST, 'csemester', 'semester', $conn);
                break;
            default:
                echo "Invalid action";
                break;
        }
        
    }
    exit; // Prevent further execution
}

function handleFormData($data, $tableName, $columnName, $conn) {
    // Loop through each entry in the data array
    foreach ($data as $entry) {
        // Check if the entry is an array
        if (is_array($entry)) {
            // Loop through each value in the entry
            foreach ($entry as $value) {
                // Escape the value to prevent SQL injection
                $escapedValue = mysqli_real_escape_string($conn, $value);
                // Construct and execute the SQL query to insert the value into the table
                $sql = "INSERT INTO $tableName ($columnName) VALUES ('$escapedValue')";
                if ($conn->query($sql) !== TRUE) {
                    // If an error occurs, echo the error message and return
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    return;
                }
            }
        } else {
            // If the entry is not an array, skip it
            continue;
        }
    }
    // If insertion is successful, echo success message
    echo "success";
}

?>
<!-- Add Subjects Button -->
<div class="container" style="margin-left:100px !important;padding-left:200px; color:black;"><br/><br/>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
    Add Subjects
</button>
<br/><br/><br/>
<!-- Add Year Button -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addYearModal">
    Add Year
</button>
<br/><br/>
<!-- Add Semester Button -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSemesterModal">
    Add Semester
</button>
<br/><br/>
<!-- show functionality -->
<?php 
require_once("option1.php");
?>
<!-- end of show -->
<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectModalLabel">Add Subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSubjectForm">
                    <div id="subjectFields">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="subject[]" placeholder="Subject 1">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger delete-field">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="addSubjectFieldBtn">Add More</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Year Modal -->
<div class="modal fade" id="addYearModal" tabindex="-1" role="dialog" aria-labelledby="addYearModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearModalLabel">Add Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addYearForm">
                    <div id="yearFields">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="year[]" placeholder="Year 1">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger delete-field">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="addYearFieldBtn">Add More</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Semester Modal -->
<div class="modal fade" id="addSemesterModal" tabindex="-1" role="dialog" aria-labelledby="addSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSemesterModalLabel">Add Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSemesterForm">
                    <div id="semesterFields">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="semester[]" placeholder="Semester 1">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger delete-field">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="addSemesterFieldBtn">Add More</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<style>
body{
background-color:#f5fffe !important;
}
</style>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to add more fields
        function addField(container, placeholder) {
            var newField = document.createElement('div');
            newField.className = 'form-group';
            newField.innerHTML = '<div class="input-group"><input type="text" class="form-control" name="' + placeholder+"_"+Math.floor(Math.random()*50000) + '[]" placeholder="' + placeholder + '"><div class="input-group-append"><button type="button" class="btn btn-danger delete-field">-</button></div></div>';
            document.querySelector(container).appendChild(newField);
        }

        // Function to delete field
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-field')) {
                event.target.closest('.form-group').remove();
            }
        });

        // Function to add more subject fields
        document.getElementById('addSubjectFieldBtn').addEventListener('click', function() {
            addField('#subjectFields', 'Subject');
        });

        // Function to add more year fields
        document.getElementById('addYearFieldBtn').addEventListener('click', function() {
            addField('#yearFields', 'Year');
        });

        // Function to add more semester fields
        document.getElementById('addSemesterFieldBtn').addEventListener('click', function() {
            addField('#semesterFields', 'Semester');
        });

        // Form submission for adding subjects
        document.getElementById('addSubjectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log(Array.from(formData));
            formData.append('action', 'add_subject');
            fetch('<?php echo $_SERVER["PHP_SELF"]; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    document.getElementById('addSubjectModal').style.display = 'none';
                    alert('Saved Successfully'); // Log success message
                    location.reload(); // Reload the page on success
                } else {
                    console.error('Error: ' + data);
                    location.reload(); // Log error message
                }
            })
            .catch(error =>{ 
                console.error('Error:', error);
                location.reload()
            });
        });

        // Form submission for adding year
        document.getElementById('addYearForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('action', 'add_year');
            fetch('<?php echo $_SERVER["PHP_SELF"]; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    document.getElementById('addYearModal').style.display = 'none';
                    alert('Saved Successfully'); // Log success message
                    location.reload(); // Reload the page on success
                } else {
                    console.error('Error: ' + data);
                    location.reload(); // Log error message
                }
            })
            .catch(error =>{ 
                console.error('Error:', error);
                location.reload()
            });
        });

        // Form submission for adding semester
        document.getElementById('addSemesterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('action', 'add_semester');
            fetch('<?php echo $_SERVER["PHP_SELF"]; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    document.getElementById('addSemesterModal').style.display = 'none';
                    alert('Saved Successfully'); // Log success message
                    location.reload(); // Reload the page on success
                } else {
                    console.error('Error: ' + data); // Log error message
                    location.reload()
                }
            })
            .catch(error =>{ 
                console.error('Error:', error);
                location.reload()
            });
        });
    });
</script>

<?php include("footer.php"); ?>
