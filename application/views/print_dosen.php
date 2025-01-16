<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Dosen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Styling untuk container utama */
        .content {
            padding-top: 40px;
        }

        /* Styling untuk judul agar lebih elegan */
        .title-section {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px; /* Mengurangi margin bawah */
            border-bottom: 2px solid #007bff;
            font-family: 'Arial', sans-serif;
            position: relative; /* Untuk penempatan tombol */
        }

        .title-section h3 {
            font-size: 28px;
            color: #333;
            font-weight: bold;
            margin: 0;
            display: inline-block; /* Agar bisa berada di tengah */
        }

        /* Styling untuk tombol */
        .btn-custom {
            margin: 5px; /* Mengurangi margin vertical */
            padding: 10px 15px; /* Menambah padding untuk tombol */
            position: absolute; /* Untuk mengatur posisi tombol */
            top: 50%; /* Memposisikan tombol di tengah vertikal */
            transform: translateY(-50%); /* Menyeimbangkan posisi tombol */
        }

        .btn-back {
            left: 0; /* Tombol Back di pojok kiri */
        }

        .btn-print {
            right: 0; /* Tombol Print di pojok kanan */
        }

        /* Styling untuk tabel agar lebih sesuai */
        .table th, .table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 16px;
        }

        /* Styling khusus untuk foto */
        .table img {
            width: 80px;
            height: auto;
            border-radius: 4px;
        }

        /* Hover effect */
        .table tr:hover {
            background-color: #f1f1f1;
        }

        /* CSS untuk media print */
        @media print {
            /* Pastikan latar belakang berwarna tetap muncul */
            body {
                -webkit-print-color-adjust: exact; /* Untuk Chrome */
                print-color-adjust: exact; /* Untuk Firefox */
            }
            .table th {
                background-color: #007bff !important; /* Mengulangi warna biru untuk cetakan */
                color: white !important; /* Warna teks tetap putih */
            }
            .btn, .btn-back {
        display: none; /* Menyembunyikan tombol saat print */
    }
        }
    </style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('printButton').addEventListener('click', function() {
            window.print(); // Memanggil dialog print
        });
    });
</script>






</head>
<body>

<section class="content">
    <div class="container">
        <div class="title-section">
            <h3>Data Dosen</h3>
            <!-- Tombol Back ke halaman utama -->
            <a href="<?= base_url('index.php/dosen'); ?>" class="btn btn-secondary btn-custom btn-back"><i class="fas fa-arrow-left"></i> Back</a>
            <!-- Tombol Print -->
            <button class="btn btn-primary btn-custom btn-print" id="printButton">
    <i class="fas fa-print"></i> Print
</button>




        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>Nomer Induk Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Program Studi</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no=1;
                foreach ($dosen as $dsn): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $dsn->nama_dosen ?></td>
                        <td><?= $dsn->nomer_induk_dosen ?></td>
                        <td><?= $dsn->mata_kuliah_dosen ?></td>
                        <td><?= $dsn->program_studi_dosen ?></td>
                        <td><?= $dsn->no_telp_dosen ?></td>
                        <td><?= $dsn->email_dosen ?></td>
                        <td>
                            <?php if (!empty($dsn->foto_dosen)): ?>
                                <img src="<?= base_url('uploads/' . $dsn->foto_dosen) ?>" alt="Foto Dosen">
                            <?php else: ?>
                                <span>Tidak ada foto</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

</body>
</html>
