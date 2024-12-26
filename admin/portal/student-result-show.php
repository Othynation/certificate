<?php
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

// Check if reg_id is provided in the request
if (!isset($_GET['reg_id'])) {
    echo "Error: Registration ID is missing in the request.";
    exit;
}

// Retrieve reg_id from the request
$reg_id = $_GET['reg_id'];
$sem = $_GET['sem'];
$year = $_GET['year'];

// Prepare and execute SQL query to fetch data
$sql = "SELECT * FROM cresults WHERE reg_id = ? AND semester=? AND year=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $reg_id,$sem,$year);

if (!$stmt->execute()) {
    echo "Error executing query: " . $stmt->error;
    exit;
}

// Get result set
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows === 0) {
    echo "No records found for Registration ID: $reg_id";
    exit;
}

// Fetch data and store in an array
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close statement and connection
$stmt->close();
$conn->close();
$json =  json_encode($data);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css"
  rel="stylesheet"
/>
<style>
    #cont{
        background-color:rgba(237, 243, 70, 0.8);
    }
    #rs td{
        border:1px solid black !important;
        font-weight:bold;
        color:black !important;
    }
    .head1 th{
        color:black !important;
    }
    @media print{
.pn{
    display:none !important;
}
    }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container w-100 mt-3 mb-5 p-3" id="cont">
    <h2 class="text-center text-black w-100">
       <img src="https://pbetb.org.in/portal/assets/image/pune%20board%20Logo.jpg" alt="pbet-logo" style="height:50px;width:50px;border-radius:50%;padding:2px;"> Pune Business Education Training Board<br/>
       <p class="text-black w-100 text-center" style="font-size:small;">Affiliated By CPISD By National Skill Development Corporation (NSDC)</p>
    </h2>
    <hr style="border:2px solid white;">
    <h3 class="text-center text-black w-100">Academic Result</h3><hr style="border:2px solid white;">
    <div class="d-flex align-items-center text-black flex-column">
       <div id="rheaders">
         
       </div>
    </div>
    <table class="table border-bordered border border-dark" id="rs">
        <thead>
            <tr>
                <th style="color:white;" class="text-center text-white bg-primary">Subjects</th>
                <th style="color:white;" colspan="5" class="text-center bg-primary text-white">Obtained Marks & Grades</th>
            </tr>
            <tr class="head1">
                <th>&nbsp;</th>
                <th>Max Marks</th>
                <th>Obtained Marks</th>
                <th>Practical Marks</th>
                <th>Total</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody class="text-black" id="rbody">
        </tbody>
    </table>
        <button class="btn btn-primary rounded pn" onclick="window.print()">
        Print <i class="fa fa-print"></i>
    </button>
        <button class="btn btn-primary rounded pn" onclick="dld()">
        Download <i class="fa fa-download"></i>
    </button>
    <a id="result" style="display:none;" download="result.pdf"></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function dld(){
html2canvas(document.body).then(function(canvas) {
    let cvs = canvas.toDataURL()
    let doc = new jspdf.jsPDF();
    doc.addImage(cvs, 'png', 15, 40, 180, 160);
    let opt = doc.output('datauri');
document.querySelector("#result").href=opt; 
  document.querySelector("#result").click()
  document.querySelector("#result").href="";
});
        }

            let dt = <?php echo $json; ?>;
            let dtl = JSON.parse(dt[0].data)
            let year = dt[0].year;
            let semester = dt[0].semester;
            console.log(dtl);
            let htemplate = (name,father,enums,course,year,semester,institute)=>{
                return `
                <div><strong>Institute :</strong> <span>${institute}</span></div>
                <div><strong>Student Name :</strong> <span>${name}</span></div>
        <div><strong>Father Name :</strong> <span>${father}</span></div>
        <div><strong>Enrollment No. :</strong> <span>${enums}</span></div>
        <div><strong>Course Name :</strong> <span>${course}</span></div>
        <div><strong>Year :</strong> <span>${year}</span></div>
        <div><strong>Semister :</strong> <span>${semester}</span></div>
                `
            }
            let name = dtl[0].detail.namef+" "+dtl[0].detail.namel;
            let father = dtl[0].detail.fname;
            let enums = dtl[0].detail.reg_id;
            let course = dtl[0].detail.course;
            let institute = dtl[0].detail.institute;
            document.querySelector("#rheaders").innerHTML=htemplate(name,father,enums,course,year,semester,institute);

            dtl.shift()
            let rdc = dtl.reduce((p,c)=>{
                let ttl = (parseInt(c.obtMarks)+parseInt(c.practicalMarks));
                    let ca = `
                    <tr>
                    <td><b>${c.subject}</b></td>
                    <td><b>${c.maxMarks}</b></td>
                    <td><b>${c.obtMarks}</b></td>
                    <td><b>${c.practicalMarks}</b></td>
                    <td><b>${ttl}</b></td>
                    <td><b>${ttl<33?'Fail':'PASS'}</b></td>
                </tr>
                    `
                    return p+ca;
            },'')

            let forp = dtl.reduce((p,c)=>{
                let obt = (parseInt(p.obt)+parseInt(c.obtMarks));
                let max = (parseInt(p.max)+parseInt(c.maxMarks));
                return {obt,max}
            },{obt:0,max:0})
            let percent = (parseInt(forp.obt) / parseInt(forp.max)) * 100;
            let rfoot = `
            <tr style="border:2px solid black;">
                <td colspan="2"></td>
                <td>Percentage</td>
                <td>${percent} %</td>
                <td>Grade</td>
                <td class="text-${percent<33?'danger':'success'}" >${percent<33?'FAILED':'PASS'}</td>
            </tr>
            `
            // console.log(forp);
            document.querySelector("#rbody").innerHTML=rdc+rfoot;
        

    </script>
</body>
</html>