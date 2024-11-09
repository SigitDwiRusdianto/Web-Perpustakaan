<?php
session_start();
$id = $_SESSION['id'];
if (!empty($_SESSION['status'])) {
    include "view/navbar.php";
    include "../lib/koneksi.php";

    // Pagination settings
    $results_per_page = 10;

    // Check current page
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    // Calculate the starting row
    $start_from = ($page - 1) * $results_per_page;

    // Query to fetch limited data with book title, ordered by date of borrowing (latest first)
    // Query to fetch limited data with book title, ordered by the highest id_peminjaman first
    $sql = "SELECT p.*, b.judul_buku FROM peminjaman_buku p
JOIN buku1 b ON p.id_buku = b.id_buku
ORDER BY p.id_peminjaman DESC
LIMIT $start_from, $results_per_page;";
    $result = mysqli_query($link, $sql);

?>

    <main class="container-fluid">
        <div class="row">
            <?php include "sidebar.php"; ?>
            <div class="col-md-9 mt-4">
                <h3>Data Peminjaman</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>ID User</th>
                            <th>ID Buku</th>
                            <th>Judul Buku</th> <!-- New column for book title -->
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Denda</th>
                            <th>Status</th>
                            <th>Nama Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['id_peminjaman']; ?></td>
                                    <td><?php echo $row['id_user']; ?></td>
                                    <td><?php echo $row['id_buku']; ?></td>
                                    <td><?php echo $row['judul_buku']; ?></td> <!-- Display book title -->
                                    <td><?php echo $row['tanggal_pinjam']; ?></td>
                                    <td><?php echo $row['tanggal_pengembalian']; ?></td>
                                    <td><?php echo $row['denda']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['nama_anggota']; ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "Query failed: " . mysqli_error($link);
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        $sql_pagination = "SELECT COUNT(id_peminjaman) AS total FROM peminjaman_buku;";
                        $result_pagination = mysqli_query($link, $sql_pagination);
                        $row_pagination = mysqli_fetch_assoc($result_pagination);
                        $total_pages = ceil($row_pagination['total'] / $results_per_page);

                        // Previous button
                        if ($page > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                        }

                        // Page numbers
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }

                        // Next button
                        if ($page < $total_pages) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

<?php include "view/footer.php"; // Include your footer file 
}
?>