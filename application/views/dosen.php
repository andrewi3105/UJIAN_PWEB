<section class="content">
    <div class="container mt-5" style="max-width: 1600px;"> <!-- Set max width of the container -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-center text-primary" style="font-family: 'Poppins', sans-serif; font-size: 2.2em; font-weight: 600; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                    Data Dosen
                </h5>

                <!-- Flashdata for success message -->
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success mt-3">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="btn-group" role="group" aria-label="Button Group">
                        <!-- Tambah Data Dosen Button -->
                        <a href="<?= base_url('index.php/dosen/tambah'); ?>" class="btn btn-pastelPurple rounded-pill me-2">
                            <i class="bi bi-plus-circle"></i> Tambah Data Dosen
                        </a>

                        <!-- Print Button -->
                        <a href="<?= site_url('dosen/print_dosen'); ?>" class="btn btn-pastelPink rounded-pill me-2">
                            <i class="fas fa-print"></i> Print
                        </a>

                        <!-- Export Button -->
                        <div class="btn-group me-2">
                            <button class="btn btn-pastelPurple dropdown-toggle rounded-pill" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-download"></i> Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="<?php echo base_url('dosen/pdf1') ?>">PDF</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('dosen/exportExcel') ?>">Excel</a></li>
                            </ul>
                        </div>

                        <!-- Grafik Button -->
                        <a class="btn btn-pastelPink rounded-pill me-2" href="<?= base_url('dosen/tampil_grafik'); ?>">
                            <i class="fas fa-chart-area"></i> Grafik
                        </a>
                    </div>

                    <!-- Search Form -->
                    <?= form_open('dosen/index', ['class' => 'd-flex']) ?>
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
                            <th style="width: 6%;">NO</th>
                            <th style="width: 10%;">FOTO</th>
                            <th style="width: 15%;">NAMA DOSEN</th>
                            <th style="width: 12%;">NOMER INDUK</th>
                            <th style="width: 15%;">MATA KULIAH</th>
                            <th style="width: 15%;">PROGRAM STUDI</th>
                            <th style="width: 20%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dosen as $dsn) : ?>
                            <tr style="background-color: <?= $no % 2 == 0 ? '#E8D7F1' : '#FFFFFF'; ?>;">
                                <td><?php echo $no++ ?></td>

                                <!-- Display dosen's photo -->
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php if ($dsn->foto_dosen): ?>
                                        <img src="<?= base_url('uploads/' . $dsn->foto_dosen); ?>" alt="Foto Dosen" width="80" height="80" class="rounded-circle" style="object-fit: cover;">
                                    <?php else: ?>
                                        <img src="<?= base_url('uploads/default.png'); ?>" alt="Foto Dosen" width="80" height="80" class="rounded-circle" style="object-fit: cover;">
                                    <?php endif; ?>
                                </td>

                                <td><?php echo $dsn->nama_dosen ?></td>
                                <td><?php echo $dsn->nomer_induk_dosen ?></td>
                                <td><?php echo $dsn->mata_kuliah_dosen ?></td>
                                <td><?php echo $dsn->program_studi_dosen ?></td>
                                <td style="white-space: nowrap;">
                                    <?= anchor('dosen/detail/' . $dsn->id_dosen, '<button class="btn btn-success rounded-pill me-1"><i class="bi bi-search"></i> Detail</button>') ?>
                                    <a href="<?= site_url('dosen/delete/' . $dsn->id_dosen); ?>" class="btn btn-danger rounded-pill me-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                    <a href="<?= site_url('dosen/edit/' . $dsn->id_dosen); ?>" class="btn btn-warning rounded-pill">
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
        background-color: #C8A2C8 !important; /* Pastel purple */
        color: white !important;
        font-weight: bold;
        font-size: 1.1em;
        text-transform: uppercase;
    }

    /* Styling for the table rows */
    table td {
        font-size: 1em;
        font-weight: 400;
        color: #333;
    }

    /* Center align the content of table headers and cells */
    table th, table td {
        text-align: center;
        vertical-align: middle;
    }

    /* Optional: Styling for table rows on hover */
    table tr:hover {
        background-color: #F3E9F7;
    }

    /* Styling for button colors and borders */
    .btn-pastelPurple {
        background-color: #A785C5;
        color: white;
    }
    .btn-pastelPurple:hover {
        background-color: #916BA6;
    }

    .btn-pastelPink {
        background-color: #F4A6B8;
        color: white;
    }
    .btn-pastelPink:hover {
        background-color: #F18C99;
    }

    /* Rounded corners for form inputs */
    .form-control {
        border-radius: 50px;
    }

    .alert {
        border-radius: 20px;
    }

    /* Custom width for the card */
    .card {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
</style>
