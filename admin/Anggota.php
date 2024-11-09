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
                    $sql = "SELECT * FROM user WHERE level='user';";
                    $result = mysqli_query($link, $sql);
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <h3 class="mb-3">List Anggota</h3>
                                            <div class="col">
                                                <div class="text-start mb-3">
                                                    <a href="AnggotaAdd.php" class="btn btn-success">Add Anggota</a>
                                                </div>
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th class="text-white" style="background-color: #BF00FF;">Fullname</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Username</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Email</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">No. HP</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Date Join</th>
                                                            <th class="text-white" style="background-color: #BF00FF;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                            <tr class="text-center">
                                                                <td><?php echo $row['fullname']; ?></td>
                                                                <td><?php echo $row['username'] ?></td>
                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><?php echo $row['no_hp']; ?></td>
                                                                <td><?php echo $row['date_join']; ?></td>
                                                                <td class="mx-0 px-0 text-center">
                                                                    <a href="AnggotaDelete.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-danger" onclick="return confirmDelete();">Delete</a>
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
        return confirm("Are you sure you want to delete this user?");
    }
</script>