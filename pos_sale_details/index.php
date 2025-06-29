<?php
require '../db.php';

$sale_id = $_GET['sale_id'] ?? null;
if (!$sale_id) {
    die("Sale ID tidak ada.");
}

$stmtSale = $pdo->prepare("SELECT * FROM pos_sales WHERE id = ?");
$stmtSale->execute([$sale_id]);
$sale = $stmtSale->fetch();

if (!$sale) {
    die("Transaksi tidak ditemukan.");
}

$stmt = $pdo->prepare("SELECT pos_sale_details.*, products.nama_produk 
    FROM pos_sale_details 
    JOIN products ON pos_sale_details.product_id = products.id 
    WHERE pos_sale_details.pos_sale_id = ?");
$stmt->execute([$sale_id]);
$details = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<h1>Detail Transaksi #<?= $sale_id ?></h1>
<a href="create.php?sale_id=<?= $sale_id ?>">+ Tambah Item</a>
<table>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Qty</th>
        <th>Harga Jual</th>
        <th>Potongan 1</th>
        <th>Potongan 2</th>
        <th>Potongan 3</th>
        <th>Total Setelah Potongan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($details as $d): ?>
    <tr>
        <td><?= $d['id'] ?></td>
        <td><?= htmlspecialchars($d['nama_produk']) ?></td>
        <td><?= $d['quantity'] ?></td>
        <td><?= $d['harga_jual'] ?></td>
        <td><?= $d['potongan1'] ?></td>
        <td><?= $d['potongan2'] ?></td>
        <td><?= $d['potongan3'] ?></td>
        <td><?= $d['total_setelah_potongan'] ?></td>
        <td>
            <a href="edit.php?id=<?= $d['id'] ?>&sale_id=<?= $sale_id ?>">Edit</a>
            <a href="delete.php?id=<?= $d['id'] ?>&sale_id=<?= $sale_id ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="../pos_sales/index.php">← Kembali ke Transaksi</a>
<?php include '../includes/footer.php'; ?>