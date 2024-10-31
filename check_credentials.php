<?php


$conn = new mysqli('localhost', 'root', 'basil2004', 'student_portal');


if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}


$username = $_POST['username'];
$password = $_POST['password'];


$stmt = $conn->prepare("SELECT * FROM students WHERE username =?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();


$row = $result->fetch_assoc();


if ($row && $row['password'] == $password) {
    session_start();
    $_SESSION['username'] = $row['username'];
    header('Location: dashboard.html');
} else {
    echo "Invalid username or password";
}

$stmt->close();
$conn->close();

?>