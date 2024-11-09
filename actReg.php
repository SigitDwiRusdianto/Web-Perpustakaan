<?php
include "lib/koneksi.php";
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$noHp = $_POST['noHp'];
$date_join = date("Y-m-d H:i:s");
$level = "admin";
$foto = "default.png";
$sql = "INSERT INTO user (fullname,username,password,email,date_join,level,no_hp,foto) VALUES ('$fullname','$username','$password','$email','$date_join','$level','$noHp','$foto')";
if (mysqli_query($link, $sql)) {
    header("location:login.php");
} else {
    header("location:reg.php");
}
