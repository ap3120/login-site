<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

$username = $_SESSION['username'];

include('config.php');

$mysqli = new mysqli("localhost", $db_user, $db_password, $db_name);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$stmt = $mysqli->prepare("UPDATE user SET access = 1 WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->close();
$mysqli->close();

header('Location: dashboard.php');

?>
