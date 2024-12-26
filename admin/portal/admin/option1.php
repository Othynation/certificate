<?php
require_once("../pdo-config-ts.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete requests
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);
    if (isset($_DELETE['table']) && isset($_DELETE['id'])) {
        $table = $_DELETE['table'];
        $id = $_DELETE['id'];
        $deleteQuery = "DELETE FROM $table WHERE id = $id";
        if ($conn->query($deleteQuery) === TRUE) {
            http_response_code(200);
            echo "Item deleted successfully";
        } else {
            http_response_code(500);
            echo "Error deleting item: " . $conn->error;
        }
    }
    exit;
}

?>

<div class="container">
    <h2>Subjects</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subjectResult = $conn->query("SELECT * FROM csubject");
                if ($subjectResult->num_rows > 0) {
                    while ($row = $subjectResult->fetch_assoc()) {
                        echo '<tr>
                            <td>' . $row['subject'] . '</td>
                            <td>
                                <form id="deleteSubjectForm_' . $row['id'] . '" method="post" style="display:inline;">
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <input type="hidden" name="table" value="csubject">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <button type="button" onclick="deleteItem(' . $row['id'] . ', \'csubject\')" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <h2>Years</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $yearResult = $conn->query("SELECT * FROM cyear");
                if ($yearResult->num_rows > 0) {
                    while ($row = $yearResult->fetch_assoc()) {
                        echo '<tr>
                            <td>' . $row['year'] . '</td>
                            <td>
                                <form id="deleteYearForm_' . $row['id'] . '" method="post" style="display:inline;">
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <input type="hidden" name="table" value="cyear">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <button type="button" onclick="deleteItem(' . $row['id'] . ', \'cyear\')" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <h2>Semesters</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $semesterResult = $conn->query("SELECT * FROM csemester");
                if ($semesterResult->num_rows > 0) {
                    while ($row = $semesterResult->fetch_assoc()) {
                        echo '<tr>
                            <td>' . $row['semester'] . '</td>
                            <td>
                                <form id="deleteSemesterForm_' . $row['id'] . '" method="post" style="display:inline;">
                                    <input type="hidden" name="_METHOD" value="DELETE">
                                    <input type="hidden" name="table" value="csemester">
                                    <input type="hidden" name="id" value="' . $row['id'] . '">
                                    <button type="button" onclick="deleteItem(' . $row['id'] . ', \'csemester\')" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function deleteItem(id, table) {
        if (confirm('Are you sure you want to delete this item?')) {
            fetch('<?php echo $_SERVER["PHP_SELF"]; ?>', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'table=' + table + '&id=' + id
            })
            .then(response => response.text())
            .then(data => {
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>
