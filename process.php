<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "sql201.infinityfree.com";
$dbname = "if0_41571477_studentform";
$username = "if0_41571477";
$password = "Montefiore38$$";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if (empty($name) || empty($email)) {
    die("Please fill out all required fields.");
}

$stmt = $conn->prepare("INSERT INTO submissions (name, email) VALUES (?, ?)");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ss", $name, $email);

if ($stmt->execute()) {
    echo "<h2>Signup Successful</h2>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Email: " . htmlspecialchars($email);
} else {
    die("Execute failed: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
