<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Box Container -->
             <!-- Profile Picture -->
            <div class="text-center mb-4">
                <div class="profile-picture-container mb-3 position-relative" style="width: 150px; height: 150px; overflow: hidden; border-radius: 0;">
                    <!-- Full Image -->
                    <img id="profilePicture" 
                        src="assets/img/gundar.png" 
                        alt="Profile Picture"
                        style="width: 100%; height: 100%; object-fit: contain; border-radius: 0;">
                </div>
            </div>

            <div class="card shadow-lg p-4 rounded" style="background-color: #F3E5F5;">
                <!-- Profile Info -->
                <div class="profile-info">
                    <h4 class="text-center mb-4" style="color: #8E24AA;">Hubungi Kami</h4>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="color: #8E24AA;"><strong>Telepon:</strong></div>
                        <div class="col-sm-8"><strong>+62 – 21 – 78881112</strong></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="color: #8E24AA;"><strong>Email:</strong></div>
                        <div class="col-sm-8"><strong>mediacenter@gunadarma.ac.id</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    /* Profile Picture Container */
    .profile-picture-container {
        border-radius: 50%;
        padding: 5px;
        display: inline-block;
        background-color: #fff;
    }

    /* Modal Styles */
    .modal {
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #F8F9FA;
        border: none;
        border-radius: 10px;
        padding: 20px;
    }

    .zoomable {
        cursor: pointer;
    }

    .btn {
        border-radius: 20px;
        padding: 10px 30px;
        font-size: 1em;
        border: none;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>

<!-- Add JavaScript -->
<script>
    const previewImage = document.getElementById('previewImage');
    const photoModal = document.getElementById('photoModal');
    const zoomedImage = document.getElementById('zoomedImage');
    const profilePictureInput = document.getElementById('profile_picture');

    // Open Modal
    previewImage.addEventListener('click', () => {
        photoModal.classList.remove('d-none');
        photoModal.style.display = 'flex';
        zoomedImage.src = previewImage.src;
    });

    // Close Modal on Outside Click
    photoModal.addEventListener('click', (event) => {
        if (event.target === photoModal) {
            photoModal.classList.add('d-none');
            photoModal.style.display = 'none';
        }
    });

    // Update Photo Preview on File Change
    profilePictureInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                zoomedImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
