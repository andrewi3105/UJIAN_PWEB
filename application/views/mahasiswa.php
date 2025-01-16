<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 2000px;">
            <div class="card-header">
                <h5 class="mb-0 text-center text-primary" style="font-family: 'Poppins', sans-serif; font-size: 2.2em; font-weight: 600; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                    Data Mahasiswa
                </h5>

                <!-- Flashdata for success message -->
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success mt-3 rounded-pill">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="btn-group" role="group" aria-label="Button Group">
                        <!-- Tambah Data Mahasiswa Button -->
                        <a href="<?= base_url('index.php/mahasiswa/tambah'); ?>" class="btn btn-pastelPurple rounded-pill me-2">
                            <i class="bi bi-plus-circle"></i> Tambah Data Mahasiswa
                        </a>

                        <!-- Print Button -->
                        <a href="<?= site_url('mahasiswa/print_mahasiswa'); ?>" class="btn btn-pastelPurple rounded-pill me-2">
                            <i class="fas fa-print"></i> Print
                        </a>

                        <!-- Export Button as Dropdown -->
                        <div class="btn-group me-2">
                            <button class="btn btn-pastelPurple dropdown-toggle rounded-pill" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-download"></i> Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="<?php echo base_url('mahasiswa/pdf1') ?>">PDF</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('mahasiswa/exportExcel') ?>">Excel</a></li>
                            </ul>
                        </div>

                        <!-- Grafik Button -->
                        <a class="btn btn-pastelPurple rounded-pill me-2" href="<?= base_url('mahasiswa/tampil_grafik'); ?>">
                            <i class="fas fa-chart-area"></i> Grafik
                        </a>
                    </div>

                    <!-- Search Form -->
                    <?= form_open('mahasiswa/index', ['class' => 'd-flex']) ?>
                    <input 
                        type="text" 
                        name="keyword" 
                        class="form-control rounded-pill me-2" 
                        placeholder="Search" 
                        style="width: 300px;" 
                        value="<?= set_value('keyword', $this->input->post('keyword')) ?>">
                    <button type="submit" class="btn btn-success rounded-pill">Cari</button>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="card-body">		
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 3%; font-size: 1em;">NO</th>
                            <th style="width: 10%; font-size: 1em;">FOTO</th>
                            <th style="width: 15%; font-size: 1em;">NAMA MAHASISWA</th>
                            <th style="width: 10%; font-size: 1em;">NIM</th>
                            <th style="width: 10%; font-size: 1em;">TANGGAL LAHIR</th>
                            <th style="width: 10%; font-size: 1em;">JURUSAN</th>
                            <th style="width: 20%; font-size: 1em;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($mahasiswa as $mhs) : ?>
                            <tr style="background-color: <?= $no % 2 == 0 ? '#E8D7F1' : '#FFFFFF'; ?>;">
                                <td><?php echo $no++ ?></td>

                                <!-- Display student's photo -->
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php if ($mhs->foto): ?>
                                        <img src="<?= base_url('uploads/' . $mhs->foto); ?>" alt="Foto Mahasiswa" width="80" height="80" class="rounded-circle" style="object-fit: cover;">
                                    <?php else: ?>
                                        <img src="<?= base_url('uploads/default.png'); ?>" alt="Foto Mahasiswa" width="80" height="80" class="rounded-circle" style="object-fit: cover;">
                                    <?php endif; ?>
                                </td>

                                <td><?php echo $mhs->nama ?></td>
                                <td><?php echo $mhs->nim ?></td>
                                <td><?php echo $mhs->tgl_lahir ?></td>
                                <td><?php echo $mhs->jurusan ?></td>
                                <td>
                                    <?= anchor('mahasiswa/detail/' . $mhs->id, '<button class="btn btn-pastelPurple rounded-pill"><i class="bi bi-search"></i> Detail</button>') ?>
                                    <a href="<?= site_url('mahasiswa/delete/' . $mhs->id); ?>" class="btn btn-pastelPink rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                    <a href="<?= site_url('mahasiswa/edit/' . $mhs->id); ?>" class="btn btn-pastelPurple rounded-pill">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>            
            </div>
        </div>
    </div>
</section>

<style>
    /* Base styling */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Styling for table headers */
    table th {
        background-color: #D8BFD8 !important; /* Light purple (Thistle) */
        color: white !important;
        font-weight: bold;
        font-size: 1.1em;
        text-transform: uppercase;
    }

    /* Styling for the table rows */
    table td {
        font-size: 1em;
        font-weight: 400;
        color: #4B0082; /* Indigo for better contrast */
    }

    /* Center align the content of table headers and cells */
    table th, table td {
        text-align: center;
        vertical-align: middle;
    }

    /* Optional: Styling for table rows on hover */
    table tr:hover {
        background-color: #E6E6FA; /* Lavender for a soft hover effect */
    }

    /* Styling for button colors and borders */
    .btn-pastelPurple {
        background-color: #BAA5D5; /* Soft purple */
        color: white;
    }
    .btn-pastelPurple:hover {
        background-color: #9C84B7; /* Slightly darker purple */
    }

    .btn-pastelPink {
        background-color: #D8BFD8; /* Thistle (light purple-pink) */
        color: white;
    }
    .btn-pastelPink:hover {
        background-color: #C7A0C7; /* Slightly darker pink-purple */
    }

    .btn-pastelGreen {
        background-color: #C4B7E5; /* Muted pastel purple-green tone */
        color: white;
    }
    .btn-pastelGreen:hover {
        background-color: #A98CC7; /* Darker greenish-purple tone */
    }

    .btn-pastelYellow {
        background-color: #E6E0F8; /* Very soft yellow-purple hue */
        color: white;
    }
    .btn-pastelYellow:hover {
        background-color: #D4C4F0; /* Slightly deeper tone */
    }

    /* Rounded corners for form inputs */
    .form-control {
        border-radius: 50px;
        border: 1px solid #BAA5D5; /* Matching light purple */
    }

    .alert {
        border-radius: 20px;
        background-color: #F3E8FF; /* Very light lavender tone */
        color: #4B0082; /* Indigo for readability */
    }

    /* Custom width for the card */
    .card {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        border: 1px solid #D8BFD8;
        border-radius: 15px;
    }

    /* Optional: Background for body */
    body {
        background-color: #F8F4FF; /* Subtle lavender for body */
    }
</style>

