<?php
session_start();
$id = $_SESSION['id'];
include "../lib/koneksi.php";
$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$result = mysqli_query($link, "SELECT * FROM user where id_user=$id and password='$oldpass' ");
if (mysqli_num_rows($result) == 1) {
    $updatePassword = mysqli_query($link, "UPDATE user set password='$newpass' where id_user=$id");
    if ($updatePassword) {
        // Password updated successfully
        echo "<script>alert('Password updated successfully')
        window.location.replace('dashboard.php')</script>";
    } else {
        // Error updating password
        $message = "Error updating password!";
        echo "<script>alert('$message')
        window.location.replace('password.php')</script>";
    }
} else {
    // Wrong old password
    $message = "Wrong Old Password!";
    echo "<script>alert('$message')
    window.location.replace('password.php')</script>";
}
