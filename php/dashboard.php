<!DOCTYPE html>

<html>
<head>
<title>Dashboard</title>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>

<body>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.html');
    exit;
}

$username = $_SESSION['username'];
?>

<h1>Welcome <?php echo $username; ?></h1>
<a href='logout.php'>Logout</a>
</body>
</html>
