<?php
session_start();
$conn = new mysqli("localhost", "root", "", "challenges_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = " . intval($user_id);
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    echo "User  not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>Your User ID: <?php echo htmlspecialchars($user_id); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
