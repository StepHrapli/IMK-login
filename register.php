<?php

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // buat meriksa email atau user name ada di dbase
    $query = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // buat meriksa data yang udh ada di dbase
        $existing = $result->fetch_assoc();

        if ($existing['email'] === $email && $existing['username'] === $username) {
            echo "<script>alert('Email dan Username sudah terdaftar.'); window.history.back();</script>";
        } elseif ($existing['email'] === $email) {
            echo "<script>alert('Email sudah terdaftar.'); window.history.back();</script>";
        } elseif ($existing['username'] === $username) {
            echo "<script>alert('Username sudah terdaftar.'); window.history.back();</script>";
        }
    } else {
        // Insert data user baru ke database
        $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
        if ($conn->query($query) === TRUE) {
            // Registrasi berhasil
            echo "<script>alert('Registrasi berhasil!'); window.location.href = 'signin.html';</script>";
        } else {
            // Error saat menyimpan data
            echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.'); window.history.back();</script>";
        }
    }
}

$conn->close();
?>