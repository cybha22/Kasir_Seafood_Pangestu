<?php
session_start();
require_once "function.php";
if (isset($_POST["login"])) {
    $login = login_akun();
} else if (isset($_POST["register"])) {
    $register = register_akun();
    echo $register > 0
        ? "<script>
            alert('Berhasil Registrasi!');
            location.href = 'login.php';
        </script>"
        : "<script>
            alert('Gagal Registrasi!');
            location.href = 'login.php';
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
    <title>Seafood Pangestu - Login</title>
</head>

<body style="background: #F8F9FA; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                
                <!-- Neo-Brutalism Header -->
                <div class="text-center mb-5">
                    <h1 class="fw-bold mb-3" style="color: #000; font-size: 48px; text-transform: uppercase; letter-spacing: 2px;">
                         SEAFOOD<br>PANGESTU
                    </h1>
                    <div class="p-3" style="background: #000; color: #FFF; border: 4px solid #000; box-shadow: 6px 6px 0px #666;">
                        <h2 class="fw-bold m-0" style="font-size: 24px; text-transform: uppercase;">
                            SISTEM LOGIN
                        </h2>
                    </div>
                </div>

                <!-- Neo-Brutalism Login Card -->
                <div class="p-4" style="background: #FFF; border: 4px solid #000; box-shadow: 8px 8px 0px #666;">
                    
                    <!-- Tab Login & Register -->
                    <div class="d-flex gap-2 mb-4">
                        <button id="tab-login" class="btn fw-bold flex-fill py-3" 
                                style="background: #000; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 16px;">
                            LOGIN
                        </button>
                        <button class="btn fw-bold flex-fill py-3" 
                                style="background: #FFF; color: #000; border: 3px solid #000; box-shadow: 3px 3px 0px #666; font-size: 16px;">
                            REGISTER
                        </button>
                    </div>

                    <!-- Error Message -->
                    <?php if (isset($_POST["login"])) {
                            if (!$login) { ?>
                            <div class="mb-4 p-3" style="background: #FFE6E6; border: 3px solid #DC3545; color: #DC3545;">
                                <strong>❌ LOGIN GAGAL!</strong><br>
                                Username atau password salah
                            </div>
                    <?php }
                    } ?>

                    <!-- Neo-Brutalism Form -->
                    <form id="form" action="login.php" method="POST">
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Username:</label>
                            <input class="form-control py-3 px-4 fw-bold" type="text" autocomplete="off" name="username" placeholder="Masukan username" required 
                                   style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                        </div>
                        
                        <div class="mb-4">
                            <label class="fw-bold mb-2" style="color: #000; font-size: 14px; text-transform: uppercase;">Password:</label>
                            <input class="form-control py-3 px-4 fw-bold" type="password" autocomplete="off" name="password" placeholder="Masukan password" required 
                                   style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                        </div>
                        
                        <button class="btn fw-bold w-100 py-3" name="login" 
                                style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #666; font-size: 18px; text-transform: uppercase;">
                            🔐 LOGIN SEKARANG
                        </button>
                    </form>

                    <!-- Info Default Login -->
                    <div class="mt-4 p-3" style="background: #FFF3CD; border: 3px solid #FFC107;">
                        <small class="fw-bold" style="color: #000;">
                            <strong>💡 INFO LOGIN:</strong><br>
                            Admin: <code>admin</code> / <code>admin</code><br>
                            User: Daftar terlebih dahulu
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./src/css/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/login.js"></script>
</body>

</html>