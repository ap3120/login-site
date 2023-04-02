<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

$username = $_SESSION['username'];
$access = 0;

include('config.php');
$mysqli = new mysqli("localhost", $db_user, $db_password, $db_name);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$stmt = $mysqli->prepare("SELECT * from user WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $access = $row['access'];
}

$stmt->close();
$mysqli->close();

?>

<!DOCTYPE html>

<html>
<head>
<title>Dashboard</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>

<body>
<h1>Welcome <?php echo $username; ?></h1>
<a href='logout.php'>Logout</a>
<?php if ($access == 0) {?>
    <form action='get_access.php' method='POST'>
        <input type='submit' value='Get my video'>
    </form>
<?php } else {?>
    <a href='video.php'>View video</a>
<?php }?>

</body>
</html>
