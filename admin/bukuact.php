<?php
include "../lib/koneksi.php";
$judul_buku = $_POST['judul_buku'];
$pengarang = $_POST['pengarang'];
$deskripsi = $_POST['deskripsi'];
$jumlah = $_POST['jumlah'];
$id_kategori = $_POST['kategori'];

$gambar = $_FILES['gambar']['name'];
$target_dir = "../assets/";
$target_file = $target_dir . basename($gambar);
$uploadOk = 1;
if ($uploadOk == 1) {
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_dir . $gambar);
}
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
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

// Qury update data
$sql = "INSERT INTO buku1 (judul_buku, pengarang, gambar, deskripsi, jumlah, id_kategori)
VALUES ('$judul_buku', '$pengarang', '$gambar', '$deskripsi', '$jumlah','$id_kategori')";
if (mysqli_query($link, $sql)) {
    header("location:buku.php");
}
