<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "first-project";
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$insert = "INSERT INTO `information` (`fullname`, `email`, `password`) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert);
$stmt->bind_param("sss", $fullname, $email, $hashedPassword);
$stmt->execute();
$stmt->close();
$conn->close();

echo "Hello " . $fullname;
?>
