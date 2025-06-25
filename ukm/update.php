<?php
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id    = $_POST['id'];
    $nama  = trim($_POST['nama']);
    $npm   = trim($_POST['npm']);
    $email = trim($_POST['email']);
    $ukms  = $_POST['ukm'] ?? [];

   
    if (count($ukms) > 2) {
        echo "<script>alert('Maksimal hanya bisa memilih 2 UKM.'); window.history.back();</script>";
        exit;
    }

    $ukm1 = $ukms[0];
    $ukm2 = $ukms[1] ?? null;

    $stmt = $conn->prepare("UPDATE pendaftar SET nama = ?, npm = ?, email = ?, ukm1 = ?, ukm2 = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $nama, $npm, $email, $ukm1, $ukm2, $id);

    if ($stmt->execute()) {
        header("Location: list_pendaftar.php?update=success");
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data.'); window.history.back();</script>";
    }
} else {
    header("Location: list_pendaftar.php");
    exit;
}
?>
