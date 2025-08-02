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
// Setelah $stock sudah di-fetch dan sebelum update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $old_quantity = $stock['quantity'];
    $new_quantity = $_POST['quantity'];

    if ($old_quantity != $new_quantity || $stock['product_id'] != $_POST['product_id'] || $stock['warehouse_id'] != $_POST['warehouse_id']) {
        // Simpan ke tabel stock_history
        $log = $pdo->prepare("INSERT INTO stock_history (stock_id, product_id, warehouse_id, old_quantity, new_quantity) VALUES (?, ?, ?, ?, ?)");
        $log->execute([
            $id,
            $_POST['product_id'],
            $_POST['warehouse_id'],
            $old_quantity,
            $new_quantity
        ]);
    }

    // Lanjut update stock_balances
    $stmt = $pdo->prepare("UPDATE stock_balances SET product_id=?, warehouse_id=?, quantity=? WHERE id=?");
    $stmt->execute([
        $_POST['product_id'],
        $_POST['warehouse_id'],
        $new_quantity,
        $id
    ]);

    header("Location: index.php");
}

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
