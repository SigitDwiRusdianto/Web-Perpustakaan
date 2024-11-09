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
                                            <h3 class="mb-3">Change Password</h3>
                                            <hr>
                                            <div class="col">
                                                <form method="POST" action="passwordAct.php" class="validate">
                                                    <div class="mb-3">
                                                        <label for="oldpass" class="form-label">Old Password</label>
                                                        <input type="password" class="form-control" id="oldpass" name="oldpass" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="newpass" class="form-label">New Password</label>
                                                            <input type="password" class="form-control" id="newpass" name="newpass" required>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="newpass" class="form-label">Re-type New Password</label>
                                                            <input type="password" class="form-control" id="renewpass" name="renewpass" required>
                                                            <div style="margin-top: 7px;" id="CheckPasswordMatch"><br></div>
                                                        </div>
                                                    </div>
                                                    <div class="text-start mb-3">
                                                        <button type="submit" class="btn btn-primary" id="formButton">Save</button>
                                                    </div>
                                                </form>
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
    <script>
        $(document).ready(function() {
            // Cache the formButton element to avoid redundant DOM selection
            var formButton = $("#formButton");
            formButton.prop('disabled', true).addClass('disabled');
            $("#renewpass").on('keyup', function() {
                var password = $("#newpass").val();
                var confirmPassword = $("#renewpass").val();

                if (password !== confirmPassword) {
                    $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
                } else {
                    $("#CheckPasswordMatch").html("Password match !").css("color", "green");
                    formButton.prop('disabled', false).removeClass('disabled');
                }
            });
        });
    </script>
<?php
    include "view/footer.php";
} else {
    header('Location: ../login.php');
}
?>