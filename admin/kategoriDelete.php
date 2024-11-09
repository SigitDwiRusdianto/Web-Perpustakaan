<?php
session_start();
$id = $_SESSION['id'];
if (!empty($_SESSION['status'])) {
    include "../lib/koneksi.php";
    $id_kategori = $_GET['id_kategori'];
    $sql = "DELETE FROM kategori WHERE id_kategori = '$id_kategori'";
    $result = mysqli_query($link, $sql);
    if ($result) {
        header('Location: kategori.php');
        exit();
    } else {
        echo "Failed to delete category.";
    }
} else {
    header('Location: ../login.php');
}
