<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM stock_balances WHERE id = ?");
$stmt->execute([$id]);
$stock = $stmt->fetch();

if (!$stock) {
    die("Stock tidak ditemukan");
}

$products = $pdo->query("SELECT * FROM products")->fetchAll();
$warehouses = $pdo->query("SELECT * FROM warehouses")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE stock_balances SET product_id=?, warehouse_id=?, quantity=? WHERE id=?");
    $stmt->execute([
        $_POST['product_id'],
        $_POST['warehouse_id'],
        $_POST['quantity'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Stock</h1>
<form method="post">
    <label>Produk</label>
    <select name="product_id" required>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $stock['product_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nama_produk']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Gudang</label>
    <select name="warehouse_id" required>
        <?php foreach ($warehouses as $w): ?>
            <option value="<?= $w['id'] ?>" <?= $w['id'] == $stock['warehouse_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($w['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Quantity</label>
    <input type="number" name="quantity" value="<?= $stock['quantity'] ?>" required>
    <input type="submit" value="Update">
</form>
