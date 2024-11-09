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
                    $id_kategori = $_GET['id_kategori'];
                    $sql = "SELECT * FROM kategori where id_kategori=$id_kategori;";
                    $result = mysqli_query($link, $sql);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <form method="POST" action="kategoriEditAct.php">
                                                <input type="hidden" name="id" value="<?php echo $data['id_kategori']; ?>">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">
                                                        <h5 class="m-0">Category Name</h5>
                                                    </label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                                                </div>
                                                <div class="text-start mt-3 mb-3">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    <a href="kategori.php" class="btn btn-secondary">Back</a>
                                                </div>
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
    include "layout/footer.php";
} else {
    header('Location: ../login.php');
}
?>