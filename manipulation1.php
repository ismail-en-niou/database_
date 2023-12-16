<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "first-project";
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM `information` WHERE `email` = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, check password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful. Welcome, " . $row['fullname'];
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}
$conn->close();
?>
