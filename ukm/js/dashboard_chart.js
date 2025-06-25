const ctx = document.getElementById('ukmChart').getContext('2d');

const ukmChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: window.chartLabels,
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: window.chartData,
            backgroundColor: 'rgba(86, 171, 110, 0.7)',
            borderColor: 'rgba(86, 171, 110, 1)',
            borderWidth: 1
        }]
    },
    options: {
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
            legend: {
                labels: { color: 'white' }
            }
        }
    }
});
