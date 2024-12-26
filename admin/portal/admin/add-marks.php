<?php
require_once("../autoload.php"); 
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ddd;
            margin: 0 5px;
        }
        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
        .record table {
            width: 100%;
            border-collapse: collapse;
            display: none;
        }
        .record th, .record td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .record th {
            background-color: #f2f2f2;
        }
        .stbl * {
            text-wrap: nowrap;
        }
    </style>
</head>
<body style="background-color:#f5fffe; color:black;">

    <?php 
        include("header.php");
        include("sidebar.php");
    ?>
    <div class="container w-50">
        <div>
            <form action="" class="w-50 mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
// Establish database connection (assuming MySQL)
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

// Variables for pagination
$results_per_page = 10; // Number of results per page
$current_page = 1; // Default current page

// Calculate current page
if (isset($_GET['page']) && $_GET['page'] > 0) {
    $current_page = $_GET['page'];
}

// Variables for search
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Build the SQL query with search functionality
$sql_count = "SELECT COUNT(*) as count FROM pregistrations";
$sql = "SELECT * FROM pregistrations";

if (!empty($search_query)) {
  $sql_count .= " WHERE (namef LIKE '%$search_query%' OR reg_no LIKE '%$search_query%' OR namel LIKE '%$search_query%' OR email LIKE '%$search_query%' OR aadhar LIKE '%$search_query%' OR mobile LIKE '%$search_query%')";
  $sql .= " WHERE (namef LIKE '%$search_query%' OR reg_no LIKE '%$search_query%' OR namel LIKE '%$search_query%' OR email LIKE '%$search_query%' OR aadhar LIKE '%$search_query%' OR mobile LIKE '%$search_query%')";
}
// Execute the query to get total number of rows for pagination
$result_count = $conn->query($sql_count);
$row = $result_count->fetch_assoc();
$total_rows = $row['count'];
$total_pages = ceil($total_rows / $results_per_page);

// Calculate the starting limit for the query
$offset = ($current_page - 1) * $results_per_page;

// Build the SQL query with pagination
$sql .= " LIMIT $offset, $results_per_page";

// Execute the query
$result = $conn->query($sql);

// Output data of each row
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='record'>";
        echo "<div class='basic-info' style='display:flex; border:2px solid black;padding:3px;'>";
        echo "<p><strong>First Name:</strong> " . $row["namef"] . "</p>";
        echo "<p><strong>Last Name:</strong> " . $row["namel"] . "</p>";
        echo "<p><strong>Registration Number:</strong> " . $row["reg_no"] . "</p>";
        echo "<p><strong>Aadhar Number:</strong> " . $row["aadhar"] . "</p>";
        echo "<button class='btn btn-primary btn-sm text-sm' data-toggle='modal' data-target='#detailsModal' onclick='showDetails(" . json_encode($row) . ")'>View Details</button>";
        echo "<button class='btn btn-secondary btn-sm text-sm' data-toggle='modal' data-target='#addmarks' onclick='setDtl({
            \"reg_id\": " . $row["reg_no"] . ",
            \"namef\": \"" . $row["namef"] . "\",
            \"namel\": \"" . $row["namel"] . "\",
            \"fname\": \"" . $row["fname"] . "\",
            \"mname\": \"" . $row["mname"] . "\",
            \"course\": \"" . $row["course"] . "\",
            \"aadhar\": \"" . $row["aadhar"] . "\",
            \"institute\": \"" . $row["institute"] . "\"
        })'>Add Marks</button>";
        echo "</div>";
        echo "<table class='bg-white stbl' id='detailsTable" . $row["reg_no"] . "'>";
        echo "<tr><th>Registration ID</th><td>" . $row["reg_id"] . "</td><th>First Name</th><td>" . $row["namef"] . "</td><th>Last Name</th><td>" . $row["namel"] . "</td></tr>";
        echo "<tr><th>Father's Name</th><td>" . $row["fname"] . "</td><th>Mother's Name</th><td>" . $row["mname"] . "</td><th>Image</th><td><img height='100' width='100' src='../admin/uploads/" . $row["image"] . "'/></td></tr>";
        echo "<tr><th>Source</th><td><img src='../admin/uploads/" . $row["source"] . "' width='100' height='100'/></td><th>Course</th><td>" . $row["course"] . "</td><th>Registration Date</th><td>" . $row["reg_date"] . "</td></tr>";
        echo "<tr><th>Registration Number</th><td>" . $row["reg_no"] . "</td><th>Aadhar Number</th><td>" . $row["aadhar"] . "</td><th>Email</th><td>" . $row["email"] . "</td></tr>";
        echo "<tr><th>Mobile</th><td>" . $row["mobile"] . "</td><th>City</th><td>" . $row["city"] . "</td><th>State</th><td>" . $row["state"] . "</td></tr>";
        echo "<tr><th>District</th><td>" . $row["district"] . "</td><th>Taluka</th><td>" . $row["taluka"] . "</td><th>Pincode</th><td>" . $row["pincode"] . "</td></tr>";
        echo "<tr><th>Duration</th><td>" . $row["duration"] . "</td><th>Qualification</th><td>" . $row["qualification"] . "</td><th>Institute</th><td>" . $row["institute"] . "</td></tr>";
        echo "<tr><th>Transaction ID</th><td>" . $row["txnid"] . "</td><th>Status</th><td colspan='1'>" . ($row["status"] == 1 ? "Approved" : "Pending") . "</td></tr>";
        echo "</table>";
        echo "</div>";
    }
} else {
    echo "<p>No results found.</p>";
}

// Pagination links
echo "<div class='pagination'>";
if ($current_page > 1) {
    echo "<a href='?page=" . ($current_page - 1) . "&search=$search_query'>&laquo; Prev</a>";
}
echo "<span>Page $current_page of $total_pages</span>";
if ($current_page < $total_pages) {
    echo "<a href='?page=" . ($current_page + 1) . "&search=$search_query'>Next &raquo;</a>";
}
echo "</div>";

// Close the database connection
$conn->close();
?>

    </div>
    <?php require_once("footer.php");?>

    <!-- Modal for viewing details -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:100% !important">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Student Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow:scroll;">
                    <!-- Details table will be dynamically populated -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding marks -->
    <div class="modal fade" id="addmarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:100% !important">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:100% !important">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Fields</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addFieldForm">
                        <div id="fieldContainer">
                            <div class="form-row mb-3" id="fieldRow0">
                                <div class="col">
                                    <label for="year">Select Year</label>
                                    <select name="year" id="year" class="form-control mb-2"></select>
                                </div>
                                <div class="col">
                                    <label for="semester">Select Semester</label>
                                    <select name="semester" id="semester" class="form-control mb-2"></select>
                                </div>
                            </div>
                            <div class="form-row mb-3" id="fieldRow0">
                                <div class="col">
                                    <label>Subject</label>
                                </div>
                                <div class="col">
                                    <label>Full Marks</label>
                                </div>
                                <div class="col">
                                    <label>Obtained Marks</label>
                                </div>
                                <div class="col">
                                    <label>Practical Marks</label>
                                </div>
                                <div class="col">
                                    <label>Action</label>
                                </div>
                            </div>
                            <!-- Subject and marks fields -->
                            <div class="form-row mb-3" id="fieldRow1">
                                <div class="col">
                                    <select class="form-control" name="subject[]">
                                        <!-- Options will be dynamically populated from the database -->
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="maxmarks[]" placeholder="Max Marks" value="100">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="obtmarks[]" placeholder="Obtained Marks" value="0">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="practicalmarks[]" placeholder="Practical Marks" value="0">
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger btn-remove" data-index="1">-</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" id="addFieldBtn">Add Field</button>
                        <hr>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to handle dynamic field addition and modal population -->
    <script>
        $(document).ready(function() {
            var fieldIndex = 2; 

            // Add field button click event
            $('#addFieldBtn').click(function() {
                var defaultFieldRow = $('#fieldRow1').clone();
                var clonedFieldRow = defaultFieldRow.clone();
                clonedFieldRow.attr('id', 'fieldRow' + fieldIndex); // Update the ID
                clonedFieldRow.find('.btn-remove').attr('data-index', fieldIndex); // Update the data-index attribute
                $('#fieldContainer').append(clonedFieldRow);
                fieldIndex++;
            });

            // Remove field button click event
            $(document).on('click', '.btn-remove', function() {
                var indexToRemove = $(this).data('index');
                $('#fieldRow' + indexToRemove).remove();
            });

            // Form submission
            $('#addFieldForm').submit(function(e) {
                e.preventDefault();
                // Construct the JSON object
                var formData = {
                    reg_id: window.data_for_result.reg_id,
                    year: $('#year').val(),
                    semester: $('#semester').val(),
                    data: [{detail:window.data_for_result}]
                };
                $('select[name="subject[]"]').each(function(index) {
                    var subject = $(this).val();
                    var maxMarks = $('input[name="maxmarks[]"]').eq(index).val();
                    var obtMarks = $('input[name="obtmarks[]"]').eq(index).val();
                    var practicalMarks = $('input[name="practicalmarks[]"]').eq(index).val();
                    formData.data.push({ subject: subject, maxMarks: maxMarks, obtMarks: obtMarks, practicalMarks: practicalMarks });
                });

                $.ajax({
                    url: 'savecresult.php',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        // Handle the response from the server
                        alert(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(error);
                        alert('An error occurred while submitting the form.');
                    }
                });

                $('#addmarks').modal('hide');
            });

            function fetchOptions() {
                // Fetch options for year
                $.ajax({
                    url: 'fetch_options.php',
                    method: 'GET',
                    data: { type: 'year' },
                    success: function(response) {
                        // Append options to the select dropdown for year
                        $('#year').html(response);
                    }
                });

                // Fetch options for semester
                $.ajax({
                    url: 'fetch_options.php',
                    method: 'GET',
                    data: { type: 'semester' },
                    success: function(response) {
                        // Append options to the select dropdown for semester
                        $('#semester').html(response);
                    }
                });

                // Fetch options for subject
                $.ajax({
                    url: 'fetch_options.php',
                    method: 'GET',
                    data: { type: 'subject' },
                    success: function(response) {
                        // Append options to the select dropdown for subject
                        $('#fieldContainer select[name="subject[]"]').html(response);
                    }
                });
            }

            // Call the fetchOptions function when the document is ready
            fetchOptions();
        });

        function setDtl(dt){
            window.data_for_result = dt;
        }

        function showDetails(details) {
            var detailsTable = $('#detailsTable' + details.reg_no).clone().show();
            $('#detailsModal .modal-body').html(detailsTable);
        }
    </script>

</body>
</html>
