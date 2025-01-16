<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mhs extends CI_Model {

    // Fungsi untuk mendapatkan semua data mahasiswa
    public function get_data() {
        return $this->db->get('tb_mhs')->result();
    }

    public function get_jumlah_mahasiswa() {
        $this->db->from('tb_mhs'); // Select the 'tb_mhs' table
        return $this->db->count_all_results(); // Return the count of rows in the table
    }

    // Fungsi untuk mendapatkan data mahasiswa berdasarkan ID
    public function get_data_by_id($id) {
        return $this->db->get_where('tb_mhs', array('id' => $id))->row();
    }

    // Fungsi untuk menambahkan data mahasiswa baru
    public function insert_data($data) {
        return $this->db->insert('tb_mhs', $data);
    }

    // Fungsi untuk memperbarui data mahasiswa berdasarkan ID
    public function update_data($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tb_mhs', $data);
    }

    // Fungsi untuk menghapus data mahasiswa berdasarkan ID
    public function delete_data($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_mhs');
    }

    // Fungsi untuk mendapatkan detail data mahasiswa berdasarkan ID
    public function detail_data($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tb_mhs');
        return $query->row();
    }

    // Fungsi untuk mencari data mahasiswa berdasarkan keyword
    public function search_data($keyword) {
        $this->db->like('nama', $keyword);
        $this->db->or_like('nim', $keyword);
        return $this->db->get('tb_mhs')->result();
    }

    // Fungsi untuk mendapatkan jumlah mahasiswa per jurusan
    public function jumlah_mahasiswa_per_mata_kuliah() {
        $this->db->select('mk.mata_kuliah, COUNT(m.id_mhs) as total');
        $this->db->from('tb_mhs as m');
        $this->db->join('tb_mata_kuliah as mk', 'm.kode_mk = mk.kode_mk', 'inner');
        $this->db->group_by('mk.mata_kuliah');
        $this->db->order_by('total', 'DESC');
        return $this->db->get()->result();
    }
    
    public function Jum_mahasiswa_perjurusan() {
    // Grouping data berdasarkan kolom 'jurusan'
    $this->db->group_by('jurusan');
    $this->db->select('jurusan');
    $this->db->select('COUNT(*) as total');
    $this->db->from('tb_mhs');
    
    // Ambil data terbaru
    return $this->db->get()->result();
}

    
       
}
?>
