<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header pastel-header">
                <h5 class="text-center" style="font-family: 'Poppins', sans-serif; font-size: 2em;">
                    Tambah Mata Kuliah
                </h5>
            </div>
            <div class="card-body">
                <?= form_open('mata_kuliah/tambah_aksi', ['class' => 'needs-validation', 'novalidate' => true]) ?>
                <div class="mb-3">
                    <label for="kode_mk" class="form-label pastel-label">Kode Mata Kuliah</label>
                    <input 
                        type="text" 
                        name="kode_mk" 
                        id="kode_mk" 
                        class="form-control rounded-pill pastel-input" 
                        placeholder="Masukkan kode mata kuliah" 
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
                        placeholder="Masukkan nama mata kuliah" 
                        required>
                <div class="invalid-feedback">Nama mata kuliah harus diisi.</div>
                <div class="mb-3">
                    <label for="nama_mk_sebelumnya" class="form-label pastel-label">Nama Mata Kuliah Sebelumnya</label>
                    <input 
                        type="text" 
                        name="nama_mk_sebelumnya" 
                        id="nama_mk_sebelumnya" 
                        class="form-control rounded-pill pastel-input" 
                        placeholder="Masukkan nama mata kuliah sebelumnya (opsional)">
                </div>
                <div class="mb-3">
                    <label for="prasyarat_mk" class="form-label pastel-label">Prasyarat Mata Kuliah</label>
                    <input 
                        type="text" 
                        name="prasyarat_mk" 
                        id="prasyarat_mk" 
                        class="form-control rounded-pill pastel-input" 
                        placeholder="Masukkan prasyarat mata kuliah sebelumnya (opsional)">
                </div>
                <div class="mb-3">
                    <label for="semester" class="form-label pastel-label">Semester</label>
                    <select 
                        name="semester" 
                        id="semester" 
                        class="form-control rounded-pill pastel-input" 
                        required>
                        <option value="" disabled selected>Pilih semester</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                        <option value="VII">VII</option>
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
                        <option value="" disabled selected>Pilih jumlah SKS</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
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
                            <option value="" disabled selected>Pilih konsentrasi</option>
                            <option value="MKCU">MKCU (Mata Kuliah Ciri Universitas)</option>
                            <option value="MKWP">MKWP (Mata Kuliah Wajib Prodi)</option>
                            <option value="MKCF">MKCF (Mata Kuliah Ciri Fakultas)</option>
                            <option value="MKPP_DS">MKPP (Mata Kuliah Pilihan Prodi) Data Science</option>
                            <option value="MKPP_NS">MKPP (Mata Kuliah Pilihan Prodi) Network Solution</option>
                        </select>
                        <div class="invalid-feedback">Konsentrasi harus diisi.</div>
                    </div>
                </div>
                    <div class="mb-3">
                        <label for="nilai_minimal_kelulusan" class="form-label pastel-label">Nilai Minimal Kelulusan</label>
                        <select 
                            name="nilai_minimal_kelulusan" 
                            id="nilai_minimal_kelulusan" 
                            class="form-control rounded-pill pastel-input" 
                            required>
                            <option value="" disabled selected>Pilih nilai minimal kelulusan</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                        <div class="invalid-feedback">Nilai minimal kelulusan harus diisi.</div>
                    </div>
                    <div class="mb-3">
                    <label for="deskripsi_mk" class="form-label pastel-label">Deskripsi Mata Kuliah</label>
                    <textarea 
                        name="deskripsi_mk" 
                        id="deskripsi_mk" 
                        class="form-control rounded-pill pastel-input" 
                        rows="3" 
                        placeholder="Masukkan deskripsi mata kuliah (opsional)"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn pastel-button-save rounded-pill">Simpan</button>
                    <a href="<?= base_url('mata_kuliah') ?>" class="btn pastel-button-cancel rounded-pill">Batal</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<script>
    // Bootstrap validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
<style>
    body {
        background-color: #F8F4FF; /* Soft lavender background */
        font-family: 'Poppins', sans-serif;
    }

    .pastel-card {
        max-width: 900px;
        margin: auto;
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pastel-header {
        background-color: #CBA6E6; /* Light pastel purple */
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px;
        text-align: center;
    }

    .pastel-label {
        color: #A785C5; /* Soft purple for label text */
        font-weight: bold;
    }

    .pastel-input {
        border-radius: 20px;
        padding: 12px;
        border: 1px solid #D5B3E8; /* Pastel purple border */
        background-color: #F1E6FA; /* Light lavender input background */
        font-size: 1em;
    }

    .pastel-input:focus {
        border-color: #CBA6E6; /* Highlighted pastel purple */
        box-shadow: 0 0 8px rgba(203, 166, 230, 0.5);
    }

    .pastel-button-save {
        background-color: #CBA6E6; /* Pastel purple for save button */
        color: white;
        border: none;
        padding: 10px 30px;
        margin-right: 10px;
    }

    .pastel-button-save:hover {
        background-color: #A785C5; /* Slightly darker pastel purple */
    }

    .pastel-button-cancel {
        background-color: #E6D5F5; /* Light lavender for cancel button */
        color: #6B4E8A; /* Darker purple for text */
        border: none;
        padding: 10px 30px;
    }

    .pastel-button-cancel:hover {
        background-color: #D8BFE8; /* Slightly darker lavender */
    }
</style>
