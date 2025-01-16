<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dosen extends CI_Model {

    // Fungsi untuk mendapatkan semua data dosen

    public function get_all_dosen() {
        return $this->db->get('tb_dosen')->result();  // Fetch all dosen data
    }
    
    public function get_data() {
        return $this->db->get('tb_dosen')->result();
    }

    public function get_jumlah_dosen() {
        $this->db->from('tb_dosen'); // Pilih tabel 'tb_dosen'
        return $this->db->count_all_results(); // Kembalikan jumlah baris pada tabel
    }

    // Fungsi untuk mendapatkan data dosen berdasarkan ID
    public function get_data_by_id($id) {
        return $this->db->get_where('tb_dosen', array('id_dosen' => $id))->row();
    }

    // Fungsi untuk menambahkan data dosen baru
    public function insert_data($data) {
        return $this->db->insert('tb_dosen', $data);
    }

    // Fungsi untuk memperbarui data dosen berdasarkan ID
    public function update_data($id, $data) {
        // Tambahkan kolom update_at secara otomatis
        $data['update_at'] = date('Y-m-d H:i:s'); // Atur waktu saat update
        
        // Menentukan kondisi untuk update berdasarkan id_dosen
        $this->db->where('id_dosen', $id);
        
        // Update data dosen
        return $this->db->update('tb_dosen', $data);
    }

    // Fungsi untuk menghapus data dosen berdasarkan ID
    public function delete_data($id) {
        $this->db->where('id_dosen', $id);
        return $this->db->delete('tb_dosen');
    }

    // Fungsi untuk mendapatkan detail data dosen berdasarkan ID
    public function detail_data($id) {
        $this->db->where('id_dosen', $id);
        return $this->db->get('tb_dosen')->row();
    }

    // Fungsi untuk mencari data dosen berdasarkan keyword
    public function search_data($keyword) {
        $this->db->like('nama_dosen', $keyword);
        $this->db->or_like('nomer_induk_dosen', $keyword);
        $this->db->or_like('mata_kuliah_dosen', $keyword);
        return $this->db->get('tb_dosen')->result();
    }

    // Fungsi untuk mendapatkan jumlah dosen per program studi
    public function jumlah_dosen_per_prodi() {
        $this->db->group_by('program_studi_dosen');
        $this->db->select('program_studi_dosen');
        $this->db->select('COUNT(*) as total');
        $this->db->from('tb_dosen');
        
        return $this->db->get()->result();
    }

    public function get_grafik_data() {
        $this->db->group_by('program_studi_dosen'); // Group berdasarkan program studi
        $this->db->select('program_studi_dosen');  // Ambil kolom program studi
        $this->db->select('COUNT(*) as total_dosen'); // Hitung total dosen per program studi
        $this->db->from('tb_dosen'); // Tabel sumber data
        
        return $this->db->get()->result(); // Kembalikan hasil dalam bentuk objek
    }

    public function get_dosen_data() {
        $this->db->select('program_studi_dosen, COUNT(*) as total');
        $this->db->from('tb_dosen');
        $this->db->group_by('program_studi_dosen');
        return $this->db->get()->result();
        // return $query->result_array();
    }
    
}
