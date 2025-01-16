<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Mata_kuliah extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation'); // Load form validation library
            $this->load->model('M_mata_kuliah');
            $this->load->model('M_users');
        }

        public function index() {
            $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

            $keyword = $this->input->post('keyword');
            $data['mata_kuliah'] = ($keyword) 
                ? $this->M_mata_kuliah->search_mata_kuliah($keyword)
                : $this->M_mata_kuliah->get_all_mata_kuliah();
            // Load views
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('mata_kuliah', $data);
            $this->load->view('template/footer');
        }

        public function detail($id_mata_kuliah) {
            $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

            $data['mata_kuliah'] = $this->M_mata_kuliah->get_data_by_id($id_mata_kuliah);
            if (!$data['mata_kuliah']) {
                show_404(); // Jika ID tidak ditemukan
            }
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('detail_mata_kuliah', $data);
            $this->load->view('template/footer');
        }
        
        // Show form for adding mata kuliah
        public function tambah() {
            $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('tambah_mata_kuliah');
            $this->load->view('template/footer');
        }

        public function insert_mata_kuliah($data) {
            $this->db->insert('tb_mata_kuliah', $data);
            return $this->db->insert_id(); // Mengembalikan ID yang baru saja ditambahkan
        }
        
        // Handle form submission for adding mata kuliah
        public function tambah_aksi() {
            $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

            $this->form_validation->set_rules('mata_kuliah', 'Mata Kuliah', 'required');
            $this->form_validation->set_rules('kode_mk', 'Kode MK', 'required');
            $this->form_validation->set_rules('deskripsi_mk', 'Deskripsi MK', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('jumlah_sks', 'Jumlah SKS', 'required|numeric');
            $this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'required');
            $this->form_validation->set_rules('nilai_minimal_kelulusan', 'Nilai Minimal Kelulusan', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                // Jika form tidak valid, tampilkan form tambah lagi
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('tambah_mata_kuliah');
                $this->load->view('template/footer');
            } else {
                // Data yang akan disimpan ke database
                $data = array(
                        'mata_kuliah' => $this->input->post('mata_kuliah'),
                        'kode_mk' => $this->input->post('kode_mk'),
                        'prasyarat_mk' => $this->input->post('prasyarat_mk'),
                        'deskripsi_mk' => $this->input->post('deskripsi_mk'),
                        'semester' => $this->input->post('semester'),  // Pastikan semester sudah ada disini
                        'jumlah_sks' => $this->input->post('jumlah_sks'),
                        'konsentrasi' => $this->input->post('konsentrasi'),
                        'nilai_minimal_kelulusan' => $this->input->post('nilai_minimal_kelulusan'),
                        'nama_mk_sebelumnya' => $this->input->post('nama_mk_sebelumnya')        
                );                               
            
                // Masukkan data ke dalam database dan dapatkan ID yang baru ditambahkan
                $inserted_id = $this->M_mata_kuliah->insert_mata_kuliah($data);
            
                // Set flash data untuk pesan sukses
                $this->session->set_flashdata('success', 'Mata Kuliah berhasil ditambahkan');
                
                // Pastikan kita mendapatkan ID yang benar dan melakukan redirect ke halaman detail yang benar
                if ($inserted_id) {
                    // Redirect ke halaman detail dengan ID yang baru
                    redirect('mata_kuliah/detail/' . $inserted_id);
                } else {
                    // Jika tidak berhasil, kembali ke halaman tambah
                    $this->session->set_flashdata('error', 'Gagal menambahkan mata kuliah');
                    redirect('mata_kuliah/tambah');
                }
            }
        }
        
        
        // Show form for editing mata kuliah
    // Method untuk menampilkan form edit
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $data['mata_kuliah'] = $this->M_mata_kuliah->get_mata_kuliah_by_id($id);
        if (!$data['mata_kuliah']) {
            show_404(); // Jika ID tidak ditemukan
        }
        // Pastikan data untuk semester ada
        $data['semester_options'] = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII']; // Opsi semester
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('edit_mata_kuliah', $data);
        $this->load->view('template/footer');
    }

        

        // Handle form submission for editing mata kuliah
        public function edit_aksi($id) {
            $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

            $this->form_validation->set_rules('mata_kuliah', 'Mata Kuliah', 'required');
            $this->form_validation->set_rules('kode_mk', 'Kode MK', 'required');
            $this->form_validation->set_rules('deskripsi_mk', 'Deskripsi MK', 'required');
            $this->form_validation->set_rules('semester', 'Semester', 'required');
            $this->form_validation->set_rules('jumlah_sks', 'Jumlah SKS', 'required|numeric');
            $this->form_validation->set_rules('konsentrasi', 'Konsentrasi', 'required');
            $this->form_validation->set_rules('nilai_minimal_kelulusan', 'Nilai Minimal Kelulusan', 'required');
            
            if ($this->form_validation->run() == FALSE) {
                $data['mata_kuliah'] = $this->M_mata_kuliah->get_mata_kuliah_by_id($id);
                $this->load->view('template/header',$data);
                $this->load->view('template/sidebar');
                $this->load->view('edit_mata_kuliah', $data);
                $this->load->view('template/footer');
            } else {
                $data = array(
                    'mata_kuliah' => $this->input->post('mata_kuliah'),
                    'kode_mk' => $this->input->post('kode_mk'),
                    'prasyarat_mk' => $this->input->post('prasyarat_mk'),
                    'deskripsi_mk' => $this->input->post('deskripsi_mk'),
                    'semester' => $this->input->post('semester'), // Ensure semester is passed
                    'jumlah_sks' => $this->input->post('jumlah_sks'),
                    'konsentrasi' => $this->input->post('konsentrasi'),
                    'nilai_minimal_kelulusan' => $this->input->post('nilai_minimal_kelulusan'),
                    'nama_mk_sebelumnya' => $this->input->post('nama_mk_sebelumnya')
                );                    
                $this->M_mata_kuliah->update_mata_kuliah($id, $data);
                $this->session->set_flashdata('success', 'Mata Kuliah berhasil diperbarui');
                redirect('mata_kuliah/detail/' . $id);
            }
        }    

        public function submit()
    {
        // Debug log untuk mencatat nilai semester
        log_message('debug', 'Semester value: ' . $this->input->post('semester'));

        // Lanjutkan dengan logika lainnya
        $semester = $this->input->post('semester');
        // Simpan data atau lakukan operasi lainnya
    }

        // Delete mata kuliah
        public function delete($id) {
            // Memeriksa apakah ID valid
            if (!empty($id)) {
                // Mengambil data mata kuliah berdasarkan ID
                $mata_kuliah = $this->M_mata_kuliah->get_mata_kuliah_by_id($id);
        
                // Jika data ditemukan
                if ($mata_kuliah) {
                    // Menghapus data mata kuliah
                    $this->M_mata_kuliah->delete_mata_kuliah($id);
                    // Set flash message untuk konfirmasi
                    $this->session->set_flashdata('success', 'Mata Kuliah berhasil dihapus.');
                } else {
                    // Set flash message jika data tidak ditemukan
                    $this->session->set_flashdata('error', 'Mata Kuliah tidak ditemukan.');
                }
            } else {
                $this->session->set_flashdata('error', 'ID Mata Kuliah tidak valid.');
            }
        
            // Redirect kembali ke halaman sebelumnya atau halaman daftar mata kuliah
            redirect('mata_kuliah');
        }        
                      

        // Generate PDF report
        public function pdf1() {
            $this->load->library('pdf');
            $mataKuliah = $this->M_mata_kuliah->get_all_mata_kuliah();
        
            // Buat PDF dengan orientasi 'L' (Landscape) untuk A4
            $pdf = new Pdf('L', 'mm', 'A4');
            $pdf->AddPage();
        
            // Set font untuk judul
            $pdf->SetFont('Arial', 'B', 9);
            
            // Title Section
            $pdf->Cell(0, 8, 'Data Mata Kuliah', 0, 1, 'C');
            $pdf->Ln(3); // Jarak setelah judul
        
            // Header warna biru
            $pdf->SetFillColor(0, 102, 204); // Warna biru
            $pdf->SetTextColor(255, 255, 255); // Warna putih untuk teks
            $pdf->SetFont('Arial', 'B', 6);
        
            // Lebar kolom untuk setiap bagian
            $widths = [7, 11, 24, 24, 19, 11, 7, 19, 11, 59]; // Lebar kolom tetap konsisten
            $rowHeight = 6; // Tinggi baris standar untuk semua kolom
        
            // Header tabel
            $headers = [
                'No.', 'Kode MK', 'Mata Kuliah', 'Nama MK Sebelumnya', 
                'Prasyarat MK', 'Semester', 'SKS', 'Konsentrasi', 
                'Nilai Min', 'Deskripsi'
            ];
            foreach ($headers as $key => $header) {
                $pdf->Cell($widths[$key], $rowHeight, $header, 1, 0, 'C', true);
            }
            $pdf->Ln();
        
            // Reset warna teks ke hitam untuk isi tabel
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Arial', '', 5); // Ukuran font lebih kecil untuk isi tabel
        
            // Isi data tabel
            $no = 1;
            foreach ($mataKuliah as $mk) {
                // Tinggi maksimum untuk deskripsi (multi-line)
                $deskripsiMaxHeight = $pdf->GetStringWidth($mk->deskripsi_mk) > $widths[9] ? $rowHeight * 2 : $rowHeight;
                
                // Tentukan tinggi baris agar semua baris sama tingginya
                $currentHeight = max($deskripsiMaxHeight, $rowHeight);
        
                $pdf->Cell($widths[0], $currentHeight, $no++, 1, 0, 'C'); // No
                $pdf->Cell($widths[1], $currentHeight, $mk->kode_mk, 1, 0, 'C'); // Kode MK
                $pdf->Cell($widths[2], $currentHeight, $mk->mata_kuliah, 1, 0, 'L'); // Mata Kuliah
                $pdf->Cell($widths[3], $currentHeight, $mk->nama_mk_sebelumnya, 1, 0, 'L'); // Nama MK Sebelumnya
                $pdf->Cell($widths[4], $currentHeight, $mk->prasyarat_mk, 1, 0, 'L'); // Prasyarat MK
                $pdf->Cell($widths[5], $currentHeight, $mk->semester, 1, 0, 'C'); // Semester
                $pdf->Cell($widths[6], $currentHeight, $mk->jumlah_sks, 1, 0, 'C'); // SKS
                $pdf->Cell($widths[7], $currentHeight, $mk->konsentrasi, 1, 0, 'L'); // Konsentrasi
                $pdf->Cell($widths[8], $currentHeight, $mk->nilai_minimal_kelulusan, 1, 0, 'C'); // Nilai Min
                
                // Untuk Deskripsi, gunakan MultiCell
                $x = $pdf->GetX();
                $y = $pdf->GetY();
                $pdf->MultiCell($widths[9], $rowHeight, $mk->deskripsi_mk, 1, 'L');
                $pdf->SetXY($x + $widths[9], $y); // Kembalikan posisi X agar kolom berikutnya tetap sejajar
        
                // Pindahkan posisi Y untuk baris berikutnya
                $pdf->Ln($currentHeight);
            }
        
            // Output PDF
            $pdf->Output('D', 'Daftar_Mata_Kuliah.pdf');
        }
        
        public function exportExcel() {
            $data = $this->M_mata_kuliah->get_all_mata_kuliah();
            $filename = 'mata_kuliah_report_' . date('d-m-Y_H-i-s') . '.xls';
        
            // Set header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Cache-Control: max-age=0");
        
            // Table headers
            $headers = [
                'No.', 'Kode MK', 'Mata Kuliah', 'Nama MK Sebelumnya', 
                'Prasyarat MK', 'Semester', 'SKS', 'Konsentrasi', 
                'Nilai Min', 'Deskripsi'
            ];
        
            // Warna pastel untuk header
            $headerColors = [
                '#FFEBEE', // Pink Muda
                '#FFFDE7', // Kuning Muda
                '#E8F5E9', // Hijau Muda
                '#E3F2FD', // Biru Muda
                '#FCE4EC', // Merah Muda
                '#EDE7F6', // Ungu Muda
                '#F3E5F5', // Lavender
                '#FFECB3', // Kuning Cerah
                '#FFE0B2', // Orange Muda
                '#C8E6C9'  // Hijau Pastel
            ];
        
            // Start table
            echo "<table border='1'>";
        
            // Title Row
            echo "<tr><th colspan='" . count($headers) . "' style='text-align: center; font-size: 14px; font-weight: bold;'>Data Mata Kuliah</th></tr>";
        
            // Header Row with styling
            echo "<thead><tr>";
            foreach ($headers as $index => $header) {
                echo "<th style='background-color: {$headerColors[$index]}; color: #000; font-size: 12px; text-align: center;'>$header</th>";
            }
            echo "</tr></thead>";
        
            // Data Rows
            echo "<tbody>";
            $no = 1;
            foreach ($data as $mk) {
                echo "<tr>";
                echo "<td style='background-color: {$headerColors[0]}; text-align: center; font-size: 11px;'>" . $no++ . "</td>"; // No.
                echo "<td style='background-color: {$headerColors[1]}; text-align: center; font-size: 11px;'>" . htmlspecialchars($mk->kode_mk) . "</td>"; // Kode MK
                echo "<td style='background-color: {$headerColors[2]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($mk->mata_kuliah) . "</td>"; // Mata Kuliah
                echo "<td style='background-color: {$headerColors[3]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($mk->nama_mk_sebelumnya) . "</td>"; // Nama MK Sebelumnya
                echo "<td style='background-color: {$headerColors[4]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($mk->prasyarat_mk) . "</td>"; // Prasyarat MK
                echo "<td style='background-color: {$headerColors[5]}; text-align: center; font-size: 11px;'>" . htmlspecialchars($mk->semester) . "</td>"; // Semester
                echo "<td style='background-color: {$headerColors[6]}; text-align: center; font-size: 11px;'>" . htmlspecialchars($mk->jumlah_sks) . "</td>"; // SKS
                echo "<td style='background-color: {$headerColors[7]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($mk->konsentrasi) . "</td>"; // Konsentrasi
                echo "<td style='background-color: {$headerColors[8]}; text-align: center; font-size: 11px;'>" . htmlspecialchars($mk->nilai_minimal_kelulusan) . "</td>"; // Nilai Min
                echo "<td style='background-color: {$headerColors[9]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($mk->deskripsi_mk) . "</td>"; // Deskripsi
                echo "</tr>";
            }
            echo "</tbody>";
        
            // End table
            echo "</table>";
            exit;
        }
        

        // Grafik function (assuming it's for a graphical view)
        public function grafik() {
            $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

            $data['hasil'] = $this->M_mata_kuliah->get_v_grafik_mata_kuliah();
            $this->load->view('template/header',$data);
            $this->load->view('template/sidebar');
            $this->load->view('v_grafik_mata_kuliah', $data);
            $this->load->view('template/footer');
        }

        public function print_mata_kuliah() {
            $data['mata_kuliah'] = $this->M_mata_kuliah->get_all_mata_kuliah();  // Use get_all_mata_kuliah()
            $this->load->view('print_mata_kuliah', $data);
        }
    }

    ?> 
