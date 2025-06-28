<?php
require '../db.php';
$id = $_GET['id'];
$sale_id = $_GET['sale_id'];
$stmt = $pdo->prepare("DELETE FROM pos_sale_details WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php?sale_id=$sale_id");
