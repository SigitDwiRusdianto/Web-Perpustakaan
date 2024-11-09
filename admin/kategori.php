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
                                            <h3 class="mb-3">List Categories Buku</h3>
                                            <hr>
                                            <div class="col">
                                                <div class="text-start mb-3">
                                                    <a href="kategoriAdd.php" class="btn btn-success">Add Category Buku</a>
                                                </div>
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th class="text-white" style="background-color: #BF00FF;">category Buku</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                            <tr>
                                                                <td><?php echo $row['nama']; ?></td>
                                                                <td class="mx-0 px-0 text-center">
                                                                    <a href="kategoriEdit.php?id_kategori=<?php echo $row['id_kategori']; ?>" class="btn btn-warning">Edit</a>
                                                                    <a href="kategoriDelete.php?id_kategori=<?php echo $row['id_kategori']; ?>" class="btn btn-danger" onclick="return confirmDelete();">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
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