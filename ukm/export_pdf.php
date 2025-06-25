<?php
include 'config/db.php';
$result = $conn->query("SELECT * FROM pendaftar ORDER BY waktu_daftar DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Data Pendaftar UKM</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background: white;
      color: black;
    }

    h2 {
      text-align: center;
      margin-bottom: 10px;
    }

    .subtitle {
      text-align: center;
      font-size: 14px;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #999;
      padding: 8px 10px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    .print-btn {
      display: block;
      margin: 20px auto;
      padding: 10px 20px;
      background: #2f3f32;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    @media print {
      .print-btn {
        display: none;
      }

      body {
        margin: 0;
        padding: 10px;
        font-size: 12px;
      }
    }
  </style>
</head>
<body>

  <h2>Daftar Pendaftar UKM</h2>
  <div class="subtitle">Universitas Lampung - <?= date("d/m/Y") ?></div>

  <button class="print-btn" onclick="window.print()">Cetak / Simpan ke PDF</button>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NPM</th>
        <th>Email</th>
        <th>UKM 1</th>
        <th>UKM 2</th>
        <th>Waktu Daftar</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$no}</td>
                  <td>" . htmlspecialchars($row['nama']) . "</td>
                  <td>{$row['npm']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['ukm1']}</td>
                  <td>{$row['ukm2']}</td>
                  <td>{$row['waktu_daftar']}</td>
                </tr>";
          $no++;
      }

      if ($result->num_rows == 0) {
          echo "<tr><td colspan='7'>Belum ada data pendaftar.</td></tr>";
      }
      ?>
    </tbody>
  </table>

</body>
</html>
