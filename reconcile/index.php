<?php
require '../db.php';
$stmt = $pdo->query("SELECT * FROM reconcile");
$data = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<h1>Reconcile</h1>
<a href="create.php">+ Tambah Data</a>
<table>
    <tr>
        <th>ID</th>
        <th>Metode Pembayaran</th>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Nominal</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $r): ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['metode_pembayaran']) ?></td>
        <td><?= htmlspecialchars($r['id_transaksi']) ?></td>
        <td><?= htmlspecialchars($r['tanggal_transaksi']) ?></td>
        <td><?= htmlspecialchars($r['status_pembayaran']) ?></td>
        <td><?= htmlspecialchars($r['nominal']) ?></td>
        <td>
            <a href="edit.php?id=<?= $r['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>