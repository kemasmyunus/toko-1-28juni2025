<?php
require '../db.php';
$stmt = $pdo->query("SELECT pos_sales.*, customers.nama AS customer_nama 
    FROM pos_sales 
    LEFT JOIN customers ON pos_sales.customer_id = customers.id");
$sales = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<h1>POS Sales</h1>
<a href="create.php">+ Tambah Transaksi</a>
<table>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Customer</th>
        <th>Metode Pembayaran</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($sales as $s): ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['tanggal']) ?></td>
        <td><?= htmlspecialchars($s['customer_nama'] ?? 'Umum') ?></td>
        <td><?= htmlspecialchars($s['metode_pembayaran']) ?></td>
        <td><?= htmlspecialchars($s['total']) ?></td>
        <td><?= htmlspecialchars($s['status']) ?></td>
        <td>
            <a href="edit.php?id=<?= $s['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            <a href="../pos_sale_details/index.php?sale_id=<?= $s['id'] ?>">Detail</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>