<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 1200px;">
            <div class="card-header">
                <h5 class="mb-0 text-center text-primary" style="font-family: 'Poppins', sans-serif; font-size: 2.2em; font-weight: 600; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                    Daftar Mata Kuliah
                </h5>

                <!-- Flashdata for success message -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="btn-group d-flex flex-wrap gap-2" role="group" aria-label="Button Group">
                    <!-- Tambah Mata Kuliah Button -->
                    <a href="<?= base_url('mata_kuliah/tambah') ?>" class="btn btn-pastelBlue rounded-pill">
                        <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
                    </a>

                    <!-- Print Button -->
                    <a href="<?= base_url('mata_kuliah/print_mata_kuliah') ?>" class="btn btn-pastelPink rounded-pill">
                        <i class="fas fa-print"></i> Print
                    </a>

                    <!-- Export Button -->
                    <div class="btn-group">
                        <button class="btn btn-pastelGreen dropdown-toggle rounded-pill" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-download"></i> Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('mata_kuliah/pdf1') ?>">PDF</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('mata_kuliah/exportExcel') ?>">Excel</a></li>
                        </ul>
                    </div>

                    <!-- Grafik Button -->
                    <a href="<?= base_url('mata_kuliah/grafik') ?>" class="btn btn-pastelPink rounded-pill">
                        <i class="fas fa-chart-bar"></i> Grafik
                    </a>
                </div>


                <div class="d-flex justify-content-between align-items-center mt-3">
                        <!-- Search Form -->
                        <?= form_open('mata_kuliah/index', ['class' => 'd-flex']) ?>
                        <input 
                            type="text" 
                            name="keyword" 
                            class="form-control rounded-pill me-2" 
                            placeholder="Search Mata Kuliah" 
                            style="width: 300px;" 
                            value="<?= set_value('keyword', $this->session->userdata('keyword')) ?>">
                        <button type="submit" class="btn btn-success rounded-pill">Cari</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>

            <div class="card-body">		
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KODE MK</th>
                            <th>MATA KULIAH</th>
                            <th>DESKRIPSI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach ($mata_kuliah as $mk) : ?>
                        <tr style="background-color: <?= $no % 2 == 0 ? '#C1D9E1' : '#FFFFFF'; ?>;">
                            <td><?= $no++ ?></td>
                            <td><?= isset($mk->kode_mk) ? $mk->kode_mk : '-' ?></td>
                            <td><?= isset($mk->mata_kuliah) ? $mk->mata_kuliah : '-' ?></td>
                            <td><?= isset($mk->deskripsi_mk) ? $mk->deskripsi_mk : '-' ?></td>
                            <td style="white-space: nowrap;">
                                <?= anchor('mata_kuliah/detail/' . $mk->id_mata_kuliah, '<button class="btn btn-success rounded-pill me-1"><i class="bi bi-search"></i> Detail</button>') ?>
                                <a href="<?= site_url('mata_kuliah/delete/' . $mk->id_mata_kuliah); ?>" class="btn btn-danger rounded-pill me-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                                <a href="<?= site_url('mata_kuliah/edit/' . $mk->id_mata_kuliah); ?>" class="btn btn-warning rounded-pill">
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
    /* Importing Poppins font for a cute and modern look */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    /* Base styling */
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Styling for table headers */
    table th {
        background-color: #D5B3E8 !important; /* Slightly darker pastel blue */
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
        background-color: #F3F4F6;
    }

    /* Styling for button colors and borders */
    .btn-pastelBlue {
        background-color: #916BA6;
        color: white;
    }
    .btn-pastelBlue:hover {
        background-color: #4C8DA1;
    }

    .btn-pastelPink {
        background-color: #F4A6B8;
        color: white;
    }
    .btn-pastelPink:hover {
        background-color: #F18C99;
    }

    .btn-pastelGreen {
        background-color: #80C9A4;
        color: white;
    }
    .btn-pastelGreen:hover {
        background-color: #6B9F7D;
    }

    .btn-pastelYellow {
        background-color: #FFEB98;
        color: white;
    }
    .btn-pastelYellow:hover {
        background-color: #FFDA64;
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
