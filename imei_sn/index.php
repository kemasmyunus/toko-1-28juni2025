<?php
require '../db.php';
$stmt = $pdo->query("SELECT imei_sn.*, inventory_batches.id AS batch_id
    FROM imei_sn
    JOIN inventory_batches ON imei_sn.inventory_batch_id = inventory_batches.id");
$items = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<h1>IMEI & SN</h1>
<a href="create.php">+ Tambah IMEI / SN</a>
<table>
    <tr>
        <th>ID</th>
        <th>Batch</th>
        <th>Unique ID</th>
        <th>IMEI</th>
        <th>SN</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($items as $i): ?>
    <tr>
        <td><?= $i['id'] ?></td>
        <td>Batch #<?= $i['batch_id'] ?></td>
        <td><?= htmlspecialchars($i['uniqe_id']) ?></td>
        <td><?= htmlspecialchars($i['imei']) ?></td>
        <td><?= htmlspecialchars($i['sn']) ?></td>
        <td><?= htmlspecialchars($i['status']) ?></td>
        <td>
            <a href="edit.php?id=<?= $i['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $i['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>