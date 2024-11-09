<?php
include "lib/koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM user where (username = '$username' or email = '$username') AND password = '$password'";
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    session_start();
    $_SESSION['id'] = $user['id_user'];
    $_SESSION['status'] = 'Login';
    $user['level'] == 'admin' ? header("Location: admin/dashboard.php") : header("Location: anggota/index.php");
} else {
    $errors['invalid'] = 'Username/Email Invalid!';
    header('Location: login.php?pesan=gagal');
}
