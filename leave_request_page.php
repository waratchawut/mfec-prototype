<?php
session_start(); // Start the session

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ./");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Request System - MFEC</title>
    <h1>Welcome, <?php echo $username; ?>!</h1>
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
        <h1>Leave Request System</h1>
    </header>

    <div class="container">
        <form action="process_leave_request.php" method="post">
            <label for="type">Leave Type:</label>
            <select name="type" id="type">
                <option value="sick">Sick Leave</option>
                <option value="personal">Personal Leave</option>
                <option value="vacation">Vacation Leave</option>
            </select><br><br>
            
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date"><br><br>
            
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date"><br><br>
            
            <label for="leave_period">Leave Period:</label>
            <select name="leave_period" id="leave_period">
                <option value="full_day">Full Day</option>
                <option value="half_day_morning">Half Day (Morning)</option>
                <option value="half_day_afternoon">Half Day (Afternoon)</option>
            </select><br><br>
            
            <input type="submit" value="Submit">
        </form>

        <div class="leave-summary">
            <h2>Leave remaining Summary</h2>
            <p>Vacation Leave Remaining: 12 days</p>
            <p>Sick Leave Remaining: 30 days</p>
            <p>Business Leave Remaining: 10 days</p>
        </div>
    </div>

    
</body>
</html>
