<?php
require_once("../autoload.php");

// Check if session and exam fee are provided
if(isset($_POST['session']) && isset($_POST['exam_fee'])) {
    $session = $_POST['session'];
    $exam_fee = $_POST['exam_fee'];

    // Check if session and exam fee are not empty
    if(!empty($session) && !empty($exam_fee)) {
        $institute_code = isset($_POST['institute_code']) ? trim($_POST['institute_code']) : '';
        $txnid = isset($_POST['txnid']) ? trim($_POST['txnid']) : '';

        // Check if txnid already exists in the database
        $existingTxnId = $getCredit->get_by_id('pexam', 'etxnid', $txnid);

        // If txnid already exists, return an error response
        if($existingTxnId) {
            $response = array(
                'error' => 'Transaction ID already exists.',
                'status' => 'failed'
            );
        } else {
            // Proceed with exam registration
            // Retrieve registration ID from session
            if(isset($_SESSION['start'])) {
                $id = $_SESSION['start'];

                // Fetch registration ID based on session ID
                $rows = $getCredit->get_by_id('pregistrations', 'reg_no', $id);

                // Check if registration ID is found
                if($rows) {
                    foreach($rows as $row) {
                        $reg_id = $row['reg_id']; 
                    }

                    // Count the number of exam registrations for the registration ID
                    $count = $getCredit->count_by_id('pexam', 'reg_id', $reg_id);

                    // Check if exam registration does not exist for the registration ID
                    if($count == 0) {
                        // Register for the exam and get the last inserted ID
                        $lastid = $getCer->exam_reg($session, $institute_code, $exam_fee, $txnid, $reg_id);

                        // Check if exam registration was successful
                        if($lastid > 0) {
                            // Set session variable for successful exam registration
                            $_SESSION['exam_success_id'] = $lastid;
                            unset($_SESSION['start']); // Unset the session variable

                            // Prepare response for successful registration
                            $response = array(
                                'error' => '',
                                'status' => 'ok'
                            );
                        } else {
                            // Prepare response for failed registration
                            $response = array(
                                'error' => 'Something went wrong. Please try again...',
                                'status' => 'failed'
                            );
                        }
                    } else {
                        // Prepare response for already submitted exam form
                        $response = array(
                            'error' => 'You have already submitted your exam form.',
                            'status' => 'failed'
                        );
                    }
                } else {
                    // Prepare response for missing registration ID
                    $response = array(
                        'error' => 'Registration ID not found.',
                        'status' => 'failed'
                    );
                }
            } else {
                // Prepare response for missing session ID
                $response = array(
                    'error' => 'Session ID not found.',
                    'status' => 'failed'
                );
            }
        }
    } else {
        // Prepare response for missing session or exam fee
        $response = array(
            'error' => 'Session or exam fee is empty.',
            'status' => 'failed'
        );
    }
} else {
    // Prepare response for missing session or exam fee parameters
    $response = array(
        'error' => 'Session or exam fee parameters not provided.',
        'status' => 'failed'
    );
}

// Output JSON response
echo json_encode($response);
?>
