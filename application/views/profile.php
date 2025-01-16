<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Box Container -->
            <div class="card shadow-lg p-4 rounded" style="background-color: #F3E5F5;">
                <!-- Profile Picture -->
                <div class="text-center mb-4">
                    <div class="profile-picture-container mb-3 position-relative">
                        <!-- Preview Image -->
                        <img id="previewImage" 
                             src="<?= $user->profile_picture_url ?: base_url('assets/img/default-profile.jpg') ?>" 
                             alt="Profile Picture Preview" 
                             class="rounded-circle shadow zoomable" 
                             width="150" 
                             height="150" 
                             style="cursor: pointer;">
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="profile-info">
                    <h4 class="text-center mb-4" style="color: #8E24AA;">Profile Information</h4>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="color: #8E24AA;"><strong>Username:</strong></div>
                        <div class="col-sm-8"><?= $user->username ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="color: #8E24AA;"><strong>Email:</strong></div>
                        <div class="col-sm-8"><?= $user->email ?: 'Not provided' ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4" style="color: #8E24AA;"><strong>Joined:</strong></div>
                        <div class="col-sm-8"><?= $user->created_at ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup Modal for Zoom -->
<div id="photoModal" class="modal d-none" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="background-color: #F8F9FA; border-radius: 10px;">
            <!-- Zoomed Image -->
            <img id="zoomedImage" 
                 src="<?= $user->profile_picture_url ?: base_url('assets/img/default-profile.jpg') ?>" 
                 alt="Zoomed Profile Picture" 
                 class="rounded-circle shadow mb-4" 
                 width="250" 
                 height="250">

            <!-- Form for File Input and Buttons -->
            <form action="<?= site_url('dashboard/update_profile_picture') ?>" method="post" enctype="multipart/form-data" id="profileForm">
                <input type="file" name="profile_picture" id="profile_picture" class="form-control d-none" accept="image/*">

                <!-- Buttons Container -->
                <div class="d-flex justify-content-center gap-3">
                    <label for="profile_picture" class="btn" style="background-color: #9C4DFF; color: white;">Choose Photo</label>
                    <button type="submit" class="btn" style="background-color: #8E24AA; color: white;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    /* Profile Picture Container */
    .profile-picture-container {
        border: 5px solid #9C4DFF;
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
