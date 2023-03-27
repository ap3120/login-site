<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


include('config.php');

$mysqli = new mysqli("localhost",$db_user,$db_password,$db_name);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$stmt = $mysqli->prepare('INSERT INTO user (username, password) VALUES (?,?)');
$stmt->bind_param('ss', $_REQUEST['r-username'], $_REQUEST['r-pw']);
$stmt->execute();
$result = $stmt->get_result();

echo $result;

$stmt->close();
$mysqli->close();

?>
