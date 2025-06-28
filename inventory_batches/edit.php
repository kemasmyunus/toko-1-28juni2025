<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM inventory_batches WHERE id = ?");
$stmt->execute([$id]);
$batch = $stmt->fetch();

if (!$batch) {
    die("Batch tidak ditemukan");
}

$products = $pdo->query("SELECT * FROM products")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE inventory_batches 
        SET product_id=?, quantity=?, harga_beli=?, harga_jual=?, tanggal_masuk=?, supplier=?, id_pembelian=? 
        WHERE id=?");
    $stmt->execute([
        $_POST['product_id'],
        $_POST['quantity'],
        $_POST['harga_beli'],
        $_POST['harga_jual'],
        $_POST['tanggal_masuk'],
        $_POST['supplier'],
        $_POST['id_pembelian'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Batch</h1>
<form method="post">
    <label>Produk</label>
    <select name="product_id" required>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $batch['product_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nama_produk']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Quantity</label>
    <input type="number" name="quantity" value="<?= $batch['quantity'] ?>" required>
    <label>Harga Beli</label>
    <input type="number" step="0.01" name="harga_beli" value="<?= $batch['harga_beli'] ?>" required>
    <label>Harga Jual</label>
    <input type="number" step="0.01" name="harga_jual" value="<?= $batch['harga_jual'] ?>" required>
    <label>Tanggal Masuk</label>
    <input type="date" name="tanggal_masuk" value="<?= $batch['tanggal_masuk'] ?>" required>
    <label>Supplier</label>
    <input type="text" name="supplier" value="<?= htmlspecialchars($batch['supplier']) ?>">
    <label>ID Pembelian</label>
    <input type="text" name="id_pembelian" value="<?= htmlspecialchars($batch['id_pembelian']) ?>">
    <input type="submit" value="Update">
</form>
