<?php
require '../db.php';

// AJAX get customer
if (isset($_GET['get_customer']) && $_GET['get_customer']) {
    $id = (int) $_GET['get_customer'];
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

$notif = '';

// Handle form transaksi POS
if (isset($_POST['submit_pos'])) {
    $customer_id = (int) $_POST['id'];

    $last_code = $pdo->query("SELECT kode_transaksi FROM pos_sales WHERE kode_transaksi LIKE 'TRX-%' ORDER BY kode_transaksi DESC LIMIT 1")->fetchColumn();
    $trx_number = $last_code ? (int)substr($last_code, 4) + 1 : 1;
    $kode_transaksi = 'TRX-' . str_pad($trx_number, 3, '0', STR_PAD_LEFT);

    $stmt = $pdo->prepare("INSERT INTO pos_sales 
        (kode_transaksi, tanggal, customer_id, total, potongan_total, total_bayar, metode_pembayaran1, metode_pembayaran2, kasir, sales, toko, alamat)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $kode_transaksi,
        $_POST['tanggal'],
        $customer_id,
        $_POST['total'],
        $_POST['potongan_total'],
        $_POST['total_bayar'],
        $_POST['metode_pembayaran1'],
        $_POST['metode_pembayaran2'],
        $_POST['kasir'],
        $_POST['sales'],
        $_POST['toko'],
        $_POST['alamat_transaksi']
    ]);

    $notif = "Transaksi berhasil disimpan!";
}

// Handle tambah customer baru
if (isset($_POST['submit_customer'])) {
    $stmt = $pdo->prepare("INSERT INTO customers (nama, alamat, no_hp) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['no_hp']
    ]);

    $notif = "Customer baru berhasil ditambahkan!";
}

$all_customers = $pdo->query("SELECT id, nama FROM customers ORDER BY id")->fetchAll();
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
.flex-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    align-items: flex-start;
}
.form-box {
    flex: 1;
    min-width: 320px;
    max-width: 700px;
}
.card {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.success {
    padding: 10px;
    background: #e0ffe0;
    border: 1px solid #00c000;
    color: #007000;
    margin-bottom: 15px;
}
</style>

<div class="flex-wrapper">
    <!-- Kartu Transaksi -->
    <div class="form-box">
        <div class="card">
            <h1>Transaksi POS</h1>
            <?php if ($notif && isset($_POST['submit_pos'])): ?>
                <div class="success"><?= htmlspecialchars($notif) ?></div>
            <?php endif; ?>

            <form method="post">
                <label>ID Customer</label>
                <select name="id" id="idSelectTrans" style="width: 100%;" required>
                    <option value="">-- Pilih Customer --</option>
                    <?php foreach ($all_customers as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['id'] ?> - <?= htmlspecialchars($c['nama']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Nama Customer</label>
                <input type="text" id="namaTrans" disabled>

                <label>Tanggal</label>
                <input type="date" name="tanggal" required>

                <label>Total</label>
                <input type="number" name="total" step="0.01" required>

                <label>Potongan Total</label>
                <input type="number" name="potongan_total" step="0.01" value="0">

                <label>Total Bayar</label>
                <input type="number" name="total_bayar" step="0.01" required>

                <label>Metode Pembayaran 1</label>
                <input type="text" name="metode_pembayaran1" required>

                <label>Metode Pembayaran 2</label>
                <input type="text" name="metode_pembayaran2">

                <label>Kasir</label>
                <input type="text" name="kasir">

                <label>Sales</label>
                <input type="text" name="sales">

                <label>Nama Toko</label>
                <input type="text" name="toko">

                <label>Alamat Pengiriman</label>
                <input type="text" name="alamat_transaksi">

                <input type="submit" name="submit_pos" value="Simpan Transaksi">
            </form>
        </div>
    </div>

    <!-- Kartu Tambah Customer -->
    <div class="form-box">
        <div class="card">
            <h1>Tambah Customer</h1>
            <?php if ($notif && isset($_POST['submit_customer'])): ?>
                <div class="success"><?= htmlspecialchars($notif) ?></div>
            <?php endif; ?>

            <form method="post" id="customerForm">
                <label>Nama</label>
                <input type="text" name="nama" required>

                <label>Alamat</label>
                <input type="text" name="alamat" required>

                <label>No HP</label>
                <input type="text" name="no_hp" required>

                <input type="submit" name="submit_customer" value="Buat Customer Baru">
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    $('#idSelectTrans').select2();

    $('#idSelectTrans').on('change', function () {
        const selectedId = $(this).val();
        if (selectedId) {
            fetch('?get_customer=' + selectedId)
                .then(res => res.json())
                .then(data => $('#namaTrans').val(data.nama));
        } else {
            $('#namaTrans').val('');
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>
