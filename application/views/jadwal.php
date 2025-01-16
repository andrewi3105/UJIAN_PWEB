<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 1200px;">
            <div class="card-header">
                <h5 class="mb-0 text-center text-primary" style="font-family: 'Poppins', sans-serif; font-size: 2.2em; font-weight: 600; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);">
                    Jadwal Perkuliahan
                </h5>

                <!-- Flashdata for success message -->
                <?php if ($this->session->flashdata('message')): ?>
                    <div class="alert alert-success mt-3 rounded-pill">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <!-- Button Group -->
                    <div class="btn-group" role="group" aria-label="Button Group">
                        <a href="<?= base_url('jadwal/tambah') ?>" class="btn btn-pastelPurple rounded-pill me-2">
                            <i class="bi bi-plus-circle"></i> Tambah Jadwal
                        </a>
                        <a href="<?= base_url('jadwal/print_jadwal') ?>" class="btn btn-pastelPink rounded-pill me-2">
                            <i class="fas fa-print"></i> Print
                        </a>
                        <div class="btn-group me-2">
                            <button class="btn btn-pastelGreen dropdown-toggle rounded-pill" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-download"></i> Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="<?= base_url('jadwal/pdf1') ?>">PDF</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('jadwal/exportExcel') ?>">Excel</a></li>
                            </ul>
                        </div>
                        <a href="<?= base_url('jadwal/grafik') ?>" class="btn btn-pastelPink rounded-pill">
                            <i class="fas fa-chart-bar"></i> Grafik
                        </a>
                    </div>

                    <!-- Search Form -->
                    <?= form_open('jadwal/index', ['class' => 'd-flex']) ?>
                    <input type="text" name="keyword" class="form-control rounded-pill me-2 pastel-input" placeholder="Search" style="width: 300px;" value="<?= set_value('keyword', $this->input->post('keyword')) ?>">
                    <button type="submit" class="btn btn-pastelPurple rounded-pill">Cari</button>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>HARI</th>
                            <th>JAM MULAI</th>
                            <th>JAM SELESAI</th>
                            <th>KODE MK</th>
                            <th>MATA KULIAH</th>
                            <th>KELAS</th>
                            <th>DOSEN</th>
                            <th>UNIT KELAS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $j) : ?>
                        <tr style="background-color: <?= $no % 2 == 0 ? '#E6D9FF' : '#FFFFFF'; ?>;">
                            <td><?= $no++ ?></td>
                            <td><?= isset($j->hari_jadwal) ? $j->hari_jadwal : '-' ?></td>
                            <td><?= isset($j->jam_mulai) ? $j->jam_mulai : '-' ?></td>
                            <td><?= isset($j->jam_selesai) ? $j->jam_selesai : '-' ?></td>
                            <td><?= isset($j->kode_mk) ? $j->kode_mk : '-' ?></td>
                            <td><?= isset($j->mata_kuliah) ? $j->mata_kuliah : '-' ?></td>
                            <td><?= isset($j->kelas_jadwal) ? $j->kelas_jadwal : '-' ?></td>
                            <td><?= isset($j->nama_dosen) ? $j->nama_dosen : '-' ?></td>
                            <td><?= isset($j->unit_kelas) ? $j->unit_kelas : '-' ?></td>
                            <td style="white-space: nowrap;">
                                <?= anchor('jadwal/detail/' . $j->id_jadwal, '<button class="btn btn-pastelGreen rounded-pill me-1"><i class="bi bi-search"></i> Detail</button>') ?>
                                <a href="<?= site_url('jadwal/delete/' . $j->id_jadwal); ?>" class="btn btn-pastelPink rounded-pill me-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                                <a href="<?= site_url('jadwal/edit/' . $j->id_jadwal); ?>" class="btn btn-pastelPurple rounded-pill">
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
        background-color: #B39CD0 !important; /* Soft pastel purple */
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
        background-color: #F3F0F9;
    }

    /* Styling for button colors and borders */
    .btn-pastelPurple {
        background-color: #9E77C6;
        color: white;
    }
    .btn-pastelPurple:hover {
        background-color: #7D5FA3;
    }

    .btn-pastelPink {
        background-color: #EAC4D5;
        color: white;
    }
    .btn-pastelPink:hover {
        background-color: #D89CB4;
    }

    .btn-pastelGreen {
        background-color: #B3D6C6;
        color: white;
    }
    .btn-pastelGreen:hover {
        background-color: #8ABFA0;
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
