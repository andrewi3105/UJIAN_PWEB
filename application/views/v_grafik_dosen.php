<section class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-center" style="font-weight: bold;">GRAFIK DATA DOSEN</h5>

                <!-- Flashdata for success message -->
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success mt-3">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="btn-group" role="group" aria-label="Button Group">
                        <!-- Button for going back to Home -->
                        <a href="<?= base_url('dosen/index'); ?>" class="btn btn-secondary rounded-pill me-2">
                            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Display chart using canvas -->
                <canvas id="dosenChart" width="600" height="300"></canvas>
            </div>
        </div>
    </div>
</section>

<?php
// Get the data from the controller to display on the chart
$program_studi_dosen = array_column($hasil, 'program_studi_dosen');  // Program studi dosen
$total_dosen = array_column($hasil, 'total_dosen');  // Total dosen per program studi
?>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Display chart -->
<script>
    var ctx = document.getElementById('dosenChart').getContext('2d');

    // Array warna untuk setiap bar
    var backgroundColors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];

    var borderColors = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
    ];

    // Sesuaikan jumlah warna dengan jumlah data
    var totalDataPoints = <?= count($program_studi_dosen); ?>;
    var adjustedBackgroundColors = Array(totalDataPoints).fill(backgroundColors).flat().slice(0, totalDataPoints);
    var adjustedBorderColors = Array(totalDataPoints).fill(borderColors).flat().slice(0, totalDataPoints);

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($program_studi_dosen); ?>, // Label program studi
            datasets: [{
                label: 'Total Dosen',
                data: <?= json_encode($total_dosen); ?>, // Data jumlah dosen
                backgroundColor: adjustedBackgroundColors,
                borderColor: adjustedBorderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>



<style>
    /* Style improvements for better appearance */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h5 {
        text-align: center;
        font-weight: bold;
    }

    canvas {
        display: block;
        margin: 0 auto;
        max-width: 100%;  /* Prevent canvas from exceeding container width */
        width: 80%;  /* Set width to 80% of the container */
        height: 300px;  /* Set a fixed height for the canvas */
    }

    .btn-secondary {
        font-weight: bold;
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-group {
        margin-bottom: 10px;
    }
</style>
