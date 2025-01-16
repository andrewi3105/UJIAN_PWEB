<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_mhs'); // Model untuk data mahasiswa
        $this->load->model('M_dosen'); // Model untuk data dosen
        $this->load->model('M_jadwal'); // Model untuk data jadwal
        $this->load->model('M_mata_kuliah'); // Model untuk data mata kuliah
    }

    public function index() {
        // Ambil data yang diperlukan untuk sidebar dan halaman dashboard
        $data['mahasiswa'] = $this->M_mhs->get_data();
        $data['dosen'] = $this->M_dosen->get_data(); // Pastikan model dan fungsi ini tersedia
        $data['jadwal'] = $this->M_jadwal->get_data(); // Pastikan model dan fungsi ini tersedia
        $data['mata_kuliah'] = $this->M_mata_kuliah->get_data(); // Pastikan model dan fungsi ini tersedia

        // Muat halaman template dengan data
        $this->load->view('template/header'); // Header
        $this->load->view('template/sidebar', $data); // Sidebar
        $this->load->view('dashboard', $data); // Dashboard (konten utama)
        $this->load->view('template/footer'); // Footer
    }
}
