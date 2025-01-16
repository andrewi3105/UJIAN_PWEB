<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Data Dosen</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header d-flex justify-content-center align-items-center pastel-header">
                <h3 class="text-center font-weight-bold">Tambah Data Dosen</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('dosen/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_dosen" class="pastel-label">Nama Dosen:</label>
                        <input type="text" class="form-control pastel-input" id="nama_dosen" name="nama_dosen" placeholder="Masukkan Nama Dosen" required>
                    </div>
                    <div class="form-group">
                        <label for="nomer_induk_dosen" class="pastel-label">NIDN/NIDK (Nomer Induk Dosen):</label>
                        <input type="text" class="form-control pastel-input" id="nomer_induk_dosen" name="nomer_induk_dosen" placeholder="Masukkan NIDN/NIDK" required>
                    </div>
                    <div class="form-group">
                        <label for="mata_kuliah_dosen" class="pastel-label">Mata Kuliah:</label>
                        <input type="text" class="form-control pastel-input" id="mata_kuliah_dosen" name="mata_kuliah_dosen" placeholder="Masukkan Mata Kuliah" required>
                    </div>
                    <div class="form-group">
                        <label for="program_studi_dosen" class="pastel-label">Program Studi:</label>
                        <input type="text" class="form-control pastel-input" id="program_studi_dosen" name="program_studi_dosen" placeholder="Masukkan Program Studi" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon" class="pastel-label">No. Telepon:</label>
                        <input 
                            type="text" 
                            class="form-control pastel-input" 
                            id="no_telp_dosen" 
                            name="no_telp_dosen" 
                            placeholder="Masukkan No. Telepon" 
                            required 
                            value="+62 8" 
                            oninput="formatPhoneNumber(this)">
                    </div>
                    <div class="form-group">
                        <label for="email" class="pastel-label">Email Dosen:</label>
                        <input type="email" 
                            class="form-control pastel-input" 
                            id="email_dosen" 
                            name="email_dosen" 
                            placeholder="Masukkan Email" 
                            title="Email harus valid dan mengandung karakter @" 
                            pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$" 
                            required>
                        <small class="form-text text-muted">Format: user@example.com</small>
                    </div>
                    <div class="form-group">
                        <label for="foto_dosen" class="pastel-label">Foto Dosen</label>
                        <input type="file" class="form-control pastel-input" name="foto_dosen" id="foto_dosen" accept="image/*" required onchange="previewImage();">
                        <img id="fotoPreview" src="#" alt="Preview Foto Dosen" style="display:none; margin-top:10px; max-width:200px;"/>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn pastel-button-save rounded-pill">Submit</button>
                        <a href="<?= base_url('index.php/dosen'); ?>" class="btn pastel-button-cancel rounded-pill">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function formatPhoneNumber(input) {
        let phone = input.value;

        if (!phone.startsWith('+62 8')) {
            phone = '+62 8' + phone.replace(/^\+62 8*/, '');
        }

        if (phone.length > 16) {
            phone = phone.substring(0, 16);
        }

        input.value = phone;
    }

    function previewImage() {
        const file = document.getElementById('foto_dosen').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            const preview = document.getElementById('fotoPreview');
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            const preview = document.getElementById('fotoPreview');
            preview.src = "";
            preview.style.display = 'none';
        }
    }
</script>

<style>
    body {
        background-color: #f5e6fc;
        font-family: 'Poppins', sans-serif;
    }

    .pastel-card {
        border-radius: 25px;
        background-color: #ffffff;
        box-shadow: 8px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pastel-header {
        background-color: #b39ddb;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px;
    }

    .pastel-label {
        color: #9575cd;
        font-weight: bold;
    }

    .pastel-input {
        border-radius: 20px;
        padding: 12px;
        border: 1px solid #d1c4e9;
        background-color: #ede7f6;
    }

    .pastel-input:focus {
        border-color: #b39ddb;
        box-shadow: 0 0 8px rgba(179, 157, 219, 0.5);
    }

    .pastel-button-save {
        background-color: #b39ddb;
        color: white;
        padding: 10px 30px;
        border: none;
    }

    .pastel-button-save:hover {
        background-color: #9575cd;
    }

    .pastel-button-cancel {
        background-color: #d1c4e9;
        color: #512da8;
        padding: 10px 30px;
        border: none;
    }

    .pastel-button-cancel:hover {
        background-color: #b39ddb;
    }
</style>
