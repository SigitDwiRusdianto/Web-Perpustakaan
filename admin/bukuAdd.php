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
                    <div class="container">
                        <div class="row">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <?php $reqKategori = mysqli_query($link, "SELECT * from kategori"); ?>
                                            <h3>Add buku</h3>
                                            <form method="POST" action="bukuact.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="gambar" class="form-label">Sampul Buku</label>
                                                    <input type="file" class="form-control" id="gambar" name="gambar" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">judul_buku</label>
                                                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pengarang" class="form-label">pengarang</label>
                                                    <textarea class="form-control" id="pengarang" name="pengarang" rows="4" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jumlah" class="form-label">jumlah</label>
                                                    <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Kategori</label>
                                                    <select class="form-control" id="kategori" name="kategori" required>
                                                        <?php while ($kategori = mysqli_fetch_assoc($reqKategori)) {  ?>
                                                            <option value="<?php echo $kategori['id_kategori'] ?>">
                                                                <?php echo $kategori['nama'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="text-start mt-3 mb-3">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    <a href="buku.php" class="btn btn-secondary">Back</a>
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