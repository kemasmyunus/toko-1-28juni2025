<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM imei_sn WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    die("Data tidak ditemukan");
}

$batches = $pdo->query("SELECT id FROM inventory_batches")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE imei_sn SET inventory_batch_id=?, uniqe_id=?, imei=?, sn=?, status=? WHERE id=?");
    $stmt->execute([
        $_POST['inventory_batch_id'],
        $_POST['uniqe_id'],
        $_POST['imei'],
        $_POST['sn'],
        $_POST['status'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit IMEI / SN</h1>
<form method="post">
    <label>Batch</label>
    <select name="inventory_batch_id" required>
        <?php foreach ($batches as $b): ?>
            <option value="<?= $b['id'] ?>" <?= $b['id'] == $item['inventory_batch_id'] ? 'selected' : '' ?>>
                Batch #<?= $b['id'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label>Unique ID</label>
    <input type="text" name="uniqe_id" value="<?= htmlspecialchars($item['uniqe_id']) ?>" required>
    <label>IMEI</label>
    <input type="text" name="imei" value="<?= htmlspecialchars($item['imei']) ?>">
    <label>SN</label>
    <input type="text" name="sn" value="<?= htmlspecialchars($item['sn']) ?>">
    <label>Status</label>
    <select name="status">
        <option value="available" <?= $item['status'] == 'available' ? 'selected' : '' ?>>Available</option>
        <option value="sold" <?= $item['status'] == 'sold' ? 'selected' : '' ?>>Sold</option>
        <option value="reserved" <?= $item['status'] == 'reserved' ? 'selected' : '' ?>>Reserved</option>
    </select>
    <input type="submit" value="Update">
</form>
<?php include '../includes/footer.php'; ?>