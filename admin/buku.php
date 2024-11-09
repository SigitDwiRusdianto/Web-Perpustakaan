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
                    $sql = "SELECT * FROM buku1;";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <h3 class="mb-3">Buku</h3>
                                            <hr>
                                            <div class="col">
                                                <div class="text-start mb-3">
                                                    <a href="bukuAdd.php" class="btn btn-success">Add buku</a>
                                                </div>
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th class="text-white" style="background-color: #BF00FF;">Judul_buku</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Sampul</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">pengarang</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Jumlah</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                            <tr>
                                                                <td><?php echo $row['judul_buku']; ?></td>
                                                                <td class="text-center">
                                                                    <img src="../assets/<?php echo $row['gambar']; ?>" alt="Image" style="width: 8cm; height: 10cm;">
                                                                </td>
                                                                <td class="text-center"><?php echo $row['pengarang'] ?></td>
                                                                <td class="text-center"><?php echo $row['jumlah'] ?></td>
                                                                <td class="mx-0 px-0 text-center">
                                                                    <a href="bukuEdit.php?id_event=<?php echo $row['id_buku']; ?>" class="btn btn-warning">Manage</a>
                                                                    <a href="bukuDelete.php?id_event=<?php echo $row['id_buku']; ?>" class="btn btn-danger" onclick="return confirmDelete();">Delete</a>
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
        return confirm("Are you sure you want to delete this event?");
    }
</script>