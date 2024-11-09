<?php
session_start();
if (!empty($_SESSION['status'])) {
    include "../lib/koneksi.php";

    // Check if id_buku is set and is a valid integer
    if (isset($_GET['id_event']) && is_numeric($_GET['id_event'])) {
        $id_buku = mysqli_real_escape_string($link, $_GET['id_event']);

        // Use a prepared statement to prevent SQL injection
        $sql = "DELETE FROM buku1 WHERE id_buku = ?";
        $stmt = mysqli_prepare($link, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_buku);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // Record deleted successfully
                $_SESSION['success_message'] = "Buku deleted successfully!";
                header("location: buku.php");
                exit();
            } else {
                // Error in execution
                $_SESSION['error_message'] = "Failed to delete buku.";
                header("location: buku.php");
                exit();
            }

            mysqli_stmt_close($stmt);
        } else {
            // Error in preparing the statement
            $_SESSION['error_message'] = "Failed to prepare the statement.";
            header("location: buku.php");
            exit();
        }
    } else {
        // Invalid or missing id_event parameter
        $_SESSION['error_message'] = "Invalid or missing id_event parameter.";
        header("location: buku.php");
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
