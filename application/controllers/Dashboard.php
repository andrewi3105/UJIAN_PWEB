<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Pengecekan login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login'); // Redirect ke halaman login
        }

        // Load model
        $this->load->model('M_mhs');
        $this->load->model('M_dosen');
        $this->load->model('M_mata_kuliah');
        $this->load->model('M_jadwal');
        $this->load->model('M_users'); // Model untuk pengguna
    }

    public function dashboard_with_mata_kuliah() {
        // Ambil data grafik dari model
        $data['mataKuliahData'] = $this->M_mata_kuliah->get_grafik_mata_kuliah();
    
        // Kirim data ke view
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
    
    

    public function index() {
        // Ambil data pengguna
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);
    
        // Data untuk dashboard
        $data['jumlahMahasiswa'] = $this->M_mhs->get_jumlah_mahasiswa();
        $data['jumlahDosen'] = $this->M_dosen->get_jumlah_dosen();
        $data['jumlahMatakuliah'] = $this->M_mata_kuliah->get_jumlah_matakuliah();
        $data['jumlahJadwal'] = $this->M_jadwal->get_jumlah_jadwal();

        $data['dosenData'] = $this->M_dosen->get_dosen_data();
        $data['mahasiswaData'] = $this->M_mhs->Jum_mahasiswa_perjurusan();
        $data['mataKuliahData'] = $this->M_mata_kuliah->get_mata_kuliah();
        $data['jadwalData'] = $this->M_jadwal->get_jadwal_per_hari();

    
        // Load tampilan dan pass data pengguna
        $this->load->view('template/header', $data); // Pass data pengguna ke header
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
    
    public function profile() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id); // Ambil data pengguna
    
        // Load tampilan dengan data pengguna
        $this->load->view('template/header', $data); // Pass $data di sini
        $this->load->view('template/sidebar');
        $this->load->view('profile', $data); // Pass $data di sini juga
        $this->load->view('template/footer');
    }

    public function dashboard_main() {
        // Ambil data pengguna
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);
    
        // Data dashboard
        $data['jumlahMahasiswa'] = $this->M_mhs->get_jumlah_mahasiswa();
        $data['jumlahDosen'] = $this->M_dosen->get_jumlah_dosen();
        $data['jumlahMatakuliah'] = $this->M_mata_kuliah->get_jumlah_matakuliah();
        $data['jumlahJadwal'] = $this->M_jadwal->get_jumlah_jadwal();
    
        $data['jadwalTerdekat'] = $this->M_jadwal->get_jadwal_terdekat(); // Tambahkan ini
    
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
    
    
    public function update_profile_picture() {
        // Mengatur konfigurasi upload file
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Maksimal ukuran file 2MB
    
        $this->load->library('upload', $config);
    
        if ($this->upload->do_upload('profile_picture')) {
            // Ambil data file yang di-upload
            $upload_data = $this->upload->data();
            $image_url = base_url('assets/img/') . $upload_data['file_name'];
            
            // Update URL gambar di database
            $user_id = $this->session->userdata('user_id');
            $this->M_users->update_profile_picture($user_id, $image_url);
    
            // Redirect kembali ke halaman profil setelah berhasil
            redirect('dashboard/profile');
        } else {
            // Jika upload gagal, tampilkan error
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('dashboard/profile');
        }
    }
}
?>
