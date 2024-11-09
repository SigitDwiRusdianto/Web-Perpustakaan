<?php
include "../lib/koneksi.php";
$nama = $_POST['nama'];

$sql = "INSERT INTO kategori (nama)
VALUES ('$nama')";
if (mysqli_query($link, $sql)) {
    header("location:kategori.php");
}
