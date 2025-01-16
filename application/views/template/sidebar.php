<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="<?= base_url('dashboard') ?>" class="brand-link">
            <!--begin::Brand Image-->
            <img src="<?= base_url('assets/img/gundar.png') ?>" alt="Logo Kampus" class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text">UG Web</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Menu-->
    <div class="sidebar-wrapper">
        <ul class="nav sidebar-menu">
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('mahasiswa') ?>" class="nav-link">
                    <i class="bi bi-person-fill"></i> Mahasiswa
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('dosen') ?>" class="nav-link">
                    <i class="bi bi-person-video3"></i> Dosen
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('mata_kuliah') ?>" class="nav-link">
                    <i class="bi bi-person-video2"></i> Mata Kuliah
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('jadwal') ?>" class="nav-link">
                    <i class="bi bi-calendar-check"></i> Jadwal
                </a>
            </li>
            <!-- Add Profile Menu Item in Sidebar -->
            <li class="nav-item">
                <a href="<?= base_url('dashboard/profile') ?>" class="nav-link">
                    <i class="bi bi-person-circle"></i> Profile
                </a>
            </li>
                        <ul class="sidebar-menu">
            <!-- Menu lainnya -->
            <li>
                <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-danger" 
                style="color: white; font-family: 'Poppins', sans-serif; font-weight: 600;">
                    Logout
                </a>
            </li>
        </ul>

        </ul>
    </div>
    <!--end::Sidebar Menu-->
</aside>
<!--end::Sidebar-->

<!-- Add the custom CSS below -->
<style>
    /* Sidebar background */
    .app-sidebar {
        background-color: #F3E5F5 !important; /* Ungu muda */
    }

    .sidebar-brand .brand-link {
        background-color: #EDE7F6; /* Ungu lebih terang */
        border-radius: 20px;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
    }

    .sidebar-brand .brand-link:hover {
        background-color: #D1C4E9; /* Ungu hover */
        transform: scale(1.05);
    }

    .sidebar-brand .brand-text {
        color: #6A1B9A; /* Ungu gelap */
        font-family: 'Caveat', cursive;
        font-size: 32px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-left: 15px;
        transition: color 0.3s;
    }

    .sidebar-brand .brand-link:hover .brand-text {
        color: #4A148C; /* Ungu lebih gelap */
    }

    .sidebar-brand .brand-image {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .sidebar-menu {
        padding: 15px;
        list-style: none;
    }

    .sidebar-menu .nav-item {
        margin: 12px 0;
    }

    .sidebar-menu .nav-link {
        color: #6A1B9A !important; /* Ungu gelap */
        transition: background-color 0.3s, color 0.3s;
        border-radius: 8px;
        padding: 12px 15px;
        margin: 5px 0;
        display: flex;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 500;
    }

    .sidebar-menu .nav-link i {
        margin-right: 10px;
        font-size: 20px;
    }

    .sidebar-menu .nav-link:hover {
        background-color: #CE93D8 !important; /* Ungu hover */
        color: #4A148C !important;
    }

    .sidebar-menu .nav-item.active .nav-link {
        background-color: #BA68C8 !important; /* Ungu lebih terang */
        color: white !important;
        font-weight: bold;
    }
</style>

<!-- Add Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

<!-- Include Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
