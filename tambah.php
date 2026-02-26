<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Tambah data hanya berlaku untuk admin!');
            location.href = 'index.php';
        </script>";
    } else {
        header("Location: login.php");
        exit;
    }
}



if (isset($_POST["tambah"])) {

    $tambah = tambah_data_menu();

    echo $tambah > 0

        ? "<script>

        alert('Data berhasil ditambah!');

        location.href = 'index.php';

    </script>"

        : "<script>

        alert('Data gagal ditambah!');

        location.href = 'index.php';

    </script>";

}

?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">

    <title>Seafood Pangestu - Tambah Menu</title>

</head>

<body style="background: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; padding: 20px 0;">

    <div class="container">

        <!-- Neo-Brutalism Header -->
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="fw-bold m-0" style="color: #000; font-size: 32px; text-transform: uppercase;">
                    TAMBAH MENU BARU
                </h1>
                <a class="btn fw-bold px-4 py-2" href="index.php" 
                   style="background: #DC3545; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 16px;">
                    KEMBALI
                </a>
            </div>
        </div>

        <!-- Neo-Brutalism Form Card -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="p-4" style="background: #FFF; border: 4px solid #000; box-shadow: 8px 8px 0px #666;">
                    
                    <form action="tambah.php" method="POST" enctype="multipart/form-data">

                        <!-- Nama Makanan -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Nama Makanan:</label>
                            <input autocomplete="off" type="text" name="nama" class="form-control py-3 px-4 fw-bold" placeholder="Masukan nama menu" required 
                                   style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Harga (Rp):</label>
                            <input min="0" type="number" name="harga" class="form-control py-3 px-4 fw-bold" placeholder="0" required 
                                   style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Gambar Menu:</label>
                            <div class="p-3" style="background: #F8F9FA; border: 3px solid #000;">
                                <input type="file" name="gambar" accept="image/*" required class="form-control py-2 px-3" 
                                       style="border: 2px solid #666; background: #FFF;">
                                <small class="text-muted mt-2 d-block">Upload gambar menu (JPG, PNG, GIF)</small>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Kategori:</label>
                            <select name="kategori" class="form-select py-3 px-4 fw-bold" 
                                    style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                                <option selected value="Makanan">Makanan</option>
                                <option value="Fast Food">Fast Food</option>
                                <option value="Snack">Snack</option>
                                <option value="Dessert">Dessert</option>
                                <option value="Minuman">Minuman</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="fw-bold mb-3 d-block" style="color: #000; font-size: 14px; text-transform: uppercase;">Status Menu:</label>
                            <div class="d-flex gap-3">
                                <div class="p-3 flex-fill" style="background: #E8F5E8; border: 3px solid #28A745;">
                                    <label class="fw-bold d-flex align-items-center">
                                        <input type="radio" name="status" value="tersedia" checked class="me-2" style="transform: scale(1.2);">
                                        TERSEDIA
                                    </label>
                                </div>
                                <div class="p-3 flex-fill" style="background: #FFE6E6; border: 3px solid #DC3545;">
                                    <label class="fw-bold d-flex align-items-center">
                                        <input type="radio" name="status" value="tidak tersedia" class="me-2" style="transform: scale(1.2);">
                                        TIDAK TERSEDIA
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button class="btn fw-bold px-5 py-3" name="tambah" 
                                    style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #666; font-size: 18px; text-transform: uppercase;">
                                TAMBAH MENU
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>

</body>


</html>