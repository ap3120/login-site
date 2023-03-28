<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

// Check if both passwords are the same
if ($_REQUEST['password'] !== $_REQUEST['password2']) {
    $output['msg'] = "The two passwords do not match.";
    echo json_encode($output);
    exit;
}

include('config.php');

$mysqli = new mysqli("localhost",$db_user,$db_password,$db_name);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Check if user already exit
$check_user = $mysqli->prepare('SELECT * FROM user WHERE username = ?');
$check_user->bind_param('s', $_REQUEST['username']);
$check_user->execute();

if ($check_user === false) {
    $mysqli->close();
    echo "The query couldn't be processed.";
    exit;
}

$result = $check_user->get_result();
if (mysqli_num_rows($result) !== 0) {
    $output['msg'] = "User already exists.";
    $check_user->close();
    $mysqli->close();
    echo json_encode($output);
    exit;
}
$check_user->close();

// Add new user
$stmt = $mysqli->prepare('INSERT INTO user (username, password) VALUES (?,?)');
$password = $_REQUEST['password'];
$hash_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param('ss', $_REQUEST['username'], $hash_password);
$stmt->execute();

if ($stmt === false) {
    $stmt->close();
    $mysqli->close();
    echo "The query couldn't be processed.";
    exit;
}
$new_user_id = $mysqli->insert_id;
$output['msg'] = "User added with id: " . $new_user_id;

$stmt->close();
$mysqli->close();

echo json_encode($output);

?>
