<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header pastel-header">
                <h5 class="text-center" style="font-family: 'Poppins', sans-serif; font-size: 2em;">
                    Edit Mata Kuliah
                </h5>
            </div>
            <div class="card-body">
                <?= form_open('mata_kuliah/edit_aksi/' . $mata_kuliah->id_mata_kuliah, ['class' => 'needs-validation', 'novalidate' => true]) ?>
                <div class="mb-3">
                    <label for="kode_mk" class="form-label pastel-label">Kode Mata Kuliah</label>
                    <input 
                        type="text" 
                        name="kode_mk" 
                        id="kode_mk" 
                        class="form-control rounded-pill pastel-input" 
                        value="<?= $mata_kuliah->kode_mk ?>" 
                        required>
                    <div class="invalid-feedback">Kode mata kuliah harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="mata_kuliah" class="form-label pastel-label">Nama Mata Kuliah</label>
                    <input 
                        type="text" 
                        name="mata_kuliah" 
                        id="mata_kuliah" 
                        class="form-control rounded-pill pastel-input" 
                        value="<?= $mata_kuliah->mata_kuliah ?>" 
                        required>
                    <div class="invalid-feedback">Nama mata kuliah harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="nama_mk_sebelumnya" class="form-label pastel-label">Nama Mata Kuliah Sebelumnya</label>
                    <input 
                        type="text" 
                        name="nama_mk_sebelumnya" 
                        id="nama_mk_sebelumnya" 
                        class="form-control rounded-pill pastel-input" 
                        value="<?= $mata_kuliah->nama_mk_sebelumnya ?>">
                </div>
                <div class="mb-3">
                    <label for="prasyarat_mk" class="form-label pastel-label">Prasyarat Mata Kuliah</label>
                    <input 
                        type="text" 
                        name="prasyarat_mk" 
                        id="prasyarat_mk" 
                        class="form-control rounded-pill pastel-input" 
                        value="<?= $mata_kuliah->prasyarat_mk ?>">
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label pastel-label">Semester</label>
                    <select 
                        name="semester" 
                        id="semester" 
                        class="form-control rounded-pill pastel-input" 
                        required>
                        <option value="" disabled>Pilih Semester</option>
                        <?php 
                        $semester_options = [
                            "I" => "I",
                            "II" => "II",
                            "III" => "III",
                            "IV" => "IV",
                            "V" => "V",
                            "VI" => "VI",
                            "VII" => "VII",
                            "VIII" => "VIII"
                        ];
                        foreach ($semester_options as $value => $label): ?>
                            <option value="<?= $value ?>" <?= $mata_kuliah->semester == $value ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="invalid-feedback">Semester harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="jumlah_sks" class="form-label pastel-label">Jumlah SKS</label>
                    <select 
                        name="jumlah_sks" 
                        id="jumlah_sks" 
                        class="form-control rounded-pill pastel-input" 
                        required>
                        <option value="" disabled>Pilih jumlah SKS</option>
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <option value="<?= $i ?>" <?= $mata_kuliah->jumlah_sks == $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <div class="invalid-feedback">Jumlah SKS harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="konsentrasi" class="form-label pastel-label">Konsentrasi</label>
                    <select 
                        name="konsentrasi" 
                        id="konsentrasi" 
                        class="form-control rounded-pill pastel-input" 
                        required>
                        <option value="" disabled>Pilih konsentrasi</option>
                        <?php 
                        $konsentrasi_options = [
                            "MKCU" => "MKCU (Mata Kuliah Ciri Universitas)",
                            "MKWP" => "MKWP (Mata Kuliah Wajib Prodi)",
                            "MKCF" => "MKCF (Mata Kuliah Ciri Fakultas)",
                            "MKPP_DS" => "MKPP (Pilihan Prodi) Data Science",
                            "MKPP_NS" => "MKPP (Pilihan Prodi) Network Solution"
                        ];
                        foreach ($konsentrasi_options as $value => $label): ?>
                            <option value="<?= $value ?>" <?= $mata_kuliah->konsentrasi == $value ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Konsentrasi harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="nilai_minimal_kelulusan" class="form-label pastel-label">Nilai Minimal Kelulusan</label>
                    <select 
                        name="nilai_minimal_kelulusan" 
                        id="nilai_minimal_kelulusan" 
                        class="form-control rounded-pill pastel-input" 
                        required>
                        <option value="" disabled>Pilih nilai minimal kelulusan</option>
                        <?php foreach (['A', 'B', 'C', 'D'] as $nilai): ?>
                            <option value="<?= $nilai ?>" <?= $mata_kuliah->nilai_minimal_kelulusan == $nilai ? 'selected' : '' ?>><?= $nilai ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Nilai minimal kelulusan harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_mk" class="form-label pastel-label">Deskripsi Mata Kuliah</label>
                    <textarea 
                        name="deskripsi_mk" 
                        id="deskripsi_mk" 
                        class="form-control rounded-pill pastel-input" 
                        rows="3"><?= $mata_kuliah->deskripsi_mk ?></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn pastel-button-save rounded-pill">Update</button>
                    <a href="<?= base_url('mata_kuliah') ?>" class="btn pastel-button-cancel rounded-pill">Batal</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<style>
    body {
        background-color: #F8F4FF; /* Lavender pastel background */
        font-family: 'Poppins', sans-serif;
    }

    .pastel-card {
        max-width: 1200px;
        margin: auto;
        border-radius: 15px;
        background: linear-gradient(145deg, #ffffff, #F1E6FA); /* Gradient lavender */
        box-shadow: 8px 8px 16px #D5B3E8, -8px -8px 16px #ffffff; /* Soft purple shadows */
    }

    .pastel-header {
        background-color: #CBA6E6; /* Light pastel purple */
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
    }

    .pastel-label {
        color: #A785C5; /* Soft purple for label text */
        font-weight: bold;
        margin-bottom: 5px;
    }

    .pastel-input {
        background-color: #F1E6FA; /* Lavender pastel background for input */
        border: 1px solid #D5B3E8; /* Pastel purple border */
        border-radius: 50px;
        padding: 8px 12px;
        font-size: 1em;
        color: #6B4E8A; /* Darker purple for text */
        box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .pastel-input:hover {
        background-color: #F8F4FF; /* Lighter lavender on hover */
        border-color: #CBA6E6; /* Highlighted purple */
        box-shadow: 0 0 10px rgba(203, 166, 230, 0.4);
    }

    .pastel-button-save {
        background-color: #CBA6E6; /* Light pastel purple for save button */
        color: white;
        border: none;
        padding: 10px 30px;
        margin-right: 10px;
    }

    .pastel-button-save:hover {
        background-color: #A785C5; /* Slightly darker pastel purple */
        box-shadow: 0 4px 8px rgba(167, 133, 197, 0.3);
    }

    .pastel-button-cancel {
        background-color: #E6D5F5; /* Lavender pastel for cancel button */
        color: #6B4E8A; /* Darker purple for text */
        border: none;
        padding: 10px 30px;
    }

    .pastel-button-cancel:hover {
        background-color: #D8BFE8; /* Slightly darker lavender */
        box-shadow: 0 4px 8px rgba(216, 191, 232, 0.3);
    }

    .container {
        max-width: 900px;
    }
</style>

