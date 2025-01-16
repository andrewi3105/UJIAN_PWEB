<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/sidebar'); ?>

<div class="content">
    <h3 class="title">Tambah Jadwal Perkuliahan</h3>
    <form action="<?= base_url('jadwal/tambah_aksi') ?>" method="POST" class="form-container">
        <div class="form-group">
            <label for="hari">Hari</label>
            <input type="text" name="hari_jadwal" id="hari" class="form-control" placeholder="Masukkan hari" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="kode_mk">Kode Mata Kuliah</label>
            <select name="kode_mk" class="form-control" id="kode_mk" required onchange="fillMataKuliah()">
                <option value="">Pilih Kode Mata Kuliah</option>
                <?php foreach ($mata_kuliah as $row): ?>
                    <option value="<?= $row->kode_mk ?>" data-mata-kuliah="<?= $row->mata_kuliah ?>"><?= $row->kode_mk ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="mata_kuliah">Mata Kuliah</label>
            <input type="text" name="mata_kuliah" id="mata_kuliah" class="form-control" placeholder=" " required readonly>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas_jadwal" id="kelas" class="form-control" placeholder="Masukkan kelas" required>
        </div>

        <div class="form-group">
            <label for="id_dosen">ID Dosen</label>
            <select name="id_dosen" class="form-control" id="id_dosen" required onchange="fillDosen()">
                <option value="">Pilih ID Dosen</option>
                <?php foreach ($dosen as $row): ?>
                    <option value="<?= $row->id_dosen ?>" data-nama-dosen="<?= $row->nama_dosen ?>"><?= $row->id_dosen ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="nama_dosen">Nama Dosen</label>
            <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" placeholder=" " required readonly>
        </div>

        <div class="form-group">
            <label for="unit">Unit Kelas</label>
            <input type="text" name="unit_kelas" id="unit" class="form-control" placeholder="Masukkan unit kelas" required>
        </div>
        <div class="form-group">
    <label for="ruangan">Ruangan</label>
    <input type="text" name="ruangan" id="ruangan" class="form-control" placeholder="Masukkan ruangan" required>
</div>
<div class="form-group">
    <label for="program_studi">Program Studi</label>
    <select name="program_studi" id="program_studi" class="form-control" required>
        <option value="">Pilih Program Studi</option>
        <option value="Akuntansi">Program Diploma 3 Akuntansi</option>
        <option value="D3 Manajemen Perusahaan">D3 Manajemen Perusahaan</option>
        <option value="MICE">MICE</option>
        
        <!-- Fakultas Desain, Seni dan Kreatif -->
        <option value="Desain Interior">Desain Interior</option>
        <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
        <option value="Desain Produk">Desain Produk (Grafis & Multimedia)</option>
        
        <!-- Fakultas Teknik -->
        <option value="Arsitektur">Arsitektur</option>
        <option value="Teknik Elektro">Teknik Elektro</option>
        <option value="Teknik Industri">Teknik Industri</option>
        <option value="Teknik Mesin">Teknik Mesin</option>
        <option value="Teknik Sipil">Teknik Sipil</option>
        <option value="S2 Teknik Sipil">S2 Teknik Sipil</option>
        
        <!-- Fakultas Ekonomi dan Bisnis -->
        <option value="Akuntansi">Akuntansi</option>
        <option value="Manajemen">Manajemen</option>
        <option value="S2 Manajemen">S2 Manajemen</option>
        <option value="S3 Manajemen">S3 Manajemen</option>
        
        <!-- Fakultas Ilmu Komunikasi -->
        <option value="Digital Communication">Digital Communication</option>
        <option value="Broadcasting">Broadcasting</option>
        <option value="Marketing Communication & Advertising">Marketing Communication & Advertising</option>
        <option value="Public Relation">Public Relation</option>
        
        <!-- Fakultas Ilmu Komputer -->
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        
        <!-- Fakultas Psikologi -->
        <option value="Psikologi">Psikologi</option>
    </select>
</div>



        <div class="button-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('jadwal') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php $this->load->view('template/footer'); ?>

<script>
    function fillMataKuliah() {
        const selectedKodeMK = document.getElementById('kode_mk').value;
        const options = document.querySelectorAll('#kode_mk option');
        let mataKuliah = '';

        options.forEach(option => {
            if (option.value === selectedKodeMK) {
                mataKuliah = option.getAttribute('data-mata-kuliah');
            }
        });

        document.getElementById('mata_kuliah').value = mataKuliah;
    }

    function fillDosen() {
        const selectedIdDosen = document.getElementById('id_dosen').value;
        const options = document.querySelectorAll('#id_dosen option');
        let namaDosen = '';

        options.forEach(option => {
            if (option.value === selectedIdDosen) {
                namaDosen = option.getAttribute('data-nama-dosen');
            }
        });

        document.getElementById('nama_dosen').value = namaDosen;
    }
</script>

<style>
    body {
    background-color: #f3e5f5;
    font-family: 'Poppins', sans-serif;
}

.content {
    margin: 30px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 800px;
}

.title {
    text-align: center;
    font-size: 2em;
    color: #ba68c8;
    margin-bottom: 20px;
}

.form-container .form-group label {
    font-weight: bold;
    color: #8e24aa;
}

.form-control {
    border-radius: 20px;
    padding: 12px 15px;
    font-size: 1em;
    border: 1px solid #d1c4e9;
    background-color: #f3e5f5;
}

.form-control:focus {
    border-color: #ba68c8;
    box-shadow: 0 0 8px rgba(186, 104, 200, 0.5);
}

.btn {
    border-radius: 20px;
    padding: 10px 30px;
    font-size: 1em;
}

.btn-primary {
    background-color: #ba68c8;
    border: none;
}

.btn-primary:hover {
    background-color: #9c4dcc;
}

.btn-secondary {
    background-color: #e1bee7;
    color: #6a1b9a;
    border: none;
}

.btn-secondary:hover {
    background-color: #d1c4e9;
}

.button-group {
    text-align: center;
    margin-top: 20px;
}
</style>
