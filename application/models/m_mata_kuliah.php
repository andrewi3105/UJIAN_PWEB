<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mata_kuliah extends CI_Model {

    // Method to get all mata kuliah
    public function get_all_mata_kuliah() {
        $this->db->select('id_mata_kuliah, mata_kuliah, kode_mk, jumlah_sks, semester, prasyarat_mk, deskripsi_mk, nama_mk_sebelumnya, konsentrasi, nilai_minimal_kelulusan'); // Menambahkan nama_mk_sebelumnya
        return $this->db->get('tb_mata_kuliah')->result();
    }
    
    public function get_data_by_id($id) {
        return $this->db->get_where('tb_mata_kuliah', ['id_mata_kuliah' => $id])->row();
    }

    public function get_jumlah_matakuliah() {
        $this->db->from('tb_mata_kuliah'); // Pilih tabel 'tb_mata_kuliah'
        return $this->db->count_all_results(); // Kembalikan jumlah baris pada tabel
    }

    // Method to insert new mata kuliah
    public function insert_mata_kuliah($data) {
        $this->db->insert('tb_mata_kuliah', $data); // Insert data
        return $this->db->insert_id(); // Mengembalikan ID yang baru saja ditambahkan
    }


    // Method to get mata kuliah by ID
    public function get_mata_kuliah_by_id($id)
    {
        $this->db->where('id_mata_kuliah', $id);
        $query = $this->db->get('tb_mata_kuliah');
        return $query->row(); // Mengembalikan satu baris data jika ditemukan
    }        

    // Method to update mata kuliah
    public function update_mata_kuliah($id, $data) {
        $this->db->where('id_mata_kuliah', $id);
        return $this->db->update('tb_mata_kuliah', $data);
    }    

    // Method to delete mata kuliah
    public function delete_mata_kuliah($id)
    {
        $this->db->where('id_mata_kuliah', $id);
        $this->db->delete('tb_mata_kuliah');
        return $this->db->affected_rows() > 0; // Memastikan apakah baris data terhapus
    }      

    public function search_mata_kuliah($keyword) {
        $this->db->like('mata_kuliah', $keyword);
        $this->db->or_like('kode_mk', $keyword);
        $this->db->or_like('deskripsi_mk', $keyword);
        return $this->db->get('tb_mata_kuliah')->result();
    }

    public function get_v_grafik_mata_kuliah() {
        $this->db->select('mata_kuliah, jumlah_sks'); // Kolom tabel yang dibutuhkan
        $query = $this->db->get('tb_mata_kuliah');    // Nama tabel di database
        return $query->result();                      // Mengembalikan hasil query
    }

    public function get_grafik_mata_kuliah() {
        $this->db->select('mata_kuliah, jumlah_sks'); // Pilih kolom yang dibutuhkan
        $query = $this->db->get('tb_mata_kuliah');   // Query ke tabel `tb_mata_kuliah`
        return $query->result();                     // Mengembalikan hasil sebagai array objek
    }      

    public function get_mata_kuliah() {
        $this->db->select('mata_kuliah, jumlah_sks');
        $this->db->from('tb_mata_kuliah');
        return $this->db->get()->result();
    }
    
    
    // Fungsi untuk mendapatkan detail data dosen berdasarkan ID
    public function detail($id_mata_kuliah) {
        $data['mata_kuliah'] = $this->M_mata_kuliah->get_mata_kuliah_by_id($id_mata_kuliah);
        if (!$data['mata_kuliah']) {
            show_404(); // Handle if id not found
        }
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('detail_mata_kuliah', $data);
        $this->load->view('template/footer');
    }
    
}
?> 