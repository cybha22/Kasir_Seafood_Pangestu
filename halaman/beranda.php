<!-- Neo-Brutalism Search & Filter Section -->
<div class="mb-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <form action="index.php" method="GET" class="d-flex">
                <div class="input-group">
                    <input class="form-control py-3 px-4 fw-bold" type="search" autocomplete="off" name="key-search" placeholder="Cari menu favorit..." 
                           style="background: #F8F9FA; border: 3px solid #000; border-right: none; font-size: 16px;" value="<?= isset($_GET['key-search']) ? $_GET['key-search'] : ''; ?>">
                    <button class="btn fw-bold px-4" name="search" 
                            style="background: #000; color: #FFF; border: 3px solid #000; font-size: 16px;">
                        CARI
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <form action="index.php" method="GET">
                <select name="kategori" class="form-select py-3 px-4 fw-bold" onchange="this.form.submit()" 
                        style="background: #F8F9FA; border: 3px solid #000; font-size: 16px;">
                    <option value="">🍽️ SEMUA KATEGORI</option>
                    <option value="Makanan" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Makanan' ? 'selected' : ''; ?>>🍛 MAKANAN</option>
                    <option value="Fast Food" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Fast Food' ? 'selected' : ''; ?>>🍔 FAST FOOD</option>
                    <option value="Snack" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Snack' ? 'selected' : ''; ?>>🍿 SNACK</option>
                    <option value="Dessert" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Dessert' ? 'selected' : ''; ?>>🍰 DESSERT</option>
                    <option value="Minuman" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'Minuman' ? 'selected' : ''; ?>>🥤 MINUMAN</option>
                </select>
            </form>
        </div>
        <?php if (isset($_SESSION["akun-admin"])) { ?>
        <div class="col-md-3 text-end">
            <a class="btn fw-bold px-4 py-3 text-decoration-none w-100" href="tambah.php" 
               style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #000; font-size: 16px;">
                + TAMBAH MENU
            </a>
        </div>
        <?php } else { ?>
        <div class="col-md-3">
            <!-- Spacer untuk user agar layout tetap rapi -->
        </div>
        <?php } ?>
    </div>
    
    <!-- Filter Status Info -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <?php if (isset($_GET['kategori']) && !empty($_GET['kategori'])) { ?>
            <div class="p-2 d-inline-block" style="background: #E3F2FD; border: 2px solid #000;">
                <small class="fw-bold">📂 Filter: <?= $_GET['kategori']; ?></small>
                <a href="index.php" class="ms-2 text-decoration-none fw-bold" style="color: #DC3545;">✖ Hapus Filter</a>
            </div>
            <?php } ?>
        </div>
        <div class="p-2" style="background: #F8F9FA; border: 2px solid #000;">
            <small class="fw-bold">📊 Ditemukan: <?= count($menu); ?> menu</small>
        </div>
    </div>
</div>
<!-- Neo-Brutalism Order Section -->
<?php if (!isset($_SESSION["akun-admin"])) { ?>
<div class="mb-4 p-4" style="background: #FFF3CD; border: 3px solid #000; box-shadow: 6px 6px 0px #000;">
    <h4 class="fw-bold mb-3" style="color: #000;">📋 PANDUAN PEMESANAN</h4>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="p-2" style="background: #E3F2FD; border: 2px solid #000;">
                <strong>1.</strong> Isi nama pelanggan
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="p-2" style="background: #E8F5E8; border: 2px solid #000;">
                <strong>2.</strong> Pilih menu & qty
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="p-2" style="background: #FFE6E6; border: 2px solid #000;">
                <strong>3.</strong> Klik pesan sekarang
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Neo-Brutalism Menu Grid -->
<form action="index.php" method="POST" id="form-pesanan">

<?php if (!isset($_SESSION["akun-admin"])) { ?>
<!-- Form Pemesanan -->
<div class="mb-4 p-4" style="background: #F8F9FA; border: 3px solid #000; box-shadow: 6px 6px 0px #000;">
    <div class="row align-items-center">
        <div class="col-md-7">
            <input class="form-control py-3 px-4 fw-bold" type="text" name="pelanggan" id="nama-pelanggan" placeholder="MASUKKAN NAMA PELANGGAN" required autocomplete="off" 
                   style="background: #FFF; border: 3px solid #000; font-size: 18px;">
        </div>
        <div class="col-md-5 text-center mt-3 mt-md-0">
            <button class="btn fw-bold px-5 py-3 w-100" type="button" onclick="konfirmasiPesanan()"
                    style="background: #DC3545; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #000; font-size: 18px;">
                🛒 PESAN SEKARANG
            </button>
        </div>
    </div>
</div>
<?php } ?>

<div class="row g-4">
    <?php 
    // Debug: Cek apakah ada data menu
    if (empty($menu)) {
        echo '<div class="col-12"><div class="alert alert-warning" style="border: 3px solid #000;">Tidak ada menu tersedia. Total menu: ' . count($menu) . '</div></div>';
    }
    
    $i = 1;
    foreach ($menu as $m) { ?>
        <div class="col-lg-4 col-md-6">
            <div class="h-100" style="background: #FFF; border: 3px solid #000; box-shadow: 6px 6px 0px #000;">
                
                <!-- Menu Header -->
                <div class="p-3" style="background: #000; color: #FFF; border-bottom: 3px solid #000;">
                    <h5 class="fw-bold m-0 text-uppercase"><?= $m["nama"]; ?></h5>
                </div>
                
                <!-- Menu Image -->
                <div class="text-center p-3" style="background: #F8F9FA;">
                    <img src="src/img/<?= $m["gambar"]; ?>" class="img-fluid" style="max-height: 150px; border: 2px solid #000;">
                </div>
                
                <!-- Menu Details -->
                <div class="p-3">
                    <input type="hidden" name="kode_menu<?= $i; ?>" value="<?= $m["kode_menu"]; ?>">
                    
                    <!-- Price & Category -->
                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="p-2" style="background: #E8F5E8; border: 2px solid #000;">
                                <small class="fw-bold">HARGA</small>
                                <div class="fw-bold fs-6">Rp<?= number_format($m["harga"], 0, ',', '.'); ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2" style="background: #E3F2FD; border: 2px solid #000;">
                                <small class="fw-bold">KATEGORI</small>
                                <div class="fw-bold fs-6"><?= $m["kategori"]; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-3">
                        <div class="p-2 text-center" style="background: #D4EDDA; border: 2px solid #000;">
                            <span class="fw-bold">STATUS: <?= strtoupper($m["status"]); ?></span>
                        </div>
                    </div>
                    
                    <!-- Quantity Input for Users -->
                    <?php if (!isset($_SESSION["akun-admin"])) { ?>
                    <div class="mb-3">
                        <label class="fw-bold mb-2">JUMLAH PESANAN:</label>
                        <input min="0" type="number" name="qty<?= $i; ?>" class="form-control py-2 px-3 fw-bold text-center input-qty" placeholder="0" 
                               data-nama="<?= $m['nama']; ?>" data-harga="<?= $m['harga']; ?>"
                               style="background: #FFF; border: 3px solid #000; font-size: 16px;">
                    </div>
                    <?php } ?>
                    
                    <!-- Admin Actions -->
                    <?php if (isset($_SESSION["akun-admin"])) { ?>
                    <div class="d-grid gap-2">
                        <a class="btn fw-bold py-2" href="edit.php?id_menu=<?= $m["id_menu"]; ?>" 
                           style="background: #FFC107; color: #000; border: 3px solid #000; box-shadow: 3px 3px 0px #000;">
                            ✏️ EDIT MENU
                        </a>
                        <a class="btn fw-bold py-2" href="hapus.php?id_menu=<?= $m["id_menu"]; ?>" onclick="return confirm('Hapus menu ini?')" 
                           style="background: #DC3545; color: #FFF; border: 3px solid #000; box-shadow: 3px 3px 0px #000;">
                            🗑️ HAPUS MENU
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php $i++; } ?>
</div>

<!-- Input Hidden untuk Trigger Submit PHP -->
<input type="hidden" name="pesan" value="true">

</form>

<!-- Modal Konfirmasi Pesanan (Neo-Brutalism Style) -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border: 4px solid #000; box-shadow: 8px 8px 0px #000; border-radius: 0;">
      <div class="modal-header" style="background: #FFC107; border-bottom: 4px solid #000;">
        <h5 class="modal-title fw-bold text-uppercase">📝 Konfirmasi Pesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;"></button>
      </div>
      <div class="modal-body p-4" style="background: #FFF;">
        <p class="fw-bold mb-2">Nama Pelanggan: <span id="konfirmasi-nama" style="color: #DC3545;"></span></p>
        <hr style="border-top: 2px dashed #000;">
        
        <div id="daftar-pesanan" class="mb-3">
            <!-- List pesanan akan di-inject via JS -->
        </div>
        
        <div class="p-3 mt-3" style="background: #E8F5E8; border: 3px solid #000;">
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold fs-5">TOTAL BAYAR:</span>
                <span class="fw-bold fs-4" id="total-bayar">Rp0</span>
            </div>
        </div>
      </div>
      <div class="modal-footer" style="border-top: 4px solid #000; background: #F8F9FA;">
        <button type="button" class="btn fw-bold px-4" data-bs-dismiss="modal" 
                style="background: #FFF; color: #000; border: 3px solid #000; box-shadow: 4px 4px 0px #666;">
            ❌ BATAL
        </button>
        <button type="button" class="btn fw-bold px-4" onclick="submitForm()" 
                style="background: #28A745; color: #FFF; border: 3px solid #000; box-shadow: 4px 4px 0px #000;">
            ✅ YA, PESAN SEKARANG
        </button>
      </div>
    </div>
  </div>
</div>

<script>
function konfirmasiPesanan() {
    const namaPelanggan = document.getElementById('nama-pelanggan').value;
    if (!namaPelanggan.trim()) {
        alert("Silakan isi nama pelanggan terlebih dahulu!");
        return;
    }

    const inputs = document.querySelectorAll('.input-qty');
    let pesananHTML = '<ul class="list-group list-group-flush" style="border: 2px solid #000;">';
    let totalBayar = 0;
    let adaPesanan = false;

    inputs.forEach(input => {
        const qty = parseInt(input.value);
        if (qty > 0) {
            adaPesanan = true;
            const namaMenu = input.getAttribute('data-nama');
            const harga = parseInt(input.getAttribute('data-harga'));
            const subtotal = qty * harga;
            totalBayar += subtotal;

            pesananHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold" style="border-bottom: 1px solid #000;">
                    <div>
                        ${namaMenu} <span class="badge bg-dark rounded-0 border border-dark">x${qty}</span>
                    </div>
                    <span>Rp${subtotal.toLocaleString('id-ID')}</span>
                </li>
            `;
        }
    });

    pesananHTML += '</ul>';

    if (!adaPesanan) {
        alert("Anda belum memilih menu apapun!");
        return;
    }

    document.getElementById('konfirmasi-nama').textContent = namaPelanggan;
    document.getElementById('daftar-pesanan').innerHTML = pesananHTML;
    document.getElementById('total-bayar').textContent = 'Rp' + totalBayar.toLocaleString('id-ID');

    const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasi'));
    modal.show();
}

function submitForm() {
    document.getElementById('form-pesanan').submit();
}
</script>