<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="../assets/amikom.png">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>

<body>
    <header>
        <?php include "../lib/koneksi.php";
        $query = mysqli_query($link, "SELECT * FROM user where id_user = '$id'");
        $data = mysqli_fetch_assoc($query);
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark shadow">
            <div class="container">
                <a class="navbar-brand col-ms-3" href="#">
                    <img src="../assets/logo navbar.png" width="50" height="30">
                    <h2>Smart Library</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item my-auto">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../assets/<?php echo $data['foto'] ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <?php echo $data['fullname'] ?>
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="avatar">
                                    <li><a class="dropdown-item" href="profile.php">My profile</a></li>
                                    <li><a class="dropdown-item" href="password.php">Password</a></li>
                                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <!-- Sidebar -->
    </header>