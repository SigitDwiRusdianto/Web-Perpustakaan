<?php
session_start();
include "../lib/koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Process the book return logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peminjaman = $_POST['id_peminjaman'];
    $tanggal_pengembalian = date("Y-m-d");

    // Update the borrowing record in the peminjaman_buku table
    $updateQuery = "UPDATE peminjaman_buku SET tanggal_pengembalian = '$tanggal_pengembalian', status = 'Sudah Dikembalikan' WHERE id_peminjaman = '$id_peminjaman'";

    if (mysqli_query($link, $updateQuery)) {
        // Update successful
        // Calculate the fine amount (assuming there's a column named 'denda' in the peminjaman_buku table)
        $dendaQuery = "SELECT denda FROM peminjaman_buku WHERE id_peminjaman = '$id_peminjaman'";
        $dendaResult = mysqli_query($link, $dendaQuery);

        if ($dendaResult) {
            $denda = mysqli_fetch_assoc($dendaResult)['denda'];
            // Display a success message
            $_SESSION['berhasil'] = "Buku berhasil dikembalikan. Denda: $denda";
        } else {
            // Error retrieving denda
            $_SESSION['gagal'] = "Error retrieving fine information.";
        }
    } else {
        // Error updating the record
        $_SESSION['gagal'] = "Error updating borrowing record.";
    }

    header("Location: pengembalian.php");
    exit();
}

// Retrieve the list of borrowed books that have not been returned
$queryBooks = "SELECT pb.id_peminjaman, b.judul_buku, pb.tanggal_pinjam, pb.tanggal_pengembalian
               FROM peminjaman_buku pb
               INNER JOIN buku1 b ON pb.id_buku = b.id_buku
               WHERE pb.status = 'Dipinjam' AND pb.id_user = '" . $_SESSION['id'] . "'";
$resultBooks = mysqli_query($link, $queryBooks);

include "view/navbar.php";
?>

<main>
    <div class="container-fluid" style="min-height: 76vh;">
        <div class="row">
            <?php include "sidebar.php"; ?>
            <div class="col-md-9">
                <h3>Pengembalian Buku</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="id_peminjaman" class="form-label">Pilih Buku yang Akan Dikembalikan</label>
                        <select class="form-select" name="id_peminjaman" required>
                            <option value="" disabled selected>Pilih buku</option>
                            <?php while ($row = mysqli_fetch_assoc($resultBooks)) { ?>
                                <option value="<?php echo $row['id_peminjaman']; ?>">
                                    <?php echo $row['judul_buku'] . " - " . $row['tanggal_pinjam']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Kembalikan Buku</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "view/footer.php"; ?>