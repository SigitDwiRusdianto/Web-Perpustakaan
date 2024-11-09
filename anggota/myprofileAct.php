<?php
include "../lib/koneksi.php";
// Get data form
session_start();
$id = $_SESSION['id'];
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$foto = $_FILES['foto']['name'];
if (empty($foto)) {
    $foto = $_POST['default'];
} else {
    $target_dir = "../assets/";
    $target_file = $target_dir . basename($foto);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/' . $foto);
    }
}
$sql = "UPDATE user SET fullname='$fullname', username='$username', no_hp='$no_hp', email='$email', foto='$foto' where id_user='$id'";
if (mysqli_query($link, $sql)) {
    header("location: index.php");
}
