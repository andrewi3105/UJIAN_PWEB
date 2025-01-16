<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Dosen</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header d-flex justify-content-between align-items-center pastel-header">
                <h5 class="mb-0">Edit Data Dosen</h5>
            </div>
            <div class="card-body">
                <a href="<?= base_url('index.php/dosen'); ?>" class="btn pastel-button-cancel rounded-pill mb-3">
                    <i class="bi bi-arrow-left"></i> Kembali ke Data Dosen
                </a>
                <form action="<?= base_url('index.php/dosen/update'); ?>" method="post" enctype="multipart/form-data">
                    <!-- Menyertakan ID untuk update -->
                    <input type="hidden" name="id_dosen" value="<?= $dosen->id_dosen; ?>">

                    <div class="form-group">
                        <label for="nama_dosen" class="pastel-label">Nama Dosen:</label>
                        <input type="text" class="form-control pastel-input" id="nama_dosen" name="nama_dosen" value="<?= $dosen->nama_dosen; ?>" placeholder="Masukkan Nama Dosen" required>
                    </div>

                    <div class="form-group">
                        <label for="nomer_induk_dosen" class="pastel-label">Nomor Induk Dosen:</label>
                        <input type="text" class="form-control pastel-input" id="nomer_induk_dosen" name="nomer_induk_dosen" value="<?= $dosen->nomer_induk_dosen; ?>" placeholder="Masukkan Nomer Induk Dosen" required>
                    </div>

                    <div class="form-group">
                        <label for="mata_kuliah_dosen" class="pastel-label">Mata Kuliah Dosen:</label>
                        <input type="text" class="form-control pastel-input" id="mata_kuliah_dosen" name="mata_kuliah_dosen" value="<?= $dosen->mata_kuliah_dosen; ?>" placeholder="Masukkan Mata Kuliah" required>
                    </div>

                    <div class="form-group">
                        <label for="program_studi_dosen" class="pastel-label">Program Studi:</label>
                        <input type="text" class="form-control pastel-input" id="program_studi_dosen" name="program_studi_dosen" value="<?= $dosen->program_studi_dosen; ?>" placeholder="Masukkan Program Studi" required>
                    </div>

                    <div class="form-group">
                        <label for="no_telp_dosen" class="pastel-label">No. Telepon:</label>
                        <input type="text" class="form-control pastel-input" id="no_telp_dosen" name="no_telp_dosen" value="<?= $dosen->no_telp_dosen; ?>" placeholder="Masukkan No. Telepon" required oninput="formatPhoneNumber(this)">
                    </div>

                    <div class="form-group">
                        <label for="email_dosen" class="pastel-label">Email:</label>
                        <input type="email" class="form-control pastel-input" id="email_dosen" name="email_dosen" value="<?= $dosen->email_dosen; ?>" placeholder="Masukkan Email" required oninput="validateEmail(this)">
                    </div>

                    <div class="form-group">
                        <label for="foto_dosen" class="pastel-label">Foto (Opsional)</label>
                        <!-- Input untuk unggah foto baru -->
                        <input type="file" class="form-control pastel-input" name="foto_dosen" id="foto_dosen" onchange="previewImage(event)">
                        
                        <!-- Input tersembunyi untuk menyimpan nama file foto lama -->
                        <input type="hidden" name="foto_dosen_lama" value="<?= $dosen->foto_dosen; ?>">

                        <!-- Tampilkan foto lama jika ada -->
                        <?php if (!empty($dosen->foto_dosen)) : ?>
                            <small class="form-text text-muted">Foto saat ini: <?= $dosen->foto_dosen; ?></small>
                            <img src="<?= base_url('uploads/' . $dosen->foto_dosen); ?>" alt="Foto Dosen" id="currentImage" width="100" class="mt-2">
                        <?php endif; ?>

                        <!-- Image preview -->
                        <img id="newImage" src="#" alt="Preview Image" width="100" class="mt-2" style="display: none;">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn pastel-button-save rounded-pill">
                            <i class="fas fa-edit"></i> Update Data
                        </button>
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

    function validateEmail(input) {
        // Format email seperti "user@domain.com"
        const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!regex.test(input.value)) {
            input.setCustomValidity("Email tidak valid. Harus menggunakan format user@domain.com");
        } else {
            input.setCustomValidity("");  // Reset error message if valid
        }
    }

    function previewImage(event) {
        const newImage = document.getElementById('newImage');
        const currentImage = document.getElementById('currentImage');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                newImage.src = e.target.result;
                newImage.style.display = 'block';
                currentImage.style.display = 'none'; // Hide the current image
            };
            reader.readAsDataURL(file);
        } else {
            newImage.style.display = 'none'; // Hide the new image preview if no file is selected
            currentImage.style.display = 'block'; // Show the current image if no new image
        }
    }
</script>

<style>
    body {
        background-color: #f3e5f5; /* Soft purple background */
        font-family: 'Poppins', sans-serif;
    }

    .pastel-card {
        border-radius: 25px;
        background-color: #ffffff;
        box-shadow: 8px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .pastel-header {
        background-color: #ba68c8; /* Medium purple */
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 15px;
    }

    .pastel-label {
        color: #ab47bc; /* Bright purple */
        font-weight: bold;
    }

    .pastel-input {
        border-radius: 20px;
        padding: 12px;
        border: 1px solid #ce93d8; /* Light purple border */
        background-color: #f8eaf6; /* Very light purple background */
    }

    .pastel-input:focus {
        border-color: #ba68c8; /* Medium purple highlight */
        box-shadow: 0 0 8px rgba(186, 104, 200, 0.5);
    }

    .pastel-button-save {
        background-color: #ba68c8; /* Medium purple */
        color: white;
        padding: 10px 30px;
        border: none;
        border-radius: 20px;
    }

    .pastel-button-save:hover {
        background-color: #ab47bc; /* Bright purple */
    }

    .pastel-button-cancel {
        background-color: #e1bee7; /* Light purple */
        color: #4a148c; /* Dark purple text */
        padding: 10px 30px;
        border: none;
        border-radius: 20px;
    }

    .pastel-button-cancel:hover {
        background-color: #d1c4e9; /* Slightly darker light purple */
    }
</style>

