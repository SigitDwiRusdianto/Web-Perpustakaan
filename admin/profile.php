<?php
session_start();
$id = $_SESSION['id'];
if (!empty($_SESSION['status'])) {
    include "view/navbar.php";
    include "../lib/koneksi.php";
?>
    <main>
        <div class="container-fluid" style="min-height: 76vh;">
            <div class="row" text-center mb-3>
                <?php include "sidebar.php" ?>
                <div class="col-lg-10 mt-4">
                    <?php
                    include "../lib/koneksi.php";
                    $sql = "SELECT * FROM kategori;";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <h3 class="mb-3">User Information</h3>
                                            <hr>
                                            <?php
                                            include "../lib/koneksi.php";
                                            $sql = "SELECT * FROM user WHERE id_user='$id'";
                                            $result = mysqli_query($link, $sql);
                                            $data = mysqli_fetch_assoc($result);
                                            ?>
                                            <form action="profileAct.php" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="foto" class="form-label">
                                                        <h5 class="mb-3">Profile Picture</h5>
                                                        <img id="ava" src="../assets/<?php echo $data['foto'] ?>" style="width: 100px; height: 100px;" class="rounded-circle">
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
                                                                    $("#ava").attr("src", reader.result);
                                                                }
                                                                reader.readAsDataURL(file);
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                                <div class=" mb-3">
                                                    <label for="nim" class="form-label">
                                                        <h5>Fullname</h5>
                                                    </label>
                                                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $data['fullname']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">
                                                        <h5>Username</h5>
                                                    </label>
                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['username']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">
                                                        <h5>Email</h5>
                                                    </label>
                                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">
                                                        <h5>No HP</h5>
                                                    </label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data['no_hp']; ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
    include "view/footer.php";
} else {
    header('Location: ../login.php');
}
?>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this category?");
    }
</script>