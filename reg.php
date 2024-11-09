<!DOCTYPE html>

<head>
    <title>Register</title>
    <link rel="stylesheet" link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="assets/Logo Nirtic polos.png">
    <style>
        body {
            background-image: url('./assets/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .btn {
            background-color: #021780;
            color: white;
            display: block !important;
        }

        a {
            text-decoration: none;
        }

        .error {
            color: red;
        }

        .img-center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <form action="actReg.php" method="POST">
                                <img src="assets/logoamikom.png" alt="Logo" width="150" height="50" class="img-center">
                                <div class="mb-3 text-center">
                                    <h2>REGISTER</h2>
                                    <hr>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="noHp" name="noHp" placeholder="No. HP" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3">Register</button>
                                <div class="text-center">
                                    <hr>
                                    <a href="login.php">Already have an account? Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>