<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validUsername = "waratchw"; // Replace with your actual valid username
    $validPassword = "MFEC#1234"; // Replace with your actual valid password

    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    // Check if submitted username and password are not empty
    if (!empty($submittedUsername) && !empty($submittedPassword)) {
        if ($submittedUsername === $validUsername && $submittedPassword === $validPassword) {
            $_SESSION['username'] = $submittedUsername;
            header("Location: leave_request_page.php"); // Adjust the URL to your leave request page
            exit();
        } else {
            // Invalid login, redirect back to login page with an error message
            header("Location: ./"); // Adjust the URL to your login page
            exit();
        }
    } else {
        // Empty username or password, redirect back to login page
        header("Location: ./");
        exit();
    }
} else {
    // Redirect to the login page if the form wasn't submitted properly
    header("Location: ./");
    exit();
}
?>
