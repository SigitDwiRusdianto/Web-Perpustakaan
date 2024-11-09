<?php
session_start();
include "../lib/koneksi.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the name of the user from the user table
$id_user = $_SESSION['id'];
$queryUser = "SELECT fullname FROM user WHERE id_user = '$id_user'";
$resultUser = mysqli_query($link, $queryUser);
$userData = mysqli_fetch_assoc($resultUser);
$nama_anggota = $userData['fullname'];

// Process the book borrowing logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['id'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = date("Y-m-d");  // Set the borrowing date to the current date

    // Set the return date to 7 days from the borrowing date
    $tanggal_pengembalian = date("Y-m-d", strtotime($tanggal_pinjam . "+7 days"));

    // Calculate the fine for late returns (assuming 1,000 IDR per day)
    $denda = 0;
    $today = date("Y-m-d");
    if ($today > $tanggal_pengembalian) {
        $daysLate = floor((strtotime($today) - strtotime($tanggal_pengembalian)) / (60 * 60 * 24));
        $denda = $daysLate * 5000; // Assuming 1,000 IDR per day
    }

    // Insert the borrowing record into the peminjaman_buku table
    $insertQuery = "INSERT INTO peminjaman_buku (id_user, id_buku, tanggal_pinjam, tanggal_pengembalian, denda, status, nama_anggota) 
                    VALUES ('$id_user', '$id_buku', '$tanggal_pinjam', '$tanggal_pengembalian', '$denda', 'Dipinjam', '$nama_anggota')";
    mysqli_query($link, $insertQuery);

    // Update the book quantity in the buku1 table (assuming there's a column named 'jumlah')
    $updateQuery = "UPDATE buku1 SET jumlah = jumlah - 1 WHERE id_buku = '$id_buku'";
    mysqli_query($link, $updateQuery);
}

// Retrieve the list of available books
$queryBooks = "SELECT * FROM buku1 WHERE jumlah > 0";
$resultBooks = mysqli_query($link, $queryBooks);

include "view/navbar.php";
?>

<main>
    <div class="container-fluid" style="min-height: 76vh;">
        <div class="row">
            <?php include "sidebar.php"; ?>
            <div class="col-md-6">
                <h3>Peminjaman Buku</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_anggota" class="form-label">Nama Anggota</label>
                        <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="<?php echo $nama_anggota; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
                        <input type="text" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo date("Y-m-d"); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="id_buku" class="form-label">Pilih Buku</label>
                        <select class="form-select" name="id_buku" required>
                            <option value="" disabled selected>Pilih buku</option>
                            <?php while ($row = mysqli_fetch_assoc($resultBooks)) { ?>
                                <option value="<?php echo $row['id_buku']; ?>"><?php echo $row['judul_buku']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "view/footer.php"; ?>