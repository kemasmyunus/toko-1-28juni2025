<?php
require '../db.php';
$products = $pdo->query("SELECT * FROM products")->fetchAll();
$warehouses = $pdo->query("SELECT * FROM warehouses")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = $_POST['product_id'];
    $warehouse_id = $_POST['warehouse_id'];
    
    // Ambil quantity sistem
    $stmt = $pdo->prepare("SELECT quantity FROM stock_balances WHERE product_id = ? AND warehouse_id = ?");
    $stmt->execute([$product_id, $warehouse_id]);
    $row = $stmt->fetch();
    $quantity_sistem = $row ? $row['quantity'] : 0;

    $quantity_fisik = $_POST['quantity_fisik'];
    $selisih = $quantity_fisik - $quantity_sistem;

    $stmtInsert = $pdo->prepare("INSERT INTO stock_opname 
        (product_id, warehouse_id, quantity_sistem, quantity_fisik, selisih, tanggal, keterangan) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmtInsert->execute([
        $product_id,
        $warehouse_id,
        $quantity_sistem,
        $quantity_fisik,
        $selisih,
        $_POST['tanggal'],
        $_POST['keterangan']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Buat Stock Opname</h1>
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
    <label>Quantity Fisik</label>
    <input type="number" name="quantity_fisik" required>
    <label>Tanggal</label>
    <input type="date" name="tanggal" required>
    <label>Keterangan</label>
    <textarea name="keterangan"></textarea>
    <input type="submit" value="Simpan">
</form>
