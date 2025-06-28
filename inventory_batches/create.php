<?php
require '../db.php';
$products = $pdo->query("SELECT * FROM products")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO inventory_batches 
        (product_id, quantity, harga_beli, harga_jual, tanggal_masuk, supplier, id_pembelian) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['product_id'],
        $_POST['quantity'],
        $_POST['harga_beli'],
        $_POST['harga_jual'],
        $_POST['tanggal_masuk'],
        $_POST['supplier'],
        $_POST['id_pembelian']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Batch</h1>
<form method="post">
    <label>Produk</label>
    <select name="product_id" required>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama_produk']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Quantity</label>
    <input type="number" name="quantity" required>
    <label>Harga Beli</label>
    <input type="number" name="harga_beli" step="0.01" required>
    <label>Harga Jual</label>
    <input type="number" name="harga_jual" step="0.01" required>
    <label>Tanggal Masuk</label>
    <input type="date" name="tanggal_masuk" required>
    <label>Supplier</label>
    <input type="text" name="supplier">
    <label>ID Pembelian</label>
    <input type="text" name="id_pembelian">
    <input type="submit" value="Simpan">
</form>
