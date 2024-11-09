<?php
session_start();
$id = $_SESSION['id'];
if (!empty($_SESSION['status'])) {
    include "view/navbar.php";
    include "../lib/koneksi.php";
?>

    <main>
        <div class="container-fluid" style="min-height: 76vh;">
            <div class="row text-center mb-3">
                <?php include "sidebar.php" ?>
                <div class="col-lg-10 mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center mb-4">
                                <img src="../assets/amikom.png" alt="Amikom Logo" width="150" height="150">
                                <h2 class="mt-3">Welcome to Smart Library</h2>
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
    <main>

    </main>
<?php
    include "view/footer.php";
} else {
    header('Location: ../login.php');
}
?>