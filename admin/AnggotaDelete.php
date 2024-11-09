<?php
include "../lib/koneksi.php";

// Check if the id_user parameter is set
if (isset($_GET['id_user']) && is_numeric($_GET['id_user'])) {
    $id_user = mysqli_real_escape_string($link, $_GET['id_user']);

    // Perform the delete operation
    $sql = "DELETE FROM user WHERE id_user = $id_user";
    $result = mysqli_query($link, $sql);

    if ($result) {
        // Redirect to the user list page after successful deletion
        header("Location: Anggota.php");
        exit();
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid or missing id_user parameter.";
}
