<?php
require '../db.php';
$customers = $pdo->query("SELECT * FROM customers")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO pos_sales (tanggal, customer_id, metode_pembayaran, metode_pembayaran2, total, status, nama_sales, nama_kasir, nama_toko, alamat) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['tanggal'],
        $_POST['customer_id'] !== '' ? $_POST['customer_id'] : null,
        $_POST['metode_pembayaran'],
        $_POST['metode_pembayaran2'],
        $_POST['total'],
        $_POST['status'],
        $_POST['nama_sales'],
        $_POST['nama_kasir'],
        $_POST['nama_toko'],
        $_POST['alamat']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Transaksi POS</h1>
<form method="post">
    <label>Tanggal</label>
    <input type="date" name="tanggal" required>
    <label>Customer</label>
    <select name="customer_id">
        <option value="">Umum</option>
        <?php foreach ($customers as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nama']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Metode Pembayaran</label>
    <input type="text" name="metode_pembayaran" required>
    <label>Metode Pembayaran 2</label>
    <input type="text" name="metode_pembayaran2">
    <label>Total</label>
    <input type="number" name="total" step="0.01" required>
    <label>Status</label>
    <input type="text" name="status" value="paid">
    <label>Nama Sales</label>
    <input type="text" name="nama_sales">
    <label>Nama Kasir</label>
    <input type="text" name="nama_kasir">
    <label>Nama Toko</label>
    <input type="text" name="nama_toko">
    <label>Alamat</label>
    <input type="text" name="alamat">
    <input type="submit" value="Simpan">
</form>
