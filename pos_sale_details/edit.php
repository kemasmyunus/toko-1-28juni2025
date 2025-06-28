<?php
require '../db.php';
$id = $_GET['id'];
$sale_id = $_GET['sale_id'];

$stmt = $pdo->prepare("SELECT * FROM pos_sale_details WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    die("Detail tidak ditemukan");
}

$products = $pdo->query("SELECT * FROM products")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE pos_sale_details 
        SET product_id=?, quantity=?, harga_jual=?, potongan1=?, potongan2=?, potongan3=?, total_setelah_potongan=? 
        WHERE id=?");
    $stmt->execute([
        $_POST['product_id'],
        $_POST['quantity'],
        $_POST['harga_jual'],
        $_POST['potongan1'],
        $_POST['potongan2'],
        $_POST['potongan3'],
        $_POST['total_setelah_potongan'],
        $id
    ]);
    header("Location: index.php?sale_id=$sale_id");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Item Transaksi #<?= $sale_id ?></h1>
<form method="post">
    <label>Produk</label>
    <select name="product_id" required>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>" <?= $p['id'] == $item['product_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nama_produk']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Quantity</label>
    <input type="number" name="quantity" value="<?= $item['quantity'] ?>" required>
    <label>Harga Jual</label>
    <input type="number" name="harga_jual" step="0.01" value="<?= $item['harga_jual'] ?>" required>
    <label>Potongan 1</label>
    <input type="number" name="potongan1" step="0.01" value="<?= $item['potongan1'] ?>">
    <label>Potongan 2</label>
    <input type="number" name="potongan2" step="0.01" value="<?= $item['potongan2'] ?>">
    <label>Potongan 3</label>
    <input type="number" name="potongan3" step="0.01" value="<?= $item['potongan3'] ?>">
    <label>Total Setelah Potongan</label>
    <input type="number" name="total_setelah_potongan" step="0.01" value="<?= $item['total_setelah_potongan'] ?>" required>
    <input type="submit" value="Update">
</form>
