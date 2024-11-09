<?php
include "../lib/koneksi.php";
$id_kategori = $_POST['id'];
$nama = $_POST['nama'];

$sql = "UPDATE kategori SET nama='$nama'where id_kategori='$id_kategori'";
if (mysqli_query($link, $sql)) {
    header("location:kategori.php");
}
