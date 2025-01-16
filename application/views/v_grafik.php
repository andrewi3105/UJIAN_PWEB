<section class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-center" style="font-weight: bold;">GRAFIK DATA MAHASISWA</h5>

                <!-- Flashdata for success message -->
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success mt-3">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="btn-group" role="group" aria-label="Button Group">
                        <!-- Button for going back to Home -->
                        <a href="<?= base_url('mahasiswa/index'); ?>" class="btn btn-secondary rounded-pill me-2">
                            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Menampilkan grafik menggunakan canvas -->
                <canvas id="mahasiswaChart" width="600" height="300"></canvas>
            </div>
        </div>
    </div>
</section>

<?php
// Mengambil data dari controller untuk ditampilkan di grafik
$jurusan = array_column($hasil, 'jurusan');  // Nama jurusan
$total_mahasiswa = array_column($hasil, 'total');  // Jumlah mahasiswa per jurusan
?>

<!-- Memuat Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Menampilkan grafik menggunakan canvas -->
<script>
    var ctx = document.getElementById('mahasiswaChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',  // Jenis grafik: bar chart
        data: {
            labels: <?php echo json_encode($jurusan); ?>,  // Label berdasarkan jurusan
            datasets: [{
                label: 'Jurusan',
                data: <?php echo json_encode($total_mahasiswa); ?>,  // Data jumlah mahasiswa
                backgroundColor: [
                    'rgba(255, 99, 132, 0.4)',  // Warna pastel untuk masing-masing bar
                    'rgba(54, 162, 235, 0.4)',
                    'rgba(255, 159, 64, 0.4)',
                    'rgba(75, 192, 192, 0.4)',
                    'rgba(153, 102, 255, 0.4)',
                    'rgba(255, 159, 64, 0.4)',
                    'rgba(255, 99, 132, 0.4)',
                    'rgba(255, 205, 86, 0.4)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',  // Border warna lebih gelap
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 205, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true  // Mulai dari angka 0
                }
            }
        }
    });
</script>

<style>
    /* Menambahkan padding dan margin untuk tampilan yang lebih rapi */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h5 {
        text-align: center;
        font-weight: bold;
    }

    /* Menyesuaikan ukuran grafik */
    /* Menyesuaikan ukuran grafik */
    canvas {
        display: block;
        margin: 0 auto;
        max-width: 100%; /* Membatasi ukuran agar tidak melebihi lebar kontainer */
        width: 80%;  /* Lebar canvas lebih kecil */
        height: 300px; /* Tetapkan tinggi yang tetap */
    }

    .btn-secondary {
        font-weight: bold;
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-info {
        font-weight: bold;
        background-color: #17a2b8;
        border: none;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-group {
        margin-bottom: 10px;
    }
</style>
