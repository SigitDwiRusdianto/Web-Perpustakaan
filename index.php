<?php
include "view/navbar.php";
include "lib/koneksi.php";
?>
<style>
    body {
        background-image: url(./assets/Home2.jpg);
        background-size: cover;
        min-height: 100vh;
        background-repeat: no-repeat;
        margin-bottom: 50px;
    }

    .Home {
        align-items: center;
        justify-content: center;
        color: white;
        text-align: left;
        margin-top: 30px;
    }

    .content-container {
        max-width: 800px;
        margin-bottom: 50px;
        margin-top: 70px;
    }

    .btn {
        background-color: #BF00FF;
        color: white;
        text-align: left;
        /* Align text to the left */
        margin-bottom: 10px;
    }

    .content-container p {
        text-align: left;
    }
</style>

<main>
    <div class="Home">
        <h1>Welcome To Smart Library</h1>
        <div class="content-container">
            <p>Di Perpustakaan AMIKOM Yogyakarta, Anda akan menjumpai berbagai buku, literatur, diktat kuliah, majalah dan referensi lengkap mengenai ekonomi, manajemen, pemrograman, hingga multimedia.<br>
                Perpustakaan AMIKOM Yogyakarta menyediakan apa yang Anda butuhkan. Mulai dari buku tentang tips memulai karir dan bisnis, memanajemen sebuah organisasi, hingga buku tentang menjadi seorang yang sukses. Karena di UNIVERSITAS AMIKOM Yogyakarta, Anda tidak hanya dibentuk menjadi seorang professional di bidang informatika, namun juga menjadi seorang yang memiliki daya kompetensi yang tinggi dalam dunia bisnis.</p>
        </div>

        <div class="rak">
            <a href="login.php" class="btn btn-primary mr-2">Peminjaman</a>
            <a href="login.php" class="btn btn-primary">Lihat Buku</a>
        </div>
    </div>
    <br>
    <br>
    <br>
</main>


<?php
include "view/footer.php";
?>