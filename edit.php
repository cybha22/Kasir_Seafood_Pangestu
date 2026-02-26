<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"])) {
    if (isset($_SESSION["akun-user"])) {
        echo "<script>
            alert('Edit data hanya berlaku untuk admin!');
            location.href = 'index.php';
        </script>";
        exit;
    } else {
        header("Location: login.php");
        exit;
    }
}



if (isset($_POST["edit"])) {

    $edit = edit_data_menu();

    if ($edit > 0) {

        echo "<script>

                alert('Data berhasil diubah!');

                location.href = 'index.php';

            </script>";

    } else if ($edit == 0) {

        echo "<script>

                alert('Data tidak ada yang diubah!');

                location.href = 'index.php';

            </script>";

    } else {

        echo "<script>

                alert('Data gagal diubah!');

                location.href = 'index.php';

            </script>";

    }

}

$id_menu = $_GET["id_menu"];

$menu = ambil_data("SELECT * FROM menu WHERE id_menu = $id_menu")[0];

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">

    <title>Seafood Pangestu - Edit Menu</title>

</head>

<body style="background: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; padding: 20px 0;">

    <div class="container">
        
        <!-- Neo-Brutalism Header -->
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="fw-bold m-0" style="color: #000; font-size: 32px; text-transform: uppercase;">
                    EDIT DATA MENU
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
                    
                    <form action="edit.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_menu" value="<?= $menu["id_menu"]; ?>">
                        <input type="hidden" name="gambar-lama" value="<?= $menu["gambar"]; ?>">
                        <input type="hidden" name="kode_menu" value="<?= $menu["kode_menu"]; ?>">

                        <!-- Nama Makanan -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Nama Makanan:</label>
                            <input type="text" name="nama" class="form-control py-3 px-4 fw-bold" value="<?= $menu["nama"]; ?>" required 
                                   style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Harga (Rp):</label>
                            <input min="0" type="number" name="harga" class="form-control py-3 px-4 fw-bold" value="<?= $menu["harga"]; ?>" required 
                                   style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Gambar Menu:</label>
                            <div class="p-3" style="background: #F8F9FA; border: 3px solid #000;">
                                <div class="mb-3">
                                    <img src="src/img/<?= $menu["gambar"]; ?>" class="img-fluid" style="max-height: 100px; border: 2px solid #000;">
                                    <small class="d-block mt-2 fw-bold">Gambar saat ini</small>
                                </div>
                                <input type="file" name="gambar" accept="image/*" class="form-control py-2 px-3" 
                                       style="border: 2px solid #666; background: #FFF;">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Kategori:</label>
                            <select name="kategori" class="form-select py-3 px-4 fw-bold" 
                                    style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                                <option value="Makanan" <?= $menu["kategori"] == "Makanan" ? "selected" : ""; ?>>Makanan</option>
                                <option value="Fast Food" <?= $menu["kategori"] == "Fast Food" ? "selected" : ""; ?>>Fast Food</option>
                                <option value="Snack" <?= $menu["kategori"] == "Snack" ? "selected" : ""; ?>>Snack</option>
                                <option value="Dessert" <?= $menu["kategori"] == "Dessert" ? "selected" : ""; ?>>Dessert</option>
                                <option value="Minuman" <?= $menu["kategori"] == "Minuman" ? "selected" : ""; ?>>Minuman</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="fw-bold mb-3 d-block" style="color: #000; font-size: 14px; text-transform: uppercase;">Status Menu:</label>
                            <div class="d-flex gap-3">
                                <div class="p-3 flex-fill" style="background: #E8F5E8; border: 3px solid #28A745;">
                                    <label class="fw-bold d-flex align-items-center">
                                        <input type="radio" name="status" value="tersedia" <?= $menu["status"] == "tersedia" ? "checked" : ""; ?> class="me-2" style="transform: scale(1.2);">
                                        TERSEDIA
                                    </label>
                                </div>
                                <div class="p-3 flex-fill" style="background: #FFE6E6; border: 3px solid #DC3545;">
                                    <label class="fw-bold d-flex align-items-center">
                                        <input type="radio" name="status" value="tidak tersedia" <?= $menu["status"] == "tidak tersedia" ? "checked" : ""; ?> class="me-2" style="transform: scale(1.2);">
                                        TIDAK TERSEDIA
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button class="btn fw-bold px-5 py-3" name="edit" 
                                    style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #666; font-size: 18px; text-transform: uppercase;">
                                SIMPAN PERUBAHAN
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>


</html>