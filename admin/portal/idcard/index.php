<?php

// Function to generate student ID card
function generateIDCard($aadhar_number, $conn) {
    // SQL query to search for the Aadhar number in the database
    $sql = "SELECT * FROM pregistrations WHERE aadhar = '$aadhar_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Found the Aadhar number, fetch data
        $row = $result->fetch_assoc();
        // Extracting data from the row
        $full_name = $row['namef'].' '.$row['namel'];
        $father_name = $row['fname'];
        $course = $row['course'];
        $institute = $row['institute'];
        $image =$row['image'];

        // Generating the ID card HTML
        $id_card_html = "
        <div>
        <div class='btns'>
        <button class='btn btn-primary' onclick='this.parentElement.parentElement.remove()'>Back <i class='fa fa-print'></i></button>
        <button class='btn btn-primary' onclick='printCard()'>Print <i class='fa fa-print'></i></button>
        </div>
        <div id='card_div'>
            <div class='card'>
                <div class='top-half'>
                    <h3>Student ID Card</h3>
                </div>
                <div class='student-info'>
                    <div class='student-info-left'>
                        <p><strong>Full Name:</strong> $full_name</p>
                        <p><strong>Father's Name:</strong> $father_name</p>
                        <p><strong>Course:</strong> $course</p>
                        <p><strong>Institute:</strong> $institute</p>
                    </div>
                    <div class='student-info-right'>
                        <img class='student-photo' src='../admin/uploads/$image' height='150' width='150' alt='Student Photo'>
                        <img class='principal-signature' src='https://via.placeholder.com/50' height='50' width='150' style='height:50px' alt='Principal Signature'>
                    </div>
                </div>
                <div class='footer'>
                    <div class='footer-left'>
                        <p>Pune Business Institute | Contact No: +1234567890</p>
                        <p>Business Address</p>
                    </div>
                    <div class='footer-right'>
                        <img src='https://via.placeholder.com/100' alt='College Logo' style='height:100px'>
                    </div>
                </div>
            </div>
            <div class='card'>
                    <p><strong>Instructions:</strong></p>
                    <ol>
                        <li>Loss of this card should be reported to the college immediately</li>
                        <li>If found, return to the Sreenidhi Institute of Science and Technology</li>
                        <li>Duplicate card will be issued on payment of Rs. 100/-</li>
                        <li>This card is issued for identification purpose only and does not confer any other rights</li>
                    </ol>
                </div>
                </div>
                </div>
        ";
        echo $id_card_html;
    } else {
        echo "No record found for the provided Aadhar number";
    }
}

require_once("../pdo-config-ts.php");
// require_once("check.php");
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Aadhar number input
    $aadhar_number = $_POST['aadhar_number'];
    // Assuming a simple validation for demonstration purpose
    if (empty($aadhar_number)) {
        echo "Aadhar number is required";
    } else {
        // Call the function to generate ID card
        generateIDCard($aadhar_number, $conn);
    }
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ID Card</title>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .card {
        width: 8.6cm;
        height: 5.4cm;
        background: #fff;
        border: 1px solid #000;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        font-size:x-small;
        letter-spacing:0.1em;
    }
    .top-half {
        background-color: orange;
        text-align: center;
        padding-top: 5px;
    }
    .top-half h3 {
        margin: 0;
        color: black;
    }
    .student-info {
        padding: 3px;
        display: flex;
        justify-content: space-between;
        flex-grow: 1;
    }
    .student-info-right {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }
    .student-photo, .principal-signature {
        width: 100px;
        height: auto;
    }
    .footer {
        background-color: #f5f5f5;
        padding: 0px 2px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .footer-left *{
        font-size:xx-small;
    }
    .footer-left p {
        /* margin: 5px 0; */
    }
    .footer-right img {
        max-height: 50px;
    }
    #card_div{
        width:100%;
        height:100vh;
        position:fixed;
        display:flex;
        align-items:center;
        justify-content:center;
        z-index:100;
        background-color:white;
    }
    /* Input Field */
input,
textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  width: 100%;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
}

input:focus,
textarea:focus {
  border-color: #007bff;
  outline: none;
}

/* Button */
button,
input[type="submit"] {
  padding: 10px 20px;
  background-color: #007bff;
  border: none;
  border-radius: 5px;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover,
input[type="submit"]:hover {
  background-color: #0056b3;
}

</style>
</head>
<body>
<div class="aadharin" style="display:flex;flex-direction:column;align-items:center;justify-content:center;">
<h2>Enter Aadhar Number to Generate ID Card</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="aadhar_number">Aadhar Number:</label><br>
        <input type="text" id="aadhar_number" name="aadhar_number"><br><br>
        <input type="submit" value="Generate ID Card">
    </form>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>
        function printCard() {
            var cardDiv = document.getElementById("card_div");

            // Use HTML2Canvas to capture the content of #card_div
            html2canvas(cardDiv, {
                onrendered: function(canvas) {
                    // Convert canvas to base64 image data
                    var imgData = canvas.toDataURL('image/png');

                    // Print the image using Print.js
                    printJS({printable: imgData, type: 'image', base64: true});
                }
            });
        }
    </script>
</body>
</html>
