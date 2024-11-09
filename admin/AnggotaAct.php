<?php
include "../lib/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];  // Store the raw password in plaintext
    $email = $_POST['email'];
    $noHp = $_POST['noHp'];
    $date_join = date("Y-m-d H:i:s");
    $level = "user";
    $foto = "default.png";

    // Check if the username is already taken
    $checkUsername = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($link, $checkUsername);

    if (mysqli_num_rows($result) > 0) {
        // Username is already taken
        header("location: reg.php?error=username_taken");
        exit();
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO user (fullname, username, password, email, date_join, level, no_hp, foto)
                VALUES ('$fullname', '$username', '$password', '$email', '$date_join', '$level', '$noHp', '$foto')";

        if (mysqli_query($link, $sql)) {
            // Fetch user data after successful registration
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($link, $query);

            if ($user = mysqli_fetch_assoc($result)) {
                session_start();
                $_SESSION['id'] = $user['id_user'];
                $_SESSION['status'] = 'Login';
                header("location: Anggota.php");
                exit();
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }
}

mysqli_close($link);
