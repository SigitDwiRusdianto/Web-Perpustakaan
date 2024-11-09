<?php
session_start();
include "../lib/koneksi.php";

$id_buku = isset($_GET['id_buku']) ? $_GET['id_buku'] : null;

if (empty($id_buku) || !is_numeric($id_buku)) {
    die("Invalid or missing id_buku parameter.");
}

$sql = "SELECT * FROM buku1 WHERE id_buku = $id_buku";
$result = mysqli_query($link, $sql);

if (!$result) {
    die("Error in SQL query: " . mysqli_error($link));
}

$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Book not found.");
}

$reqKategori = mysqli_query($link, "SELECT * FROM kategori");

include "view/navbar.php";
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
                                <form method="POST" action="bukuact.php" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $data['id_buku']; ?>">
                                    <div class="mb-3">
                                        <h5>sampul buku</h5>
                                        <img src="../assets/<?php echo $data['gambar']; ?>" class="rounded w-50" alt="Poster">
                                        <input type="file" class="form-control" id="gambar" name="gambar">
                                        <input type="hidden" name="default" value="<?php echo $data['gambar']; ?>">
                                    </div>
                                    <!-- Other form fields go here -->
                                    <div class="text-start mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <a href="event.php" class="btn btn-secondary">Back</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "view/footer.php"; ?>