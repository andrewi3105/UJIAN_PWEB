<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Data Mahasiswa</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header d-flex justify-content-center align-items-center pastel-header">
                <h3 class="text-center font-weight-bold">Tambah Data Mahasiswa</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('mahasiswa/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama" class="pastel-label">Nama Mahasiswa:</label>
                        <input type="text" class="form-control pastel-input" id="nama" name="nama" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nim" class="pastel-label">NIM:</label>
                        <input type="text" class="form-control pastel-input" id="nim" name="nim" placeholder="Masukkan NIM" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="pastel-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control pastel-input" id="tgl_lahir" name="tgl_lahir" required max="<?php echo date('Y-m-d'); ?>">
                        <small class="form-text text-muted">Format: mm/dd/yyyy. Tidak boleh memilih tanggal di masa depan.</small>
                    </div>
                    <div class="form-group">
                        <label for="jurusan" class="pastel-label">Jurusan:</label>
                        <input type="text" class="form-control pastel-input" id="jurusan" name="jurusan" placeholder="Masukkan Jurusan" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="pastel-label">Alamat:</label>
                        <input type="text" class="form-control pastel-input" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="pastel-label">Email:</label>
                        <input type="email" 
                            class="form-control pastel-input" 
                            id="email" 
                            name="email" 
                            placeholder="Masukkan Email" 
                            title="Email harus valid dan mengandung karakter @" 
                            required>
                    </div>
                    <div class="form-group">
                        <label for="telepon" class="pastel-label">No. Telepon:</label>
                        <input 
                            type="text" 
                            class="form-control pastel-input" 
                            id="telepon" 
                            name="telepon" 
                            placeholder="Masukkan No. Telepon" 
                            required 
                            value="+62 8" 
                            oninput="formatPhoneNumber(this)">
                    </div>
                    <div class="form-group">
                        <label for="foto" class="pastel-label">Foto</label>
                        <input type="file" class="form-control pastel-input" name="foto" id="foto" accept="image/*" required onchange="previewImage();">
                        <img id="fotoPreview" src="#" alt="Preview Foto" style="display:none; margin-top:10px; max-width:200px;"/>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn pastel-button-save rounded-pill">Submit</button>
                        <a href="<?= base_url('index.php/mahasiswa'); ?>" class="btn pastel-button-cancel rounded-pill">Batal</a>
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

        // Jika input dimulai dengan +62 dan angka 8, pastikan itu tetap ada
        if (!phone.startsWith('+62 8')) {
            phone = '+62 8' + phone.replace(/^\+62 8*/, ''); // memastikan nomor diawali dengan +62 8
        }

        // Batasi panjang nomor telepon maksimal 13 karakter (+62 8 + 11 digit)
        if (phone.length > 16) {
            phone = phone.substring(0, 16);
        }

        input.value = phone;  // Update value input
    }

    function previewImage() {
        const file = document.getElementById('foto').files[0];
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
    document.querySelector('form').addEventListener('submit', function (e) {
    const emailInput = document.getElementById('email');
    const emailValue = emailInput.value;
    // Regex yang diperbarui untuk menerima domain lain selain Gmail dan Yahoo
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailRegex.test(emailValue)) {
        e.preventDefault(); // Mencegah form terkirim
        emailInput.classList.add('is-invalid');
        emailInput.nextElementSibling.textContent = 'Email harus valid (contoh: user@gmail.com atau user@domainlain.com).';
    } else {
        emailInput.classList.remove('is-invalid');
    }
});
</script>

<style>
    body {
        background-color: #e3f2fd;
        font-family: 'Poppins', sans-serif;
    }

    .pastel-card {
        border-radius: 25px;
        background-color: #ffffff;
        box-shadow: 8px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pastel-header {
        background-color: #D5B3E8;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 20px;
        text-align: center;
    }

    .pastel-header h3 {
        font-size: 1.8rem;
        margin: 0;
    }

    .pastel-label {
        color: #4A148C;
        font-weight: bold;
    }

    .pastel-input {
        border-radius: 20px;
        padding: 12px;
        border: 1px solid #4A148C;
        background-color: #D5B3E8;
    }

    .pastel-input:focus {
        border-color: #64b5f6;
        box-shadow: 0 0 8px rgba(100, 181, 246, 0.5);
    }

    .pastel-button-save {
        background-color: #4A148C;
        color: white;
        padding: 10px 30px;
        border: none;
    }

    .pastel-button-save:hover {
        background-color: #42a5f5;
    }

    .pastel-button-cancel {
        background-color: #D5B3E8;
        color: #4A148C;
        padding: 10px 30px;
        border: none;
    }

    .pastel-button-cancel:hover {
        background-color: #81d4fa;
    }
</style>
