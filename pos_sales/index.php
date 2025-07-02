<?php
require '../db.php';

// Ambil data POS + nama customer
$stmt = $pdo->query("SELECT pos_sales.*, customers.nama AS customer_nama 
                     FROM pos_sales 
                     LEFT JOIN customers ON pos_sales.customer_id = customers.id 
                     ORDER BY pos_sales.id DESC");
$sales = $stmt->fetchAll();
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<link rel="stylesheet" href="../css/style.css">

<h1>Daftar Transaksi POS</h1>
<p><a href="create.php" class="btn">+ Tambah Transaksi</a></p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Potongan</th>
            <th>Total Bayar</th>
            <th>Pembayaran 1</th>
            <th>Pembayaran 2</th>
            <th>Kasir</th>
            <th>Sales</th>
            <th>Toko</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sales as $s): ?>
        <tr>
            <td><?= htmlspecialchars($s['kode_transaksi']) ?></td>
            <td><?= htmlspecialchars($s['tanggal']) ?></td>
            <td><?= htmlspecialchars($s['customer_nama'] ?? 'Umum') ?></td>
            <td>Rp <?= number_format($s['total'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($s['potongan_total'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($s['total_bayar'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($s['metode_pembayaran1']) ?></td>
            <td><?= htmlspecialchars($s['metode_pembayaran2']) ?></td>
            <td><?= htmlspecialchars($s['kasir']) ?></td>
            <td><?= htmlspecialchars($s['sales']) ?></td>
            <td><?= htmlspecialchars($s['toko']) ?></td>
            <td><?= htmlspecialchars($s['alamat']) ?></td>
            <td>
                <a href="edit.php?id=<?= $s['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a> |
                <a href="../pos_sale_details/index.php?sale_id=<?= $s['id'] ?>">Detail</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
