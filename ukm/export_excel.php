<?php
include 'config/db.php';

// Set headers untuk download sebagai file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_pendaftar.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil data dari database
$result = $conn->query("SELECT * FROM pendaftar ORDER BY waktu_daftar DESC");

// Output sebagai tabel HTML
echo "<table border='1'>";
echo "<thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NPM</th>
          <th>Email</th>
          <th>UKM 1</th>
          <th>UKM 2</th>
          <th>Waktu Daftar</th>
        </tr>
      </thead><tbody>";

$no = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$no}</td>
            <td>".htmlspecialchars($row['nama'])."</td>
            <td>{$row['npm']}</td>
            <td>{$row['email']}</td>
            <td>{$row['ukm1']}</td>
            <td>{$row['ukm2']}</td>
            <td>{$row['waktu_daftar']}</td>
          </tr>";
    $no++;
}

echo "</tbody></table>";
?>
