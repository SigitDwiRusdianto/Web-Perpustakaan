<?php
session_start();
$id = $_SESSION['id'];
if (!empty($_SESSION['status'])) {
    include "view/navbar.php";
    include "../lib/koneksi.php";

    // Fetching categories
    $queryCategories = "SELECT * FROM kategori";
    $resultCategories = mysqli_query($link, $queryCategories);
?>

    <main>
        <div class="container-fluid" style="min-height: 76vh;">
            <div class="row">
                <?php include "sidebar.php" ?>
                <div class="col-lg-8 mt-4">
                    <?php
                    include "../lib/koneksi.php";

                    // Handling category filter
                    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
                    $categoryFilterQuery = $categoryFilter ? "WHERE id_kategori = '$categoryFilter'" : '';

                    $sql = "SELECT * FROM buku1 $categoryFilterQuery;";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <div class="container">
                        <div class="row">
                            <h3 class="mb-3">Buku</h3>

                            <!-- Category filter form -->
                            <form method="get" class="mb-3">
                                <label for="category" class="form-label">Filter by Kategori:</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="">All Kategori</option>
                                    <?php
                                    while ($category = mysqli_fetch_assoc($resultCategories)) {
                                        $selected = ($categoryFilter == $category['id_kategori']) ? 'selected' : '';
                                        echo "<option value='{$category['id_kategori']}' $selected>{$category['nama']}</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                            </form>

                            <hr>

                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="../assets/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['judul_buku']; ?></h5>
                                            <p class="card-text">Pengarang: <?php echo $row['pengarang'] ?></p>
                                            <p class="card-text">deskripsi: <?php echo $row['deskripsi'] ?></p>
                                            <form action="peminjaman.php" method="post">
                                                <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                                                <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(function() {
            $('#sidebar a').click(function(e) {
                $('#sidebar a').removeClass('active');
                $(this).addClass('active');
            })
        })
    </script>

<?php
    include "view/footer.php";
} else {
    header('Location: ../login.php');
}
?>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this book?");
    }
</script>