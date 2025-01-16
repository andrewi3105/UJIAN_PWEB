<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Jadwal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .content {
            padding-top: 40px;
        }
        .title-section {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            font-family: 'Arial', sans-serif;
            position: relative;
        }
        .title-section h3 {
            font-size: 28px;
            color: #333;
            font-weight: bold;
            margin: 0;
            display: inline-block;
        }
        .btn-custom {
            margin: 5px;
            padding: 10px 15px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        .btn-back {
            left: 0;
        }
        .btn-print {
            right: 0;
        }
        .table th, .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }
        .table tr:hover {
            background-color: #f1f1f1;
        }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .table th {
                background-color: #007bff !important;
                color: white !important;
            }
            .btn-custom {
                display: none;
            }
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>

<section class="content">
    <div class="container">
        <div class="title-section">
            <h3>Data Jadwal</h3>
            <a href="<?= base_url('index.php/jadwal'); ?>" class="btn btn-secondary btn-custom btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <button onclick="printPage()" class="btn btn-primary btn-custom btn-print">
                <i class="fas fa-print"></i> Print
            </button>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Jadwal</th>
                    <th>Mata Kuliah</th>
                    <th>ID Dosen</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Ruangan</th>
                    <th>Program Studi</th>
                    <th>Hari Jadwal</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kode MK</th>
                    <th>Kelas Jadwal</th>
                    <th>Unit Kelas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($jadwal as $jdwl): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $jdwl->id_jadwal ?></td>
                        <td><?= $jdwl->mata_kuliah ?></td>
                        <td><?= $jdwl->jadwal_id_dosen ?></td>  <!-- ID Dosen -->
                        <td><?= $jdwl->created_at ?></td>
                        <td><?= $jdwl->updated_at ?></td>
                        <td><?= $jdwl->ruangan ?></td>
                        <td><?= $jdwl->program_studi ?></td>
                        <td><?= $jdwl->hari_jadwal ?></td>
                        <td><?= $jdwl->jam_mulai ?></td>
                        <td><?= $jdwl->jam_selesai ?></td>
                        <td><?= $jdwl->kode_mk ?></td>
                        <td><?= $jdwl->kelas_jadwal ?></td>
                        <td><?= $jdwl->unit_kelas ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>