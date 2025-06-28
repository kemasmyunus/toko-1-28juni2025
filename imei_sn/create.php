<?php
require '../db.php';
$batches = $pdo->query("SELECT id FROM inventory_batches")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO imei_sn (inventory_batch_id, uniqe_id, imei, sn, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['inventory_batch_id'],
        $_POST['uniqe_id'],
        $_POST['imei'],
        $_POST['sn'],
        $_POST['status']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah IMEI / SN</h1>
<form method="post">
    <label>Batch</label>
    <select name="inventory_batch_id" required>
        <?php foreach ($batches as $b): ?>
            <option value="<?= $b['id'] ?>">Batch #<?= $b['id'] ?></option>
        <?php endforeach; ?>
    </select>
    <label>Unique ID</label>
    <input type="text" name="uniqe_id" required>
    <label>IMEI</label>
    <input type="text" name="imei">
    <label>SN</label>
    <input type="text" name="sn">
    <label>Status</label>
    <select name="status">
        <option value="available">Available</option>
        <option value="sold">Sold</option>
        <option value="reserved">Reserved</option>
    </select>
    <input type="submit" value="Simpan">
</form>
