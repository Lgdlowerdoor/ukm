<?php
include 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM pendaftar WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: list_pendaftar.php");
} else {
    echo "ID tidak ditemukan.";
}
?>
