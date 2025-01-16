<section class="content">
    <div class="container mt-5">
        <div class="card shadow-lg pastel-card">
            <div class="card-header pastel-header d-flex align-items-center">
                <i class="fas fa-book-open me-3" style="font-size: 1.5em;"></i>
                <h5 class="text-center m-0" style="font-family: 'Poppins', sans-serif; font-size: 2em;">
                    Detail Mata Kuliah
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label pastel-label">Kode Mata Kuliah</label>
                    <p class="form-control-static pastel-display" id="kode_mk"><?= $mata_kuliah->kode_mk ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Nama Mata Kuliah</label>
                    <p class="form-control-static pastel-display" id="mata_kuliah"><?= $mata_kuliah->mata_kuliah ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Nama Mata Kuliah Sebelumnya</label>
                    <p class="form-control-static pastel-display" id="nama_mk_sebelumnya"><?= $mata_kuliah->nama_mk_sebelumnya ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Prasyarat Mata Kuliah</label>
                    <p class="form-control-static pastel-display" id="prasyarat_mk"><?= $mata_kuliah->prasyarat_mk ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Semester</label>
                    <p class="form-control-static pastel-display" id="semester">
                        <?php
                        if (isset($mata_kuliah->semester) && $mata_kuliah->semester != "") {
                            echo $mata_kuliah->semester;
                        } else {
                            echo 'Tidak Diketahui';  // Jika semester tidak ada
                        }
                        ?>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="form-label pastel-label">Jumlah SKS</label>
                    <p class="form-control-static pastel-display" id="jumlah_sks"><?= $mata_kuliah->jumlah_sks ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Konsentrasi</label>
                    <p class="form-control-static pastel-display" id="konsentrasi"><?= $mata_kuliah->konsentrasi ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Nilai Minimal Kelulusan</label>
                    <p class="form-control-static pastel-display" id="nilai_minimal_kelulusan"><?= $mata_kuliah->nilai_minimal_kelulusan ?></p>
                </div>
                <div class="mb-3">
                    <label class="form-label pastel-label">Deskripsi Mata Kuliah</label>
                    <p class="form-control-static pastel-display" id="deskripsi_mk"><?= $mata_kuliah->deskripsi_mk ?></p>
                </div>
                <div class="text-center">
                    <a href="<?= base_url('mata_kuliah/edit/' . $mata_kuliah->id_mata_kuliah) ?>" class="btn pastel-button-edit rounded-pill">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="<?= base_url('mata_kuliah') ?>" class="btn pastel-button-back rounded-pill">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
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
        max-width: 1200px; /* Adjusted for smaller size */
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

    .pastel-display {
        background-color: #F1E6FA; /* Lavender pastel background for display */
        border: 1px solid #D5B3E8; /* Pastel purple border */
        border-radius: 50px;
        padding: 8px 12px; /* Reduced padding */
        font-size: 1em; /* Reduced font size */
        color: #6B4E8A; /* Darker purple for text */
        box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%; /* Ensure full-width for better alignment */
    }

    .pastel-display:hover {
        background-color: #F8F4FF; /* Lighter lavender on hover */
        border-color: #CBA6E6; /* Highlighted purple */
        box-shadow: 0 0 10px rgba(203, 166, 230, 0.4);
    }

    .pastel-button-edit {
        background-color: #CBA6E6; /* Light pastel purple for edit button */
        color: white;
        border: none;
        padding: 10px 30px;
        margin-right: 10px;
    }

    .pastel-button-edit:hover {
        background-color: #A785C5; /* Slightly darker pastel purple */
        box-shadow: 0 4px 8px rgba(167, 133, 197, 0.3);
    }

    .pastel-button-back {
        background-color: #E6D5F5; /* Lavender pastel for back button */
        color: #6B4E8A; /* Darker purple for text */
        border: none;
        padding: 10px 30px;
    }

    .pastel-button-back:hover {
        background-color: #D8BFE8; /* Slightly darker lavender */
        box-shadow: 0 4px 8px rgba(216, 191, 232, 0.3);
    }

    .container {
        max-width: 900px; /* Container width adjusted */
    }
</style>

