<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID tidak ditemukan");
}

// Ambil data transaksi
$stmt = $pdo->prepare("SELECT * FROM pos_sales WHERE id = ?");
$stmt->execute([$id]);
$sale = $stmt->fetch();

if (!$sale) {
    die("Transaksi tidak ditemukan");
}

// Ambil data customer
$customers = $pdo->query("SELECT * FROM customers")->fetchAll();

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE pos_sales 
        SET tanggal=?, customer_id=?, total=?, potongan_total=?, total_bayar=?, 
            metode_pembayaran1=?, metode_pembayaran2=?, kasir=?, sales=?, toko=?, alamat=? 
        WHERE id=?");
    $stmt->execute([
        $_POST['tanggal'],
        $_POST['customer_id'] !== '' ? $_POST['customer_id'] : null,
        $_POST['total'],
        $_POST['potongan_total'],
        $_POST['total_bayar'],
        $_POST['metode_pembayaran1'],
        $_POST['metode_pembayaran2'],
        $_POST['kasir'],
        $_POST['sales'],
        $_POST['toko'],
        $_POST['alamat'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">

<h1>Edit Transaksi POS</h1>
<form method="post">
    <label>Kode Transaksi</label>
    <input type="text" value="<?= htmlspecialchars($sale['kode_transaksi']) ?>" readonly>

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= $sale['tanggal'] ?>" required>

    <label>Customer</label>
    <select name="customer_id">
        <option value="">Umum</option>
        <?php foreach ($customers as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $sale['customer_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['id']) ?> - <?= htmlspecialchars($c['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Total</label>
    <input type="number" name="total" step="0.01" value="<?= $sale['total'] ?>" required>

    <label>Potongan Total</label>
    <input type="number" name="potongan_total" step="0.01" value="<?= $sale['potongan_total'] ?>">

    <label>Total Bayar</label>
    <input type="number" name="total_bayar" step="0.01" value="<?= $sale['total_bayar'] ?>" required>

    <label>Metode Pembayaran 1</label>
    <input type="text" name="metode_pembayaran1" value="<?= htmlspecialchars($sale['metode_pembayaran1']) ?>" required>

    <label>Metode Pembayaran 2</label>
    <input type="text" name="metode_pembayaran2" value="<?= htmlspecialchars($sale['metode_pembayaran2']) ?>">

    <label>Kasir</label>
    <input type="text" name="kasir" value="<?= htmlspecialchars($sale['kasir']) ?>">

    <label>Sales</label>
    <input type="text" name="sales" value="<?= htmlspecialchars($sale['sales']) ?>">

    <label>Nama Toko</label>
    <input type="text" name="toko" value="<?= htmlspecialchars($sale['toko']) ?>">

    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($sale['alamat']) ?>">

    <input type="submit" value="Update">
</form>
<?php include '../includes/footer.php'; ?>
