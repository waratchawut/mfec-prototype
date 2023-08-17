<?php
session_start(); // Start the session

// Define the calculateDuration function to calculate the duration in days
function calculateDuration($start, $end) {
    $start_date = new DateTime($start);
    $end_date = new DateTime($end);
    $interval = $start_date->diff($end_date);
    return $interval->days;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume that you have the 'type', 'start_date', and 'end_date' variables here
    $type = $_POST['type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $leave_period = $_POST['leave_period'];

    // Calculate the duration in days using the calculateDuration function
    $duration = calculateDuration($start_date, $end_date);
    $duration = $duration +1;
    
   

    


    

    $remainingVacation = 12; // Example remaining vacation days
    $remainingSick = 30; // Example remaining sick days
    $remainingBusiness = 10; // Example remaining business days

    // Determine the appropriate approval message and recipients based on leave duration
    if ($duration < 5) {
        $approvalMessage = "Your request has been sent to หัวหน้าแผนก -> HR   for approval";
        $approvalRecipients = "หัวหน้าแผนก -> HR";
    } else {
        $approvalMessage = "Your request has been sent to หัวหน้าฝ่าย -> หัวหน้าแผนก -> HR   for approval";
        $approvalRecipients = "หัวหน้าฝ่าย -> หัวหน้าแผนก -> HR";
    }


    if($duration <= 1){
        // Calculate the duration in days based on leave period
        if ($leave_period == 'full_day') {
            $leaveDurationString = date('Y-m-d', strtotime($start_date)) . " to " . date('Y-m-d', strtotime($end_date)) . " (" . ($duration) . " days)";
        } elseif ($leave_period == 'half_day_morning' || $leave_period == 'half_day_afternoon') {
            $duration = 0.5;
            $leaveDurationString = date('Y-m-d', strtotime($start_date)) . " to " . date('Y-m-d', strtotime($end_date)) . " (" . ($duration) . " days)";
        } else {}
    }else {
        $leaveDurationString = date('Y-m-d', strtotime($start_date)) . " to " . date('Y-m-d', strtotime($end_date)) . " (" . ($duration) . " days)";
    }
    // Create a formatted leave duration string
    
    
    
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Request System - MFEC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f8fb;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0098d4;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 24px;
        }

        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #0098d4;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            text-decoration: none;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        select, input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        select {
            height: 36px;
        }

        input[type="submit"] {
            background-color: #0098d4;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <a href="./" class="logout-button">Logout</a>

    <header>
        <img src="mfec_logo.jpg" alt="MFEC Logo" width="200">
        <h1>Leave summary , <?php echo $_SESSION['username']; ?>!</h1>
    </header>

    <div class="container">
        <p><?php echo $approvalMessage; ?></p>

        <div class="leave-summary">
            <h2>After being aprroved : leave summary for <?php echo $_SESSION['username']; ?>  is</h2>
            <p>Status : <?php echo "on progress.."; ?></p>
            <p>Leave type: <?php echo $type; ?></p>
            <p>Selected period: <?php echo $leaveDurationString; ?></p>

            <?php 
            if($type == "vacation"){
                $remainingVacation=$remainingVacation-$duration;
            }elseif($type == "sick"){
                $remainingSick=$remainingSick-$duration;
                }elseif($type == "personal"){
                    $remainingBusiness=$remainingBusiness-$duration;
                    } ?>


            <p>Remaining vacation leave: <?php echo $remainingVacation; ?> days</p>
            <p>Remaining sick leave: <?php echo $remainingSick; ?> days</p>
            <p>Remaining business leave: <?php echo $remainingBusiness; ?> days</p>
        </div>
        
        <div class="buttons">
            <input type="submit" name="submit" value="OK" onclick="redirectToLeavePage()">
            
            
        </div>
        
        <script>
        function redirectToLeavePage() {
            window.location.href = "leave_request_page.php";
        }

       
        </script>


    </div>

   
</body>
</html>
