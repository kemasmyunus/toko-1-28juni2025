<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM pos_sales WHERE id = ?");
$stmt->execute([$id]);
$sale = $stmt->fetch();

if (!$sale) {
    die("Transaksi tidak ditemukan");
}

$customers = $pdo->query("SELECT * FROM customers")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE pos_sales 
        SET tanggal=?, customer_id=?, metode_pembayaran=?, metode_pembayaran2=?, total=?, status=?, nama_sales=?, nama_kasir=?, nama_toko=?, alamat=? 
        WHERE id=?");
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
        $_POST['alamat'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Transaksi POS</h1>
<form method="post">
    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= $sale['tanggal'] ?>" required>
    <label>Customer</label>
    <select name="customer_id">
        <option value="">Umum</option>
        <?php foreach ($customers as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $sale['customer_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Metode Pembayaran</label>
    <input type="text" name="metode_pembayaran" value="<?= htmlspecialchars($sale['metode_pembayaran']) ?>" required>
    <label>Metode Pembayaran 2</label>
    <input type="text" name="metode_pembayaran2" value="<?= htmlspecialchars($sale['metode_pembayaran2']) ?>">
    <label>Total</label>
    <input type="number" name="total" step="0.01" value="<?= $sale['total'] ?>" required>
    <label>Status</label>
    <input type="text" name="status" value="<?= htmlspecialchars($sale['status']) ?>">
    <label>Nama Sales</label>
    <input type="text" name="nama_sales" value="<?= htmlspecialchars($sale['nama_sales']) ?>">
    <label>Nama Kasir</label>
    <input type="text" name="nama_kasir" value="<?= htmlspecialchars($sale['nama_kasir']) ?>">
    <label>Nama Toko</label>
    <input type="text" name="nama_toko" value="<?= htmlspecialchars($sale['nama_toko']) ?>">
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($sale['alamat']) ?>">
    <input type="submit" value="Update">
</form>
