<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Mata Kuliah</title>
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

        /* Styling untuk tabel */
        .table {
            table-layout: fixed;
            width: 100%;
        }

        .table th, .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            vertical-align: top;
            word-wrap: break-word;
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
        }

        .table tr {
            display: table-row;
        }

        .table tr td, .table tr th {
            height: 100%; /* Mengatur agar setiap sel mengikuti tinggi maksimum dalam baris */
        }

        /* Specify width for the 'Deskripsi' column */
        .table th:nth-child(10), .table td:nth-child(10) {
            width: 30%; /* Adjust the width here as needed */
        }

        .table img {
            width: 80px;
            height: auto;
            border-radius: 4px;
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
        }
        </style>
<script>
function triggerPrint() {
    setTimeout(function() {
        window.print(); // Memanggil dialog print dengan delay kecil
    }, 100); // 100ms delay
}
</script>
</head>
<body>

<section class="content">
    <div class="container">
        <div class="title-section">
            <h3>Data Mata Kuliah</h3>
            <a href="<?= base_url('index.php/mata_kuliah'); ?>" class="btn btn-secondary btn-custom btn-back"><i class="fas fa-arrow-left"></i> Back</a>
            <button onclick="triggerPrint()" class="btn btn-primary btn-custom btn-print"><i class="fas fa-print"></i> Print</button>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>Nama MK Sebelumnya</th>
                    <th>Prasyarat MK</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>Konsentrasi</th>
                    <th>Nilai Minimum</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                foreach ($mata_kuliah as $mk): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $mk->kode_mk ?></td>
                        <td><?= $mk->mata_kuliah ?></td>
                        <td><?= $mk->nama_mk_sebelumnya ?></td>
                        <td><?= $mk->prasyarat_mk ?></td>
                        <td><?= $mk->semester ?></td>
                        <td><?= $mk->jumlah_sks ?></td>
                        <td><?= $mk->konsentrasi ?></td>
                        <td><?= $mk->nilai_minimal_kelulusan ?></td>
                        <td><?= $mk->deskripsi_mk ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
