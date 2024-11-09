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
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            ?>
                                            <h3>Tambahkan category baru</h3>
                                            <form method="POST" action="kategoriAddAct.php">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Category Name</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                                </div>
                                                <div class="text-start mt-3 mb-3">
                                                    <button type="submit" class="btn btn-primary">Tambahkan category</button>
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
    include "view/footer.php";
} else {
    header('Location: ../login.php');
}
?>