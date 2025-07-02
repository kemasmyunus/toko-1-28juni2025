<?php
require '../db.php';

// AJAX ambil data customer
if (isset($_GET['get_customer']) && $_GET['get_customer']) {
    $id = $_GET['get_customer'];
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer_id = $_POST['id'];

    // Buat customer baru jika ID kosong
    if (!$customer_id) {
        $last = $pdo->query("SELECT id FROM customers WHERE id LIKE 'cst%' ORDER BY id DESC LIMIT 1")->fetchColumn();
        $number = $last ? (int)substr($last, 3) + 1 : 1;
        $customer_id = 'cst' . str_pad($number, 3, '0', STR_PAD_LEFT);

        $stmt = $pdo->prepare("INSERT INTO customers (id, nama, alamat, no_hp) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $customer_id,
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['no_hp']
        ]);
    }

    // Buat kode transaksi TRX-XXX
    $last_code = $pdo->query("SELECT kode_transaksi FROM pos_sales WHERE kode_transaksi LIKE 'TRX-%' ORDER BY kode_transaksi DESC LIMIT 1")->fetchColumn();
    $trx_number = $last_code ? (int)substr($last_code, 4) + 1 : 1;
    $kode_transaksi = 'TRX-' . str_pad($trx_number, 3, '0', STR_PAD_LEFT);

    // Simpan transaksi
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

    header("Location: index.php");
    exit;
}

$customers = $pdo->query("SELECT id, nama FROM customers ORDER BY id")->fetchAll();
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<h1>Transaksi POS + Customer</h1>
<form method="post" id="posForm">
    <h3>Data Customer</h3>
    <label>ID Customer (pilih jika sudah ada)</label>
    <select name="id" id="idSelect" style="width: 100%;">
        <option value="">-- Customer Baru --</option>
        <?php foreach ($customers as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['id'] ?> - <?= htmlspecialchars($c['nama']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Nama</label>
    <input type="text" name="nama" id="nama" required>
    <label>Alamat</label>
    <input type="text" name="alamat" id="alamat" required>
    <label>No HP</label>
    <input type="text" name="no_hp" id="no_hp" required>

    <label><input type="checkbox" id="confirmCustomer"> Gunakan data customer ini untuk transaksi</label>

    <div id="trxFields" style="display:none; margin-top:20px;">
        <h3>Data Transaksi POS</h3>
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
        <input type="submit" value="Simpan Transaksi">
    </div>
</form>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {
    $('#idSelect').select2();

    $('#idSelect').on('change', function () {
        const selectedId = $(this).val();

        if (selectedId) {
            fetch('?get_customer=' + selectedId)
                .then(res => res.json())
                .then(data => {
                    if (data) {
                        $('#nama').val(data.nama).prop('disabled', true);
                        $('#alamat').val(data.alamat).prop('disabled', true);
                        $('#no_hp').val(data.no_hp).prop('disabled', true);
                    }
                });
        } else {
            $('#nama, #alamat, #no_hp').val('').prop('disabled', false);
        }
    });

    $('#confirmCustomer').on('change', function () {
        if ($(this).is(':checked')) {
            $('#trxFields').slideDown();
        } else {
            $('#trxFields').slideUp();
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>
