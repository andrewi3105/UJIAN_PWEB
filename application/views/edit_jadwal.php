<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header pastel-header">
                <h5 class="text-center" style="font-family: 'Poppins', sans-serif; font-size: 2em;">
                    Edit Jadwal Perkuliahan
                </h5>
            </div>
            <div class="card-body">
                <?php if (isset($jadwal) && isset($dosen)): ?>
                    <?= form_open('jadwal/edit_aksi/' . $jadwal->id_jadwal, ['class' => 'needs-validation', 'novalidate' => true]) ?>

                    <!-- Kode MK -->
                    <div class="mb-3">
                        <label for="kode_mk" class="form-label pastel-label">Kode Mata Kuliah</label>
                        <input type="text" name="kode_mk" id="kode_mk" class="form-control rounded-pill pastel-input" value="<?= $jadwal->kode_mk ?>" required>
                        <div class="invalid-feedback">Kode mata kuliah harus diisi.</div>
                    </div>

                    <!-- Mata Kuliah -->
                    <div class="mb-3">
                        <label for="mata_kuliah" class="form-label pastel-label">Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" id="mata_kuliah" class="form-control rounded-pill pastel-input" value="<?= $jadwal->mata_kuliah ?>" required>
                        <div class="invalid-feedback">Nama mata kuliah harus diisi.</div>
                    </div>

                    <!-- Dropdown Dosen -->
                    <div class="mb-3">
                        <label for="dosen" class="form-label pastel-label">Dosen</label>
                        <select name="id_dosen" class="form-control pastel-input" required>
                            <option value="">Pilih Dosen</option>
                            <?php foreach ($dosen as $d): ?>
                                <option value="<?= $d->id_dosen ?>" <?= ($d->id_dosen == $jadwal->jadwal_id_dosen) ? 'selected' : '' ?>>
                                    <?= $d->nama_dosen ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Dosen harus diisi.</div>
                    </div>

                    <!-- Hari Jadwal -->
                    <div class="mb-3">
                        <label for="hari_jadwal" class="form-label pastel-label">Hari Jadwal</label>
                        <input type="text" name="hari_jadwal" id="hari_jadwal" class="form-control rounded-pill pastel-input" value="<?= $jadwal->hari_jadwal ?>" required>
                        <div class="invalid-feedback">Hari jadwal harus diisi.</div>
                    </div>

                    <!-- Jam Mulai -->
                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label pastel-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control rounded-pill pastel-input" value="<?= $jadwal->jam_mulai ?>" required>
                        <div class="invalid-feedback">Jam mulai harus diisi.</div>
                    </div>

                    <!-- Jam Selesai -->
                    <div class="mb-3">
                        <label for="jam_selesai" class="form-label pastel-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control rounded-pill pastel-input" value="<?= $jadwal->jam_selesai ?>" required>
                        <div class="invalid-feedback">Jam selesai harus diisi.</div>
                    </div>

                    <!-- Kelas -->
                    <div class="mb-3">
                        <label for="kelas_jadwal" class="form-label pastel-label">Kelas</label>
                        <input type="text" name="kelas_jadwal" id="kelas_jadwal" class="form-control rounded-pill pastel-input" value="<?= $jadwal->kelas_jadwal ?>" required>
                        <div class="invalid-feedback">Kelas harus diisi.</div>
                    </div>

                    <!-- Unit Kelas -->
                    <div class="mb-3">
                        <label for="unit_kelas" class="form-label pastel-label">Unit Kelas</label>
                        <input type="text" name="unit_kelas" id="unit_kelas" class="form-control rounded-pill pastel-input" value="<?= $jadwal->unit_kelas ?>" required>
                        <div class="invalid-feedback">Unit kelas harus diisi.</div>
                    </div>

                    <!-- Ruangan -->
                    <div class="mb-3">
                        <label for="ruangan" class="form-label pastel-label">Ruangan</label>
                        <input type="text" name="ruangan" id="ruangan" class="form-control rounded-pill pastel-input" value="<?= $jadwal->ruangan ?>" required>
                        <div class="invalid-feedback">Ruangan harus diisi.</div>
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-3">
                        <label for="program_studi" class="form-label pastel-label">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi" class="form-control rounded-pill pastel-input" value="<?= $jadwal->program_studi ?>" required>
                        <div class="invalid-feedback">Program studi harus diisi.</div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-center">
                        <button type="submit" class="btn pastel-button-save rounded-pill">Simpan Perubahan</button>
                        <a href="<?= base_url('jadwal') ?>" class="btn pastel-button-cancel rounded-pill">Batal</a>
                    </div>
                    <?= form_close() ?>
                <?php else: ?>
                    <p class="text-danger">Data jadwal atau dosen tidak ditemukan.</p>
                <?php endif; ?>
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
    }

    .pastel-input {
        background-color: #F1E6FA; /* Lavender background */
        border: 1px solid #D5B3E8; /* Pastel purple border */
        border-radius: 50px;
        padding: 8px 12px;
        color: #6B4E8A; /* Darker purple text */
    }

    .pastel-button-save {
        background-color: #CBA6E6; /* Soft purple button */
        color: white;
        border: none;
        padding: 10px 30px;
    }

    .pastel-button-save:hover {
        background-color: #A785C5; /* Slightly darker on hover */
    }

    .pastel-button-cancel {
        background-color: #E6D5F5; /* Lighter lavender */
        color: #6B4E8A; /* Darker purple text */
        border: none;
        padding: 10px 30px;
    }

    .pastel-button-cancel:hover {
        background-color: #D8BFE8; /* Slightly darker on hover */
    }
</style>
