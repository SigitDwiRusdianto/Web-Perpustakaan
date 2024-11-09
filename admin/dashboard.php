<?php
session_start();
$id = $_SESSION['id'];
if (!empty($_SESSION['status'])) {
    include "view/navbar.php";
    include "../lib/koneksi.php";

    // Process the book return logic
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peminjaman = $_POST['id_peminjaman'];
        $tanggal_pengembalian = date("Y-m-d");

        // Update the borrowing record in the peminjaman_buku table
        $updateQuery = "UPDATE peminjaman_buku SET tanggal_pengembalian = '$tanggal_pengembalian', status = 'Sudah Dikembalikan' WHERE id_peminjaman = '$id_peminjaman'";

        if (mysqli_query($link, $updateQuery)) {
            // Update successful
            // Decrease the total borrowings count
            mysqli_query($link, "UPDATE peminjaman_buku SET total_borrowings = total_borrowings - 1 WHERE status = 'Dipinjam'");

            // Display a success message
            $_SESSION['berhasil'] = "Buku berhasil dikembalikan.";
        } else {
            // Error updating the record
            $_SESSION['gagal'] = "Error updating borrowing record.";
        }

        header("Location: pengembalian.php");
        exit();
    }

    // Fetch statistics
    $query_books = mysqli_query($link, "SELECT COUNT(*) AS total_books FROM buku1;");
    $total_books = mysqli_fetch_assoc($query_books)['total_books'];

    $query_users = mysqli_query($link, "SELECT COUNT(*) AS total_users FROM user WHERE level = 'user';");
    $total_users = mysqli_fetch_assoc($query_users)['total_users'];

    $query_borrowings = mysqli_query($link, "SELECT COUNT(*) AS total_borrowings FROM peminjaman_buku WHERE status = 'Dipinjam';");
    $total_borrowings = mysqli_fetch_assoc($query_borrowings)['total_borrowings'];
?>
    <main>
        <div class="container-fluid" style="min-height: 76vh;">
            <div class="row text-center mb-3">
                <?php include "sidebar.php" ?>
                <div class="col-lg-10 mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Books</h5>
                                        <p class="card-text"><?= $total_books ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Users</h5>
                                        <p class="card-text"><?= $total_users ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Borrowings</h5>
                                        <p class="card-text"><?= $total_borrowings ?></p>
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