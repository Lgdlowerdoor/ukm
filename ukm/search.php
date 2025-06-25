<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("Location: login.php");
    exit;
}

include 'config/db.php';

$keyword = $_GET['keyword'] ?? "";

$sql = "SELECT * FROM pendaftar WHERE 
          nama LIKE ? OR 
          npm LIKE ? OR 
          ukm1 LIKE ? OR 
          ukm2 LIKE ?
        ORDER BY waktu_daftar DESC";

$stmt = $conn->prepare($sql);
$param = "%$keyword%";
$stmt->bind_param("ssss", $param, $param, $param, $param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Cari Data Pendaftar</title>
  <style>
    body {
      background-color: #2f3f32;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 30px;
    }

    .box {
      background-color: #3e5341;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      display: inline-block;
      width: 95%;
      max-width: 1000px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
      color: black;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #445f4c;
      color: white;
    }

    input[type="text"] {
      padding: 8px;
      width: 250px;
      border-radius: 6px;
      border: none;
    }

    .btn {
      background-color: #2f3f32;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #4b664b;
    }

    a {
      color: #add8e6;
    }
  </style>
</head>
<body>

  <div class="box">
    <h2>Cari Pendaftar UKM</h2>

    <form method="GET">
      <input type="text" name="keyword" placeholder="Masukkan nama / NPM / UKM..." value="<?= htmlspecialchars($keyword) ?>">
      <input type="submit" class="btn" value="Cari">
      <a href="admin_panel.php" class="btn">Kembali ke Panel</a>
    </form>

    <?php if ($result->num_rows > 0): ?>
      <table>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NPM</th>
          <th>Email</th>
          <th>UKM 1</th>
          <th>UKM 2</th>
          <th>Waktu Daftar</th>
        </tr>
        <?php $no = 1;
        while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['npm'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['ukm1'] ?></td>
            <td><?= $row['ukm2'] ?></td>
            <td><?= $row['waktu_daftar'] ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>Tidak ada data yang cocok.</p>
    <?php endif; ?>
  </div>

</body>
</html>
