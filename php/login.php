<?php
session_start();

// Check if the user has submitted the login form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the user's input from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $output['session']['id'] = '';
    $output['session']['username'] = '';
    $output['error'] = null;

    // Connect to the database
    include('config.php');
    $mysqli = new mysqli("localhost", $db_user, $db_password, $db_name);

    // Check connection
    if ($mysqli->connect_errno) {
        $output['error'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
        echo json_encode($output);
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

            $output['session']['id'] = $row['id'];
            $output['session']['username'] = $row['username'];
            $stmt->close();
            $mysqli->close();
            echo json_encode($output);

        } else {
            // The password is incorrect
            $stmt->close();
            $mysqli->close();
            $output['error'] = "Invalid password.";
            echo json_encode($output);
        }
    } else {
        // The user does not exist
        $stmt->close();
        $mysqli->close();
        $output['error'] = "Invalid username.";
        echo json_encode($output);
    }

}

?>
