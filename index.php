<?php

session_start();

require_once "function.php";

if (!isset($_SESSION["akun-admin"]) && !isset($_SESSION["akun-user"])) {

    header("Location: login.php");

    exit;

} 



if (isset($_GET["transaksi"])) {

    $menu = ambil_data("SELECT * FROM transaksi");
    
} else if (isset($_GET["pesanan"])) {

    $menu = ambil_data("SELECT p.kode_pesanan, tk.nama_pelanggan, p.kode_menu, p.qty

                        FROM pesanan AS p

                        JOIN transaksi AS tk ON (tk.kode_pesanan = p.kode_pesanan)

                      ");

} else {

    // Base query
    $base_query = "SELECT * FROM menu";
    $where_conditions = [];
    
    // Filter berdasarkan kategori
    if (isset($_GET["kategori"]) && !empty($_GET["kategori"])) {
        $kategori = $_GET["kategori"];
        $where_conditions[] = "kategori = '$kategori'";
    }
    
    // Filter berdasarkan pencarian
    if (isset($_GET["search"]) && !empty($_GET["key-search"])) {
        $key_search = $_GET["key-search"];
        $where_conditions[] = "(nama LIKE '%$key_search%' OR 
                               harga LIKE '%$key_search%' OR 
                               kategori LIKE '%$key_search%' OR 
                               `status` LIKE '%$key_search%')";
    }
    
    // Gabungkan kondisi WHERE
    if (!empty($where_conditions)) {
        $base_query .= " WHERE " . implode(" AND ", $where_conditions);
    }
    
    $base_query .= " ORDER BY kode_menu DESC";
    
    $menu = ambil_data($base_query);

}



if (isset($_POST["pesan"])) {

    $pesanan = tambah_data_pesanan();

    echo $pesanan > 0

    ? "<script>

        alert('Pesanan Berhasil Dikirim!');

    </script>"

    : "<script>

        alert('Pesanan Gagal Dikirim!');

    </script>";

}

?>



<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="./src/css/bootstrap-5.2.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="./src/css/bootstrap-icons-1.8.3/bootstrap-icons.css">

    <title>Seafood Pangestu - Restoran</title>

<body style="background: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <!-- Neo-Brutalism Header -->
    <div class="container-fluid position-fixed top-0 p-3 d-flex justify-content-between align-items-center" 
         style="z-index: 1000; background: #FFF; border-bottom: 4px solid #000; box-shadow: 0 4px 0px #000;">

        <div class="d-flex align-items-center">
            <span id="menu-list" role="button" class="me-3 p-2" 
                  style="background: #000; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 18px; font-weight: bold; cursor: pointer;">
                <i class="bi bi-list"></i>
            </span>
            <h2 class="fw-bold m-0" style="color: #000; font-size: 24px; text-transform: uppercase; letter-spacing: 1px;">
                SEAFOOD PANGESTU
            </h2>
        </div>

        <a class="btn fw-bold px-4 py-2" href="logout.php" onclick="return confirm('Yakin ingin logout?')" 
           style="background: #DC3545; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 14px; text-transform: uppercase;">
            LOGOUT
        </a>

    </div>

    <!-- Neo-Brutalism Sidebar -->
    <div id="dropdown-menu" class="position-fixed vh-100 p-4" 
         style="display: none; z-index: 999; top: 80px; left: 0; width: 280px; background: #FFF; border-right: 4px solid #000; box-shadow: 4px 0px 0px #000;">
        
        <h4 class="fw-bold mb-4" style="color: #000; text-transform: uppercase; border-bottom: 3px solid #000; padding-bottom: 10px;">
            📋 NAVIGASI
        </h4>

        <div class="d-grid gap-3">
            <a class="btn fw-bold py-3 text-decoration-none" href="index.php" 
               style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 16px; text-transform: uppercase;">
                🍽️ MENU UTAMA
            </a>

            <?php if (isset($_SESSION["akun-admin"])) { ?>
            <a class="btn fw-bold py-3 text-decoration-none" href="index.php?pesanan" 
               style="background: #FFC107; color: #000; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 16px; text-transform: uppercase;">
                📋 PESANAN
            </a>
            
            <a class="btn fw-bold py-3 text-decoration-none" href="index.php?transaksi" 
               style="background: #17A2B8; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 16px; text-transform: uppercase;">
                💰 TRANSAKSI
            </a>
            <?php } ?>
        </div>

    </div>

    <!-- Neo-Brutalism Content -->
    <div class="container-fluid" style="margin-top: 90px; padding: 20px;">

    <?php

    if (isset($_GET["pesanan"])) include "halaman/pesanan.php";

    else if (isset($_GET["transaksi"])) include "halaman/transaksi.php";

    else include "halaman/beranda.php";

    ?>

    </div>

    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.min.js"></script>

    <script src="src/js/beranda.js"></script>

</body>



</html>