<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function index()
    {
        // Mendefinisikan data yang akan dikirim ke view
        $data = array();

        // Cek apakah user sudah login, misalnya jika menggunakan session
        $user = $this->session->userdata('user'); // Sesuaikan dengan variabel session yang digunakan

        // Jika user tidak ada, bisa menginisialisasi objek user kosong
        if (empty($user)) {
            $user = (object) [
                'profile_picture_url' => base_url('assets/img/default-profile.jpg'),
                'username' => 'Guest',
                'email' => 'Not provided',
                'created_at' => 'Jan. 1970'
            ];
        }

        // Kirim data user ke view
        $data['user'] = $user;

        // Load header dengan data yang telah didefinisikan
        $this->load->view('template/header', $data);

        // Load sidebar, contact, dan footer
        $this->load->view('template/sidebar');
        $this->load->view('contact'); // Pastikan nama view sesuai dengan yang digunakan
        $this->load->view('template/footer');
    }
    

}
