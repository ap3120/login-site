<?php
session_start();

// Check if the user has submitted the login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the user's input from the login form
    $username = $_POST['l-username'];
    $password = $_POST['l-pw'];

    // Connect to the database
    include('config.php');
    $mysqli = new mysqli("localhost", $db_user, $db_password, $db_name);

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Query the database for the user's information
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists and the password is correct
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {

            // Set the session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            // Redirect the user to the dashboard page
            header('Location: dashboard.php');
            exit();

        } else {
            // The password is incorrect
            $error = "Invalid password.";
            $encoded_error = urlencode($error);
            header('Location: ../index.php?error={$encoded_error}');
        }
    } else {
        // The user does not exist
        $error = "Invalid username.";
        $encoded_error = urlencode($error);
        header('Location: ../index.php?error={$encoded_error}');
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();

}

?>
