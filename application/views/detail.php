<style>
    /* Wrapper untuk membungkus konten agar rapi */
    .content {
        padding: 30px;
        background-color: #f4e8fc; /* Soft pastel blue */
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        width: 95%; /* Make the content width responsive */
        max-width: 750px; /* Reduced width for better compactness */
        font-family: 'Arial', sans-serif;
        position: relative; /* To position the back button */
        box-sizing: border-box; /* Include padding in width calculations */
    }

    /* Styling untuk modal */
    .modal {
        display: none; /* Default hidden */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7); /* Black background with transparency */
    }

    .modal-content {
        margin: 15% auto;
        display: block;
        width: 80%;
        max-width: 600px;
        border-radius: 12px; /* Round the corners of the modal image */
    }

    .close {
        position: absolute;
        top: 10px;
        right: 25px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Styling untuk tombol kembali */
    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        padding: 10px 20px;
        background-color: #d399f5; /* Baby blue */
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 14px; /* Smaller button text */
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #4FC3F7; /* Slightly darker blue on hover */
    }

    /* Wrapper untuk konten */
    .content h4 {
        font-size: 24px;
        color: #0277BD; /* Dark blue for headers */
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
        padding-top: 50px; /* Adjusted padding */
    }

    /* Profile image styling */
    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        border: 3px solid #d399f5; /* Blue border around the photo */
        margin-bottom: 20px; /* Space below the photo */
        display: block;
        margin-left: auto;
        margin-right: auto; /* Center the photo */
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #d399f5; /* Light blue */
        color: white;
        font-weight: bold;
        text-align: left;
        font-size: 14px; /* Smaller font size for better readability */
        width: 200px;
    }

    .table td {
        font-size: 13px;
        color: #555;
    }

    .table tr:hover {
        background-color: #d399f5; /* Slightly darker blue for hover effect */
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .content {
            padding: 20px;
        }

        .table th, .table td {
            padding: 12px;
        }

        .content h4 {
            font-size: 20px;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
        }

        .table th {
            font-size: 12px;
        }

        .table td {
            font-size: 12px;
        }
    }

    /* Modal content style */
    .modal-content {
        border-radius: 12px;
        object-fit: cover;
    }
</style>

<div class="content">
    <!-- Display the back button at the top-left corner -->
    <a href="<?= base_url('index.php/mahasiswa'); ?>" class="back-button">
        <i class="bi bi-arrow-left"></i> Kembali ke Data Mahasiswa
    </a>

    <!-- Title centered above the photo -->
    <h4><strong>DETAIL DATA MAHASISWA</strong></h4>

    <!-- Display the student's photo centered below the title -->
    <img src="<?php echo base_url('uploads/' . $detail->foto); ?>" alt="Foto Mahasiswa" class="profile-photo" onclick="openModal('<?php echo base_url('uploads/' . $detail->foto); ?>')">

    <table class="table">
        <tr>
            <th>Nama Lengkap</th>
            <td><?php echo $detail->nama ?></td>
        </tr>
        <tr>
            <th>NIM</th>
            <td><?php echo $detail->nim ?></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td><?php echo $detail->tgl_lahir ?></td>
        </tr>
        <tr>
            <th>Jurusan</th>
            <td><?php echo $detail->jurusan ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?php echo $detail->alamat; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $detail->email; ?></td>
        </tr>
        <tr>
            <th>No. Telepon</th>
            <td><?php echo $detail->telepon; ?></td>
        </tr>
    </table>
</div>

<!-- Modal untuk menampilkan gambar -->
<div id="myModal" class="modal" onclick="closeModal(event)">
    <span class="close" onclick="closeModal(event)">&times;</span>
    <img class="modal-content" id="img01">
</div>

<script>
    // Fungsi untuk membuka modal dan menampilkan gambar
    function openModal(imgSrc) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = imgSrc;
    }

    // Fungsi untuk menutup modal
    function closeModal(event) {
        var modal = document.getElementById("myModal");
        // Cek jika klik terjadi di luar gambar modal, maka tutup modal
        if (event.target == modal || event.target.className == "close") {
            modal.style.display = "none";
        }
    }
</script>
