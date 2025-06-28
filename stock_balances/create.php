<?php
require '../db.php';
$products = $pdo->query("SELECT * FROM products")->fetchAll();
$warehouses = $pdo->query("SELECT * FROM warehouses")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO stock_balances (product_id, warehouse_id, quantity) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['product_id'],
        $_POST['warehouse_id'],
        $_POST['quantity']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Stock</h1>
<form method="post">
    <label>Produk</label>
    <select name="product_id" required>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama_produk']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Gudang</label>
    <select name="warehouse_id" required>
        <?php foreach ($warehouses as $w): ?>
            <option value="<?= $w['id'] ?>"><?= htmlspecialchars($w['nama']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Quantity</label>
    <input type="number" name="quantity" required>
    <input type="submit" value="Simpan">
</form>
