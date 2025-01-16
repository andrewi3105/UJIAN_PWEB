<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header pastel-header d-flex align-items-center">
                <i class="fas fa-calendar-alt me-3" style="font-size: 1.5em;"></i>
                <h5 class="text-center m-0" style="font-family: 'Poppins', sans-serif; font-size: 2em;">
                    Detail Jadwal
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label pastel-label">Kode Mata Kuliah</label>
                    <p class="form-control-static pastel-display" id="kode_mk"><?= $jadwal->kode_mk ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Mata Kuliah</label>
                    <p class="form-control-static pastel-display" id="mata_kuliah"><?= $jadwal->mata_kuliah ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Dosen</label>
                    <p class="form-control-static pastel-display" id="nama_dosen"><?= $jadwal->nama_dosen ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Hari Jadwal</label>
                    <p class="form-control-static pastel-display" id="hari_jadwal"><?= $jadwal->hari_jadwal ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Jam Mulai</label>
                    <p class="form-control-static pastel-display" id="jam_mulai"><?= $jadwal->jam_mulai ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Jam Selesai</label>
                    <p class="form-control-static pastel-display" id="jam_selesai"><?= $jadwal->jam_selesai ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Kelas</label>
                    <p class="form-control-static pastel-display" id="kelas_jadwal"><?= $jadwal->kelas_jadwal ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Unit Kelas</label>
                    <p class="form-control-static pastel-display" id="unit_kelas"><?= $jadwal->unit_kelas ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Ruangan</label>
                    <p class="form-control-static pastel-display" id="ruangan"><?= $jadwal->ruangan ?? 'Tidak Diketahui' ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Program Studi</label>
                    <p class="form-control-static pastel-display" id="program_studi"><?= $jadwal->program_studi ?? 'Tidak Diketahui' ?></p>
                </div>
                <div class="text-center">
                    <a href="<?= base_url('jadwal/edit/' . $jadwal->id_jadwal) ?>" class="btn pastel-button-edit rounded-pill">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="<?= base_url('jadwal') ?>" class="btn pastel-button-back rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    body {
        background-color: #F8F4FF; /* Lavender pastel */
        font-family: 'Poppins', sans-serif;
    }

    .pastel-card {
        max-width: 1200px;
        margin: auto;
        border-radius: 15px;
        background: linear-gradient(145deg, #ffffff, #F1E6FA); /* Lavender gradient */
        box-shadow: 8px 8px 16px #D5B3E8, -8px -8px 16px #ffffff; /* Soft purple shadows */
    }

    .pastel-header {
        background-color: #CBA6E6; /* Soft purple */
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
    }

    .pastel-label {
        color: #A785C5; /* Pastel purple */
        font-weight: bold;
        margin-bottom: 5px;
    }

    .pastel-display {
        background-color: #F1E6FA; /* Lavender background */
        border: 1px solid #D5B3E8; /* Pastel purple border */
        border-radius: 50px;
        padding: 8px 12px;
        font-size: 1em;
        color: #6B4E8A; /* Darker purple text */
        box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
    }

    .pastel-display:hover {
        background-color: #F8F4FF; /* Lighter hover effect */
        border-color: #CBA6E6; /* Soft purple hover */
        box-shadow: 0 0 10px rgba(203, 166, 230, 0.4);
    }

    .pastel-button-edit {
        background-color: #CBA6E6; /* Soft purple button */
        color: white;
        border: none;
        padding: 10px 30px;
        margin-right: 10px;
    }

    .pastel-button-edit:hover {
        background-color: #A785C5; /* Slightly darker on hover */
        box-shadow: 0 4px 8px rgba(167, 133, 197, 0.3);
    }

    .pastel-button-back {
        background-color: #E6D5F5; /* Lighter lavender */
        color: #6B4E8A; /* Darker purple text */
        border: none;
        padding: 10px 30px;
    }

    .pastel-button-back:hover {
        background-color: #D8BFE8; /* Slightly darker on hover */
        box-shadow: 0 4px 8px rgba(216, 191, 232, 0.3);
    }

    .container {
        max-width: 900px; /* Container width adjusted */
    }
</style>
