    <main class="app-main">
        <!-- Header -->
        <div class="app-content-header" style="display: flex; justify-content: center; padding-top: 20px;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-0" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 30px;">
                        Selamat Datang di Dashboard!
                    </h3>
                </div>
            </div>
        </div>
    </div>



        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                <!-- Statistik Cards -->
                <div class="row mb-4">
                    <!-- Card Total Mahasiswa -->
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo site_url('mahasiswa'); ?>">
                            <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                                <div class="card-body">
                                    <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Total Mahasiswa</h4>
                                    <h2 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 32px;"><?php echo $jumlahMahasiswa; ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Total Dosen -->
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo site_url('dosen'); ?>">
                            <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                                <div class="card-body">
                                    <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Total Dosen</h4>
                                    <h2 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 32px;"><?php echo $jumlahDosen; ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Total Mata Kuliah -->
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo site_url('mata_kuliah'); ?>">
                            <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                                <div class="card-body">
                                    <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Total Mata Kuliah</h4>
                                    <h2 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 32px;"><?php echo $jumlahMatakuliah; ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Total Jadwal -->
                    <div class="col-lg-3 col-md-6">
                        <a href="<?php echo site_url('jadwal'); ?>">
                            <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                                <div class="card-body">
                                    <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Total Jadwal</h4>
                                    <h2 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 32px;"><?php echo $jumlahJadwal; ?></h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Row untuk Grafik -->
                <div class="row">

                <!-- Grafik Mahasiswa -->
                <div class="col-lg-3 col-md-6 mb-4">
                                    <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                                        <div class="card-body">
                                            <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Grafik Data Mahasiswa</h4>
                                            <canvas id="mahasiswaChart" width="400" height="200"></canvas>
                                            <?php
                                            $nama_jurusan = '';
                                            $jumlah_mahasiswa = '';
                                            foreach ($mahasiswaData as $item) {
                                                $nama_jurusan .= "'$item->jurusan', ";
                                                $jumlah_mahasiswa .= "$item->total, ";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                    <!-- Grafik Dosen -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                            <div class="card-body">
                                <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Grafik Data Dosen</h4>
                                <canvas id="dosenChart" width="400" height="200"></canvas>
                                <?php
                                $nama_prodi = '';
                                $jumlah_dosen = '';
                                foreach ($dosenData as $item) {
                                    $nama_prodi .= "'$item->program_studi_dosen', ";
                                    $jumlah_dosen .= "$item->total, ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Mata Kuliah -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                            <div class="card-body">
                                <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Grafik Data Mata Kuliah</h4>
                                <canvas id="mataKuliahChart" width="400" height="200"></canvas>
                                <?php
                                $mata_kuliah_labels = '';
                                $jumlah_sks_data = '';
                                foreach ($mataKuliahData as $item) {
                                    $mata_kuliah_labels .= "'$item->mata_kuliah', ";
                                    $jumlah_sks_data .= "$item->jumlah_sks, ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik Jadwal -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card shadow-sm text-center" style="background-color: #EDE7F6; border-radius: 20px; border: 1px solid #4A148C;">
                            <div class="card-body">
                                <h4 class="mb-3" style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 22px;">Grafik Data Jadwal</h4>
                                <canvas id="jadwalChart" width="400" height="200"></canvas>
                                <?php
                                $hari_jadwal = '';
                                $jumlah_matkul = '';
                                foreach ($jadwalData as $item) {
                                    $hari_jadwal .= "'$item->hari_jadwal', ";
                                    $jumlah_matkul .= "$item->total, ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <!-- Lokasi Kampus Section -->
    <div class="row">
        <div class="col-12">
        <h4 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 700; text-align: center;">Region</h4>   

            <div class="row">
                <!-- Depok -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="background-color: #EDE7F6; border-radius: 15px; border: 1px solid #4A148C;">
                        <div class="card-body text-center">
                            <h5 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px;">Depok</h5>
                            <img src="assets/img/kampusdepok.jpg" alt="Depok" class="img-fluid mb-3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                            <p style="font-size: 14px; font-family: 'Poppins', sans-serif;">
                            Jl. Margonda Raya Pondok Cina, Depok
                            </p>
                            <a href="https://maps.app.goo.gl/GkQ2qrsXbfwLtQyG7" target="_blank" class="btn btn-info btn-sm mt-3" style="border-radius: 12px; font-family: 'Poppins', sans-serif; font-weight: 600;">Petunjuk Arah</a>
                        </div>
                    </div>
                </div>

                <!-- Kampus Kalimalang -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="background-color: #EDE7F6; border-radius: 15px; border: 1px solid #4A148C;">
                        <div class="card-body text-center">
                            <h5 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px;">Kalimalang</h5>
                            <img src="assets/img/kampuskalimalang.jpg" alt="Kalimalang" class="img-fluid mb-3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                            <p style="font-size: 14px; font-family: 'Poppins', sans-serif;">
                            Jl. KH. Noer Ali, Kalimalang Bekasi
                            </p>
                            <a href="https://maps.app.goo.gl/SQjQVAxCMybKePtB7" target="_blank" class="btn btn-info btn-sm mt-3" style="border-radius: 12px; font-family: 'Poppins', sans-serif; font-weight: 600;">Petunjuk Arah</a>
                        </div>
                    </div>
                </div>

                <!-- Kampus Karawaci -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="background-color: #EDE7F6; border-radius: 15px; border: 1px solid #4A148C;">
                        <div class="card-body text-center">
                            <h5 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 24px;">Karawaci</h5>
                            <img src="assets/img/kampuskarawaci.jpg" alt="Karawaci" class="img-fluid mb-3" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                            <p style="font-size: 14px; font-family: 'Poppins', sans-serif;">
                            Jl. Kelapa Dua Raya No.93, Klp. Dua, Kec. Klp. Dua
                            </p>
                            <a href="https://maps.app.goo.gl/duga87PcVSBHGLuc8" target="_blank" class="btn btn-info btn-sm mt-3" style="border-radius: 12px; font-family: 'Poppins', sans-serif; font-weight: 600;">Petunjuk Arah</a>
                        </div>
                    </div>
                </div>

                    <!-- Kalender -->
        <div class="container-fluid mt-4">
            <h4 style="color: #4A148C; font-family: 'Poppins', sans-serif; font-weight: 700; text-align: center;">Kalender Kegiatan</h4>
            <div id="calendar" style="border: 1px solid #a1d8f7; border-radius: 10px; padding: 10px;">
                <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id&ctz=Asia/Jakarta" style="border: 0; width: 100%; height: 400px; frameborder: 0; scrolling: no;"></iframe>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                <!-- Statistik Cards -->
                <!-- (Isi konten lainnya tetap di sini) -->
            </div>
        </div>
    </main>
            </div>
        </div>
    </div>
            </div>
        </div>

        <main class="app-main">



        <!-- Tambahkan ini sebelum penutup tag body -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/main.min.css" rel="stylesheet" />

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id', // Untuk bahasa Indonesia
                events: [
                    // Data libur nasional
                    {
                        title: 'Tahun Baru',
                        start: '2025-01-01',
                        description: 'Hari Libur Nasional'
                    },
                    {
                        title: 'Hari Raya Nyepi',
                        start: '2025-03-29',
                        description: 'Hari Libur Nasional'
                    },
                    {
                        title: 'Hari Kemerdekaan',
                        start: '2025-08-17',
                        description: 'Hari Libur Nasional'
                    },
                    // Data kegiatan kampus
                    {
                        title: 'Pembukaan Semester Genap',
                        start: '2025-02-01',
                        description: 'Acara Akademik'
                    },
                    {
                        title: 'Ujian Tengah Semester',
                        start: '2025-04-10',
                        end: '2025-04-20',
                        description: 'Acara Akademik'
                    },
                    {
                        title: 'Wisuda',
                        start: '2025-06-15',
                        description: 'Acara Kampus'
                    }
                ],
                eventClick: function (info) {
                    alert(info.event.title + '\n' + info.event.extendedProps.description);
                }
            });

            calendar.render();
        });
    </script>

    <script>
        // Grafik Dosen
        var ctxDosen = document.getElementById('dosenChart').getContext('2d');
        var dosenChart = new Chart(ctxDosen, {
            type: 'bar',
            data: {
                labels: [<?php echo $nama_prodi; ?>],
                datasets: [{
                    label: 'Jumlah Dosen',
                    data: [<?php echo $jumlah_dosen; ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        // Grafik Mahasiswa Per Jurusan
        var ctx = document.getElementById('mahasiswaChart').getContext('2d');
        var mahasiswaPerJurusanChart = new Chart(ctx, {
        type: 'bar',
            data: {
                labels: [<?php echo $nama_jurusan; ?>],
                datasets: [{
                    label: 'Jumlah Mahasiswa',
                    data: [<?php echo $jumlah_mahasiswa; ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var ctxMataKuliah = document.getElementById('mataKuliahChart').getContext('2d');
        var mataKuliahChart = new Chart(ctxMataKuliah, {
            type: 'bar',
            data: {
                labels: [<?php echo $mata_kuliah_labels; ?>],
                datasets: [{
                    label: 'Jumlah SKS',
                    data: [<?php echo $jumlah_sks_data; ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        // Grafik Jadwal
        var ctx = document.getElementById('jadwalChart').getContext('2d');
        var jadwalChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $hari_jadwal; ?>],
                datasets: [{
                    label: 'Jumlah Mata Kuliah',
                    data: [<?php echo $jumlah_matkul; ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data jadwal terdekat dari PHP
        const jadwalTerdekat = <?php echo json_encode($jadwalTerdekat); ?>;
        console.log('Jadwal Terdekat:', jadwalTerdekat);

        if (jadwalTerdekat && jadwalTerdekat.length > 0) {
            const kelas = jadwalTerdekat[0];
            const pesan = `Kelas ${kelas.mata_kuliah} akan dimulai pada ${kelas.jam_mulai} di ${kelas.ruangan}.`;
            console.log('Pesan:', pesan);

            // Tampilkan notifikasi pop-up
            alert(pesan);
        } else {
            console.log('Tidak ada kelas yang akan dimulai dalam 15 menit.');
        }
    });
    </main>