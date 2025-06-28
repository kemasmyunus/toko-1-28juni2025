<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM reconcile WHERE id = ?");
$stmt->execute([$id]);
$r = $stmt->fetch();

if (!$r) {
    die("Data tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE reconcile SET metode_pembayaran=?, id_transaksi=?, tanggal_transaksi=?, status_pembayaran=?, nominal=? WHERE id=?");
    $stmt->execute([
        $_POST['metode_pembayaran'],
        $_POST['id_transaksi'],
        $_POST['tanggal_transaksi'],
        $_POST['status_pembayaran'],
        $_POST['nominal'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Reconcile</h1>
<form method="post">
    <label>Metode Pembayaran</label>
    <input type="text" name="metode_pembayaran" value="<?= htmlspecialchars($r['metode_pembayaran']) ?>" required>
    <label>ID Transaksi</label>
    <input type="text" name="id_transaksi" value="<?= htmlspecialchars($r['id_transaksi']) ?>" required>
    <label>Tanggal Transaksi</label>
    <input type="date" name="tanggal_transaksi" value="<?= $r['tanggal_transaksi'] ?>" required>
    <label>Status Pembayaran</label>
    <input type="text" name="status_pembayaran" value="<?= htmlspecialchars($r['status_pembayaran']) ?>" required>
    <label>Nominal</label>
    <input type="number" name="nominal" step="0.01" value="<?= $r['nominal'] ?>" required>
    <input type="submit" value="Update">
</form>
