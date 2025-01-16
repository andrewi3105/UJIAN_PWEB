<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load the necessary models
        $this->load->model('M_jadwal');
        $this->load->model('M_dosen');
        $this->load->model('M_users');
        $this->load->model('M_mata_kuliah'); // No need to load again in tambah method
        
    }
    
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        // Mendapatkan kata kunci dari form pencarian
        $keyword = $this->input->post('keyword');
    
        // Cek apakah ada kata kunci yang dimasukkan
        if ($keyword) {
            // Cari data jadwal berdasarkan keyword
            $data['jadwal'] = $this->M_jadwal->search_jadwal($keyword);
        } else {
            // Jika tidak ada kata kunci, ambil semua data jadwal
            $data['jadwal'] = $this->M_jadwal->get_all_jadwal();
        }
        
        // Muat tampilan jadwal
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('jadwal', $data);
        $this->load->view('template/footer');
    }
    

    // Method to display the form to add new schedule
    public function tambah() {
        // Mendapatkan data pengguna dari session
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id); // Menambahkan data user
    
        // Data lain yang dibutuhkan untuk form tambah jadwal
        $data['mata_kuliah'] = $this->M_mata_kuliah->get_all_mata_kuliah();
        $data['dosen'] = $this->M_dosen->get_all_dosen();
    
        // Memuat view
        
        $this->load->view('tambah_jadwal', $data);
        $this->load->view('template/footer');
    }
    
    

    // Method to handle the form submission (insert data into database)
    public function tambah_aksi() {
        // Get the data from the form
        $data = array(
            'hari_jadwal'   => $this->input->post('hari_jadwal'),
            'jam_mulai'     => $this->input->post('jam_mulai'),
            'jam_selesai'   => $this->input->post('jam_selesai'),
            'kode_mk'       => $this->input->post('kode_mk'),
            'mata_kuliah'   => $this->input->post('mata_kuliah'),
            'kelas_jadwal'  => $this->input->post('kelas_jadwal'),
            'id_dosen'      => $this->input->post('id_dosen'),
            'unit_kelas'    => $this->input->post('unit_kelas'),
            'ruangan'       => $this->input->post('ruangan'),
            'program_studi' => $this->input->post('program_studi')
        );
    
        // Add validation to ensure no empty fields
        foreach ($data as $key => $value) {
            if (empty($value) && $key != 'ruangan' && $key != 'program_studi') { // Optional: If ruangan and program_studi can be empty
                $this->session->set_flashdata('error', 'Please fill all required fields');
                redirect('jadwal/tambah');
            }
        }
    
        // Insert the data into the 'tb_jadwal' table using the model
        $this->M_jadwal->insert_jadwal($data);
        
        // Redirect to the jadwal listing page after insertion
        redirect('jadwal');
    }
    

    // Method to handle editing jadwal
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $data['jadwal'] = $this->M_jadwal->get_jadwal_by_id($id);
        $data['dosen'] = $this->M_dosen->get_all_dosen(); // Mengambil data dosen
        
        if (empty($data['jadwal'])) {
            show_404(); // Jika ID tidak ditemukan
        }
        
        // Pastikan data dosen tersedia dan tidak kosong
        if (empty($data['dosen'])) {
            $data['dosen'] = [];
            $this->session->set_flashdata('error', 'Data dosen tidak tersedia.');
        }
    
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('edit_jadwal', $data);
        $this->load->view('template/footer');
    }
    

    public function edit_aksi($id) {
        $data = array(
            'hari_jadwal'   => $this->input->post('hari_jadwal'),
            'jam_mulai'     => $this->input->post('jam_mulai'),
            'jam_selesai'   => $this->input->post('jam_selesai'),
            'kode_mk'       => $this->input->post('kode_mk'),
            'mata_kuliah'   => $this->input->post('mata_kuliah'),
            'kelas_jadwal'  => $this->input->post('kelas_jadwal'),
            'id_dosen'      => $this->input->post('id_dosen'),
            'unit_kelas'    => $this->input->post('unit_kelas'),
            'ruangan'       => $this->input->post('ruangan') ?? 'Tidak Ditentukan',
            'program_studi' => $this->input->post('program_studi') ?? 'Tidak Ditentukan',
        );
        
        // Validasi input
        foreach ($data as $key => $value) {
            if (empty($value) && !in_array($key, ['ruangan', 'program_studi'])) {
                $this->session->set_flashdata('error', 'Semua kolom wajib diisi.');
                redirect('jadwal/edit/' . $id);
            }
        }

        // Update data
        $this->M_jadwal->update_jadwal($id, $data);
        $this->session->set_flashdata('success', 'Jadwal berhasil diperbarui.');
        redirect('jadwal');
    }

    // Method to delete jadwal
    public function delete($id) {
        // Attempt to delete the record from the database
        $this->M_jadwal->delete_jadwal($id);
        
        // Set a flash message for successful deletion
        $this->session->set_flashdata('message', 'Jadwal berhasil dihapus!');
        
        // Redirect back to the jadwal listing page
        redirect('jadwal');
    }
    

    public function print_jadwal() {
        // Ambil semua data jadwal
        $data['jadwal'] = $this->M_jadwal->get_all_jadwal();
        
        // Muat view untuk print jadwal
        $this->load->view('print_jadwal', $data);
    }

    public function grafik() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $data['hasil'] = $this->M_jadwal->get_grafik_data();
    
        // Muat tampilan grafik
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('v_grafik_jadwal', $data);
        $this->load->view('template/footer');
    }
    
    public function detail($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        // Mengambil jadwal berdasarkan ID
        $data['jadwal'] = $this->M_jadwal->get_jadwal_by_id($id);
    
        // Jika data tidak ditemukan
        if (empty($data['jadwal'])) {
            show_404();
        }
    
        // Muat tampilan detail
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('detail_jadwal', $data);
        $this->load->view('template/footer');
    }    

    public function pdf1() {
        // Load necessary libraries
        $this->load->library('pdf');
        $jadwal = $this->M_jadwal->get_all_jadwal(); // Fetch data from m_jadwal model
        
        // Initialize PDF with landscape orientation and A4 paper size
        $pdf = new Pdf('L', 'mm', 'A4');
        $pdf->AddPage();
    
        // Set font for the title
        $pdf->SetFont('Arial', 'B', 9);
        
        // Title Section
        $pdf->Cell(0, 8, 'Data Jadwal', 0, 1, 'C');
        $pdf->Ln(3); // Space after title
        
        // Set colors for table header
        $pdf->SetFillColor(0, 102, 204); // Blue color
        $pdf->SetTextColor(255, 255, 255); // White text
        $pdf->SetFont('Arial', 'B', 6);
    
        // Column widths for consistent table layout (without "Ruangan")
        $widths = [5, 12, 20, 10, 20, 20, 20, 15, 15, 15, 10, 15, 12];
        $rowHeight = 6; // Row height for all columns
    
        // Table header (without "Ruangan")
        $headers = [
            'No.', 'ID Jadwal', 'Mata Kuliah', 'ID Dosen', 'Created At', 'Updated At',
            'Program Studi', 'Hari Jadwal', 'Jam Mulai', 'Jam Selesai', 'Kode MK', 'Kelas Jadwal', 'Unit Kelas'
        ];
        foreach ($headers as $key => $header) {
            $pdf->Cell($widths[$key], $rowHeight, $header, 1, 0, 'C', true);
        }
        $pdf->Ln();
        
        // Reset text color to black and set font for table content
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 5);
    
        // Table rows
        $no = 1;
        foreach ($jadwal as $jdwl) {
            $currentHeight = $rowHeight;
    
            // Fill each cell with corresponding data (without "Ruangan")
            $pdf->Cell($widths[0], $currentHeight, $no++, 1, 0, 'C'); // No
            $pdf->Cell($widths[1], $currentHeight, $jdwl->id_jadwal, 1, 0, 'C'); // ID Jadwal
            $pdf->Cell($widths[2], $currentHeight, $jdwl->mata_kuliah, 1, 0, 'L'); // Mata Kuliah
            $pdf->Cell($widths[3], $currentHeight, $jdwl->jadwal_id_dosen, 1, 0, 'C'); // ID Dosen
            $pdf->Cell($widths[4], $currentHeight, $jdwl->created_at, 1, 0, 'C'); // Created At
            $pdf->Cell($widths[5], $currentHeight, $jdwl->updated_at, 1, 0, 'C'); // Updated At
            $pdf->Cell($widths[6], $currentHeight, $jdwl->program_studi, 1, 0, 'C'); // Program Studi
            $pdf->Cell($widths[7], $currentHeight, $jdwl->hari_jadwal, 1, 0, 'C'); // Hari Jadwal
            $pdf->Cell($widths[8], $currentHeight, $jdwl->jam_mulai, 1, 0, 'C'); // Jam Mulai
            $pdf->Cell($widths[9], $currentHeight, $jdwl->jam_selesai, 1, 0, 'C'); // Jam Selesai
            $pdf->Cell($widths[10], $currentHeight, $jdwl->kode_mk, 1, 0, 'C'); // Kode MK
            $pdf->Cell($widths[11], $currentHeight, $jdwl->kelas_jadwal, 1, 0, 'C'); // Kelas Jadwal
            $pdf->Cell($widths[12], $currentHeight, $jdwl->unit_kelas, 1, 0, 'C'); // Unit Kelas
    
            $pdf->Ln($currentHeight);
        }
    
        // Output the PDF
        $pdf->Output('D', 'Daftar_Jadwal.pdf');
    }

    public function exportExcel()
{
    // Get the data you want to export (Example: Mata Kuliah data)
    $data = $this->M_jadwal->get_all_jadwal(); 

    // Generate filename with the current date and time
    $filename = 'jadwal_report_' . date('d-m-Y_H-i-s') . '.xls';

    // Set headers to output the Excel file
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Cache-Control: max-age=0");

    // Table headers for the Excel file
    $headers = [
        'No.', 'ID Jadwal', 'Mata Kuliah', 'ID Dosen', 'Created At', 'Updated At',
        'Program Studi', 'Hari Jadwal', 'Jam Mulai', 'Jam Selesai', 'Kode MK', 'Kelas Jadwal', 'Unit Kelas'
    ];

    // Table styling (Optional for visual improvement)
    $headerColors = [
        '#FFEBEE', '#FFFDE7', '#E8F5E9', '#E3F2FD', '#FCE4EC', '#EDE7F6',
        '#F3E5F5', '#FFECB3', '#FFE0B2', '#C8E6C9', '#FFCDD2', '#E1BEE7', '#D1C4E9'
    ];

    // Start the table in HTML format
    echo "<table border='1'>";

    // Title Row
    echo "<tr><th colspan='" . count($headers) . "' style='text-align: center; font-size: 14px; font-weight: bold;'>Data Jadwal</th></tr>";

    // Header Row with background colors
    echo "<thead><tr>";
    foreach ($headers as $index => $header) {
        echo "<th style='background-color: {$headerColors[$index]}; color: #000; font-size: 12px; text-align: center;'>$header</th>";
    }
    echo "</tr></thead>";

    // Data Rows
    echo "<tbody>";
    $no = 1;
    foreach ($data as $jdwl) {
        echo "<tr>";
        echo "<td style='background-color: {$headerColors[0]}; text-align: center; font-size: 11px;'>" . $no++ . "</td>"; // No.
        echo "<td style='background-color: {$headerColors[1]}; text-align: center; font-size: 11px;'>" . htmlspecialchars($jdwl->id_jadwal) . "</td>"; // ID Jadwal
        echo "<td style='background-color: {$headerColors[2]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->mata_kuliah) . "</td>"; // Mata Kuliah
        echo "<td style='background-color: {$headerColors[3]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->jadwal_id_dosen) . "</td>"; // ID Dosen
        echo "<td style='background-color: {$headerColors[4]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->created_at) . "</td>"; // Created At
        echo "<td style='background-color: {$headerColors[5]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->updated_at) . "</td>"; // Updated At
        echo "<td style='background-color: {$headerColors[6]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->program_studi) . "</td>"; // Program Studi
        echo "<td style='background-color: {$headerColors[7]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->hari_jadwal) . "</td>"; // Hari Jadwal
        echo "<td style='background-color: {$headerColors[8]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->jam_mulai) . "</td>"; // Jam Mulai
        echo "<td style='background-color: {$headerColors[9]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->jam_selesai) . "</td>"; // Jam Selesai
        echo "<td style='background-color: {$headerColors[10]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->kode_mk) . "</td>"; // Kode MK
        echo "<td style='background-color: {$headerColors[11]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->kelas_jadwal) . "</td>"; // Kelas Jadwal
        echo "<td style='background-color: {$headerColors[12]}; text-align: left; font-size: 11px;'>" . htmlspecialchars($jdwl->unit_kelas) . "</td>"; // Unit Kelas
        echo "</tr>";
    }
    echo "</tbody>";

    // End the table
    echo "</table>";
    exit;
}


    


    }
    
    
        

?>
