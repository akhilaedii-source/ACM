<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$conn = new mysqli("localhost", "root", "", "xss_demo");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (user_id, comment) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("is", $_SESSION['user_id'], $comment);

    if ($stmt->execute()) {
        echo "Comment submitted successfully!";
    } else {
        echo "Error: Failed to submit comment. " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT users.username, comments.comment FROM comments JOIN users ON comments.user_id = users.id ORDER BY comments.id DESC";
$result = $conn->query($sql);

if ($result === false) {
    die("Error fetching comments: " . $conn->error);
}

$comments = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

    <?php if ($_SESSION['is_admin'] === 'yes'): ?>
        <h3>Admin Panel</h3>
    <?php endif; ?>

    <h3>Comment Section</h3>
    <form method="POST" action="">
        <textarea name="comment" placeholder="Enter your comment" required></textarea>
        <br>
        <input type="submit" value="Submit Comment">
    </form>

    <h3>All Comments:</h3>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?php echo $comment['username']; ?>:</strong>
                <?php echo $comment['comment'];  ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <p><a href="logout.php">Logout</a></p>
</body>
</html>
