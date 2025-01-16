<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Mahasiswa</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header pastel-header">
                <h5 class="text-center" style="font-family: 'Poppins', sans-serif; font-size: 2em;">
                    Edit Data Mahasiswa
                </h5>
            </div>
            <div class="card-body">
                <a href="<?= base_url('index.php/mahasiswa'); ?>" class="btn pastel-button-cancel mb-3 rounded-pill">
                    <i class="bi bi-arrow-left"></i> Kembali ke Data Mahasiswa
                </a>
                <form action="<?php echo base_url('index.php/mahasiswa/update'); ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="<?php echo $mahasiswa->id; ?>">

                    <div class="mb-3">
                        <label for="nama" class="form-label pastel-label">Nama Mahasiswa</label>
                        <input 
                            type="text" 
                            class="form-control rounded-pill pastel-input" 
                            id="nama" 
                            name="nama" 
                            value="<?php echo $mahasiswa->nama; ?>" 
                            placeholder="Masukkan Nama" 
                            required>
                        <div class="invalid-feedback">Nama mahasiswa harus diisi.</div>
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label pastel-label">NIM</label>
                        <input 
                            type="text" 
                            class="form-control rounded-pill pastel-input" 
                            id="nim" 
                            name="nim" 
                            value="<?php echo $mahasiswa->nim; ?>" 
                            placeholder="Masukkan NIM" 
                            required>
                        <div class="invalid-feedback">NIM harus diisi.</div>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label pastel-label">Tanggal Lahir</label>
                        <input 
                            type="date" 
                            class="form-control rounded-pill pastel-input" 
                            id="tgl_lahir" 
                            name="tgl_lahir" 
                            value="<?php echo $mahasiswa->tgl_lahir; ?>" 
                            max="<?php echo date('Y-m-d'); ?>" <!-- Set max date to today -->
                            
                        <small class="form-text text-muted">Format: mm/dd/yyyy</small>
                        <div class="invalid-feedback">Tanggal lahir harus diisi dan tidak boleh lebih dari tanggal hari ini.</div>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan" class="form-label pastel-label">Jurusan</label>
                        <input 
                            type="text" 
                            class="form-control rounded-pill pastel-input" 
                            id="jurusan" 
                            name="jurusan" 
                            value="<?php echo $mahasiswa->jurusan; ?>" 
                            placeholder="Masukkan Jurusan" 
                            required>
                        <div class="invalid-feedback">Jurusan harus diisi.</div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label pastel-label">Alamat</label>
                        <input 
                            type="text" 
                            class="form-control rounded-pill pastel-input" 
                            id="alamat" 
                            name="alamat" 
                            value="<?php echo $mahasiswa->alamat; ?>" 
                            placeholder="Masukkan Alamat" 
                            required>
                        <div class="invalid-feedback">Alamat harus diisi.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label pastel-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control rounded-pill pastel-input" 
                            id="email" 
                            name="email" 
                            value="<?php echo $mahasiswa->email; ?>" 
                            placeholder="Masukkan Email" 
                            required>
                        <div class="invalid-feedback">Email harus diisi dan valid (contoh: user@gmail.com).</div>
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

                    <div class="mb-3">
                        <label for="foto" class="form-label pastel-label">Foto (Opsional)</label>
                        <input 
                            type="file" 
                            class="form-control rounded-pill pastel-input" 
                            name="foto" 
                            id="foto" 
                            onchange="previewImage(event)">
                        <input type="hidden" name="foto_lama" value="<?php echo $mahasiswa->foto; ?>">

                        <?php if (!empty($mahasiswa->foto)) : ?>
                            <small class="form-text text-muted">Foto saat ini: <?php echo $mahasiswa->foto; ?></small>
                            <img src="<?php echo base_url('uploads/' . $mahasiswa->foto); ?>" alt="Foto Mahasiswa" id="currentImage" width="100" class="mt-2" onclick="enableZoom('currentImage')">
                        <?php endif; ?>
                        <img id="newImage" src="#" alt="Preview Image" width="100" class="mt-2" style="display: none;" onclick="enableZoom('newImage')">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn pastel-button-save rounded-pill"><i class="fas fa-edit"></i> Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

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

function enableZoom(imageId) {
    const img = document.getElementById(imageId);
    const modal = document.createElement('div');

    modal.id = 'zoomModal';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.style.zIndex = '1050';
    modal.style.cursor = 'zoom-out';

    const modalImg = document.createElement('img');
    modalImg.src = img.src;
    modalImg.style.maxWidth = '90%';
    modalImg.style.maxHeight = '90%';
    modalImg.style.borderRadius = '15px';
    modal.appendChild(modalImg);

    modal.addEventListener('click', () => {
        document.body.removeChild(modal);
    });

    document.body.appendChild(modal);
}

function previewImage(event) {
    const newImage = document.getElementById('newImage');
    const currentImage = document.getElementById('currentImage');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            newImage.src = e.target.result;
            newImage.style.display = 'block';
            newImage.setAttribute('onclick', "enableZoom('newImage')");
            if (currentImage) currentImage.style.display = 'none';
        };
        reader.readAsDataURL(file);
    } else {
        newImage.style.display = 'none';
        if (currentImage) {
            currentImage.style.display = 'block';
            currentImage.setAttribute('onclick', "enableZoom('currentImage')");
        }
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

    const tglLahirInput = document.getElementById('tgl_lahir');
    const tglLahirValue = tglLahirInput.value;
    const today = new Date().toISOString().split('T')[0]; // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD

    // Validasi jika tanggal lahir lebih besar dari hari ini
    if (tglLahirValue > today) {
        e.preventDefault(); // Mencegah form terkirim
        tglLahirInput.classList.add('is-invalid');
        tglLahirInput.nextElementSibling.textContent = 'Tanggal lahir tidak boleh lebih dari tanggal hari ini.';
    } else {
        tglLahirInput.classList.remove('is-invalid');
    }
});

</script>

<style>
    
    /* Optional: Hover effect for image preview */
    #newImage, #currentImage {
        cursor: zoom-in;
        transition: transform 0.3s ease;
    }

    #newImage:hover, #currentImage:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    
    /* Card Styling */
    .pastel-card {
        background-color: #f4e8fc; /* Soft purple pastel background */
        border: none;
        border-radius: 15px;
    }

    .pastel-header {
        background-color: #e7ccf7; /* Light purple pastel */
        border-radius: 15px 15px 0 0;
        color: #3a3a3a;
    }

    /* Form Input Styling */
    .pastel-input {
        background-color: #fbf7fe; /* Very light purple */
        border: 1px solid #d8b3f0; /* Subtle purple border */
        color: #495057;
    }

    .pastel-input:focus {
        border-color: #da86f5; /* Bright purple pastel highlight */
        box-shadow: 0 0 0 0.2rem rgba(218, 134, 245, 0.5);
    }

    .pastel-label {
        font-family: 'Poppins', sans-serif;
        color: #495057;
        font-weight: bold;
    }

    /* Button Styling */
    .pastel-button-cancel {
        background-color: #e7ccf7; /* Light purple pastel */
        color: #3a3a3a;
        border: none;
    }

    .pastel-button-cancel:hover {
        background-color: #d399f5; /* Slightly darker purple pastel */
        color: #3a3a3a;
    }

    .pastel-button-save {
        background-color: #d399f5; /* Bright purple pastel */
        color: #ffffff;
        border: none;
    }

    .pastel-button-save:hover {
        background-color: #c166f2; /* Slightly darker bright purple */
        color: #ffffff;
    }

    /* General Styling */
    body {
        background-color: #f2e0fc; /* Soft purple for background */
        font-family: 'Poppins', sans-serif;
    }

    h5 {
        font-weight: bold;
        color: #3a3a3a;
    }

    .text-center {
        color: #3a3a3a;
    }
</style>
