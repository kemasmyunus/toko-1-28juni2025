<?php
require '../db.php';

// Handle AJAX request to fetch customer by ID
if (isset($_GET['get_customer']) && $_GET['get_customer']) {
    $id = $_GET['get_customer'];
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    if ($id) {
        // Update existing customer
        $stmt = $pdo->prepare("UPDATE customers SET nama = ?, alamat = ?, no_hp = ? WHERE id = ?");
        $stmt->execute([
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['no_hp'],
            $id
        ]);
    } else {
        // Generate new ID
        $last = $pdo->query("SELECT id FROM customers WHERE id LIKE 'cst%' ORDER BY id DESC LIMIT 1")->fetchColumn();
        $number = $last ? (int)substr($last, 3) + 1 : 1;
        $new_id = 'cst' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Insert new customer
        $stmt = $pdo->prepare("INSERT INTO customers (id, nama, alamat, no_hp) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $new_id,
            $_POST['nama'],
            $_POST['alamat'],
            $_POST['no_hp']
        ]);
    }

    header("Location: index.php");
    exit;
}

// Fetch all customers for dropdown
$all_customers = $pdo->query("SELECT id, nama FROM customers ORDER BY id")->fetchAll();
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<h1>Tambah Customer</h1>

<form method="post" id="customerForm">
    <label>ID Customer (pilih jika ingin edit):</label>
    <select name="id" id="idSelect" style="width: 100%;">
        <option value="">-- Customer Baru --</option>
        <?php foreach ($all_customers as $cust): ?>
            <option value="<?= htmlspecialchars($cust['id']) ?>">
                <?= htmlspecialchars($cust['id']) ?> - <?= htmlspecialchars($cust['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Nama</label>
    <input type="text" name="nama" id="nama" required>

    <label>Alamat</label>
    <input type="text" name="alamat" id="alamat" required>

    <label>No HP</label>
    <input type="text" name="no_hp" id="no_hp" required>

    <input type="submit" value="Simpan">
</form>

<!-- jQuery + Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#idSelect').select2();

    $('#idSelect').on('change', function () {
        const selectedId = $(this).val();

        if (selectedId) {
            fetch('?get_customer=' + selectedId)
                .then(res => res.json())
                .then(data => {
                    if (data && data.nama) {
                        $('#nama').val(data.nama).prop('disabled', true);
                        $('#alamat').val(data.alamat).prop('disabled', true);
                        $('#no_hp').val(data.no_hp).prop('disabled', true);
                    } else {
                        alert("Data tidak ditemukan!");
                        enableEmptyForm(); // fallback
                    }
                })
                .catch(err => {
                    console.error("Fetch error:", err);
                    alert("Gagal mengambil data!");
                    enableEmptyForm();
                });
        } else {
            // New customer: kosongkan dan aktifkan field
            $('#nama').val('').prop('disabled', false);
            $('#alamat').val('').prop('disabled', false);
            $('#no_hp').val('').prop('disabled', false);
        }
    });

    function enableEmptyForm() {
        $('#nama').val('').prop('disabled', false);
        $('#alamat').val('').prop('disabled', false);
        $('#no_hp').val('').prop('disabled', false);
    }
});

</script>

<?php include '../includes/footer.php'; ?>
