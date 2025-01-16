<?php
class M_users extends CI_Model {
    
    // Fungsi untuk mengupdate gambar profil pengguna
    public function update_profile_picture($user_id, $image_url) {
        $data = array(
            'profile_picture_url' => $image_url
        );
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    // Fungsi untuk mendapatkan data pengguna berdasarkan ID
    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', ['id' => $user_id])->row();
    }
}
?>
