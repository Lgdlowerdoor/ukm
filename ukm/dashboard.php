<?php
$title = "Dashboard Admin";
include 'config/auth.php';
include 'config/db.php';
include 'templates/header.php';

// Ambil data jumlah pendaftar per UKM (gabungan ukm1 dan ukm2)
$query = "SELECT ukm1 AS ukm FROM pendaftar
          UNION ALL
          SELECT ukm2 FROM pendaftar WHERE ukm2 IS NOT NULL";

$result = $conn->query("SELECT ukm, COUNT(*) as total FROM ($query) as ukm_all GROUP BY ukm");

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['ukm'];
    $data[] = $row['total'];
}
?>

<div class="box">
  <h2>Dashboard Statistik Pendaftaran UKM</h2>

  <div style="position: relative; width: 100%; max-width: 600px; height: 300px; margin: auto;">
    <canvas id="ukmChart"></canvas>
  </div>

  <div style="margin-top: 20px;">
    <a href="admin_panel.php" class="btn">Lihat Data Pendaftar</a>
    <a href="logout.php" class="btn">Logout</a>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('ukmChart').getContext('2d');
  const ukmChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: <?= json_encode($labels); ?>,
          datasets: [{
              label: 'Jumlah Pendaftar',
              data: <?= json_encode($data); ?>,
              backgroundColor: 'rgba(86, 171, 110, 0.7)',
              borderColor: 'rgba(86, 171, 110, 1)',
              borderWidth: 1
          }]
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              ticks: { color: 'white' },
              grid: { color: '#555' }
            },
            x: {
              ticks: { color: 'white' },
              grid: { color: '#555' }
            }
          },
          plugins: {
            legend: { labels: { color: 'white' } }
          }
      }
  });
</script>

<?php include 'templates/footer.php'; ?>
