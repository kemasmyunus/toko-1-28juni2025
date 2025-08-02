<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../db.php';
$batches = $pdo->query("SELECT id FROM inventory_batches")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $batch_id = $_POST['inventory_batch_id'];
    $unique_id = $_POST['uniqe_id'];
    $sn = $_POST['sn'];
    $status = $_POST['status'];

    // Pisah IMEI berdasarkan koma atau baris baru
    $imeis = preg_split('/[\r\n,]+/', $_POST['imei'], -1, PREG_SPLIT_NO_EMPTY);

    foreach ($imeis as $imei) {
        $stmt = $pdo->prepare("INSERT INTO imei_sn (inventory_batch_id, uniqe_id, imei, sn, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$batch_id, $unique_id, trim($imei), $sn, $status]);
    }

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

    <label>IMEI (bisa isi lebih dari satu, pisah pakai koma atau baris baru)</label>
    <textarea name="imei" rows="4" required></textarea>

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
<?php include '../includes/footer.php'; ?>
