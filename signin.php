<?php

include 'connect.php';

session_start(); // mulai sesi buat simpen data user

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Periksa apakah username ada di database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data user ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email']; 
            $_SESSION['username'] = $user['username'];

            // Redirect ke homepage
            header("Location: home.html");
            exit();
        } else {
            // Password salah
            echo "<script>alert('Password salah.'); window.history.back();</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak ditemukan.'); window.history.back();</script>";
    }
}

$conn->close();
?>