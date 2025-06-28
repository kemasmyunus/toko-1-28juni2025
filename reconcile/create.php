<?php
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO reconcile (metode_pembayaran, id_transaksi, tanggal_transaksi, status_pembayaran, nominal) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['metode_pembayaran'],
        $_POST['id_transaksi'],
        $_POST['tanggal_transaksi'],
        $_POST['status_pembayaran'],
        $_POST['nominal']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Reconcile</h1>
<form method="post">
    <label>Metode Pembayaran</label>
    <input type="text" name="metode_pembayaran" required>
    <label>ID Transaksi</label>
    <input type="text" name="id_transaksi" required>
    <label>Tanggal Transaksi</label>
    <input type="date" name="tanggal_transaksi" required>
    <label>Status Pembayaran</label>
    <input type="text" name="status_pembayaran" required>
    <label>Nominal</label>
    <input type="number" name="nominal" step="0.01" required>
    <input type="submit" value="Simpan">
</form>
