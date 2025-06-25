<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Proses Pendaftaran UKM</title>
  <style>
    body {
      background-color: #2f3f32;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 50px;
    }

    .box {
      background-color: #3e5341;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      display: inline-block;
    }

    a {
      color: #add8e6;
      text-decoration: underline;
    }

    h3 {
      margin-top: 0;
    }
  </style>
</head>
<body>

<?php
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = $_POST['nama'];
    $npm   = $_POST['npm'];
    $email = $_POST['email'];
    $ukms  = $_POST['ukm'];

    echo "<div class='box'>";

    // ✅ Validasi jumlah UKM
    if (count($ukms) > 2) {
        echo "<h3 style='color:red;'>Maksimal hanya bisa memilih 2 UKM.</h3>";
        echo "<a href='index.php'>Kembali ke Formulir</a>";
        echo "</div>";
        exit;
    }

    // ✅ Validasi NPM sudah pernah daftar atau belum
    $cek = $conn->prepare("SELECT * FROM pendaftar WHERE npm = ?");
    $cek->bind_param("s", $npm);
    $cek->execute();
    $hasil = $cek->get_result();

    if ($hasil->num_rows > 0) {
        echo "<h3 style='color:red;'>NPM ini sudah pernah mendaftar.</h3>";
        echo "<a href='index.php'>Kembali ke Formulir</a>";
        echo "</div>";
        exit;
    }

    // ✅ Proses simpan
    $ukm1 = $ukms[0];
    $ukm2 = $ukms[1] ?? NULL;

    $stmt = $conn->prepare("INSERT INTO pendaftar (nama, npm, email, ukm1, ukm2) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $npm, $email, $ukm1, $ukm2);

    if ($stmt->execute()) {
        echo "<h3 style='color:lightgreen;'>Pendaftaran Berhasil!</h3>";
        echo "<p>Anda akan diarahkan kembali dalam 5 detik.</p>";
        echo "<a href='index.php'>Klik di sini jika tidak diarahkan otomatis</a>";
        echo "<script>
                setTimeout(() => {
                  window.location.href = 'index.php';
                }, 5000);
              </script>";
    } else {
        echo "<h3 style='color:red;'>Terjadi kesalahan saat menyimpan data.</h3>";
        echo "<a href='index.php'>Kembali ke Formulir</a>";
    }

    echo "</div>";
} else {
    header("Location: index.php");
    exit;
}
?>

</body>
</html>
