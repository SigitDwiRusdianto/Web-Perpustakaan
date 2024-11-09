<!DOCTYPE html>

<head>
    <title>Smart Library</title>
    <link rel="stylesheet" link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/amikom.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 1200px;">
        <h1 class="mt-4 mb-4">Informasi Pengguna</h1>
        <?php
        include "../lib/koneksi.php";
        session_start();
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM user WHERE id_user='$id'";
        $result = mysqli_query($link, $sql);
        $data = mysqli_fetch_assoc($result);
        ?>
        <form action="myprofileAct.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="foto" class="form-label">
                    <h6 class="mb-3">Profile Picture</h6>
                    <img id="avatar" src="../assets/<?php echo $data['foto'] ?>" style="width: 100px; height: 100px;" class="rounded-circle">
                    </img>
                </label>
                <input type="hidden" name="default" value="<?php echo $data['foto'] ?>">
                <input id="foto" name="foto" type="file" onchange="previewFile(this);" style="display: none;" />
                <script>
                    function previewFile(input) {
                        var file = $("input[type=file]").get(0).files[0];
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function() {
                                $("#avatar").attr("src", reader.result);
                            }
                            reader.readAsDataURL(file);
                        }
                    }
                </script>
            </div>
            <div class=" mb-3">
                <label for="nim" class="form-label">
                    <h6>Fullname</h6>
                </label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $data['fullname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">
                    <h6>Username</h6>
                </label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">
                    <h6>Email</h6>
                </label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">
                    <h6>No HP</h6>
                </label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data['no_hp']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>