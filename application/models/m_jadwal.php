<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal extends CI_Model {

    // Method to get all mata kuliah
    public function get_all_mata_kuliah() {
    $query = $this->db->get('tb_jadwal');
    return $query->result(); // Return the result as an array of objects
}

public function get_jumlah_jadwal() {
    $this->db->from('tb_jadwal'); // Pilih tabel 'tb_jadwal'
    return $this->db->count_all_results(); // Kembalikan jumlah baris pada tabel
}



    // Mendapatkan semua jadwal
    public function get_all_jadwal() {
        $this->db->select('
            tb_jadwal.id_jadwal, 
            tb_jadwal.mata_kuliah, 
            tb_jadwal.id_dosen AS jadwal_id_dosen, 
            tb_jadwal.created_at, 
            tb_jadwal.updated_at, 
            tb_jadwal.ruangan, 
            tb_jadwal.program_studi, 
            tb_jadwal.hari_jadwal, 
            tb_jadwal.jam_mulai, 
            tb_jadwal.jam_selesai, 
            tb_jadwal.kode_mk, 
            tb_jadwal.kelas_jadwal, 
            tb_jadwal.unit_kelas, 
            tb_dosen.nama_dosen
        ');
        $this->db->from('tb_jadwal');
        $this->db->join('tb_dosen', 'tb_jadwal.id_dosen = tb_dosen.id_dosen', 'left');
        return $this->db->get()->result();
    }
    

    // Insert new jadwal
    public function insert_jadwal($data) {
        // We don't need to manually insert 'created_at' and 'updated_at' as they are set to default in the database
        $this->db->insert('tb_jadwal', $data);
    }    

    // Get jadwal by id
// Method untuk mengambil jadwal berdasarkan ID
public function get_jadwal_by_id($id) {
    $this->db->select('
        tb_jadwal.id_jadwal,
        tb_jadwal.mata_kuliah,
        tb_jadwal.id_dosen AS jadwal_id_dosen,
        tb_jadwal.created_at,
        tb_jadwal.updated_at,
        COALESCE(tb_jadwal.ruangan, "Tidak Ditentukan") AS ruangan,
        COALESCE(tb_jadwal.program_studi, "Tidak Ditentukan") AS program_studi,
        tb_jadwal.hari_jadwal,
        tb_jadwal.jam_mulai,
        tb_jadwal.jam_selesai,
        tb_jadwal.kode_mk,
        tb_jadwal.kelas_jadwal,
        tb_jadwal.unit_kelas,
        tb_dosen.nama_dosen
    ');
    $this->db->from('tb_jadwal');
    $this->db->join('tb_dosen', 'tb_jadwal.id_dosen = tb_dosen.id_dosen', 'left');
    $this->db->where('tb_jadwal.id_jadwal', $id);
    $query = $this->db->get();
    return $query->row();
}

public function get_jadwal_per_hari() {
    $this->db->select('hari_jadwal, COUNT(*) as total');
    $this->db->from('tb_jadwal');
    $this->db->group_by('hari_jadwal');
    $this->db->order_by('FIELD(hari_jadwal, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")'); // Urutkan berdasarkan hari
    return $this->db->get()->result();
}


    // Update jadwal
    public function update_jadwal($id, $data) {
        $this->db->where('id_jadwal', $id);
        return $this->db->update('tb_jadwal', $data);
    }

    // Delete jadwal
    public function delete_jadwal($id) {
        $this->db->delete('tb_jadwal', ['id_jadwal' => $id]);
    }


    // Tambahkan fungsi untuk mendapatkan data jadwal per hari
public function get_grafik_data() {
    $this->db->select('hari_jadwal, COUNT(id_jadwal) as jumlah');
    $this->db->group_by('hari_jadwal');
    $this->db->order_by('hari_jadwal', 'ASC');
    $query = $this->db->get('tb_jadwal');
    return $query->result();
}

public function get_jadwal_terdekat() {
    $query = $this->db->query("
        SELECT 
            id_jadwal,
            mata_kuliah,
            ruangan,
            hari_jadwal,
            jam_mulai
        FROM 
            jadwal
        WHERE 
            (hari_jadwal = CASE 
                WHEN DAYNAME(CURDATE()) = 'Monday' THEN 'Senin'
                WHEN DAYNAME(CURDATE()) = 'Tuesday' THEN 'Selasa'
                WHEN DAYNAME(CURDATE()) = 'Wednesday' THEN 'Rabu'
                WHEN DAYNAME(CURDATE()) = 'Thursday' THEN 'Kamis'
                WHEN DAYNAME(CURDATE()) = 'Friday' THEN 'Jumat'
                WHEN DAYNAME(CURDATE()) = 'Saturday' THEN 'Sabtu'
                WHEN DAYNAME(CURDATE()) = 'Sunday' THEN 'Minggu'
            END AND jam_mulai BETWEEN CURTIME() AND ADDTIME(CURTIME(), '00:15:00'))
        ORDER BY 
            jam_mulai ASC
    ");
    
    log_message('debug', 'Jadwal Terdekat: ' . json_encode($query->result())); // Logging
    return $query->result();
}



public function search_jadwal($keyword) {
    // Convert the keyword to lowercase to ensure case-insensitive search
    $keyword = strtolower($keyword);

    // Mencari jadwal yang sesuai dengan kata kunci
    $this->db->like('LOWER(tb_jadwal.hari_jadwal)', $keyword); // Cari berdasarkan hari jadwal
    $this->db->or_like('LOWER(tb_jadwal.mata_kuliah)', $keyword); // Cari berdasarkan mata kuliah
    $this->db->or_like('LOWER(tb_dosen.nama_dosen)', $keyword); // Cari berdasarkan nama dosen
    $this->db->or_like('LOWER(tb_jadwal.kode_mk)', $keyword); // Cari berdasarkan kode MK

    // Join dengan tb_dosen untuk mengambil nama dosen
    $this->db->join('tb_dosen', 'tb_jadwal.id_dosen = tb_dosen.id_dosen', 'left');

    return $this->db->get('tb_jadwal')->result(); // Ambil hasilnya
}




}
?>
