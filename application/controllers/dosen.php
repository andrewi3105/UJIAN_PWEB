<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_dosen'); 
        $this->load->model('M_users'); 
        $this->load->helper(['form', 'url']); // Helper form dan URL
        $this->load->library(['session', 'upload']); // Library session dan upload
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $keyword = $this->input->post('keyword');
        if ($keyword) {
            $data['dosen'] = $this->M_dosen->search_data($keyword);
        } else {
            $data['dosen'] = $this->M_dosen->get_data();
        }
    
        // Display flash message if set
        $data['flash_message'] = $this->session->flashdata('message');
        $data['flash_error'] = $this->session->flashdata('error');
    
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('dosen', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('tambah_dosen');
        $this->load->view('template/footer');
    }

    public function tambah_aksi() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto_dosen')) {
            $foto_dosen = null; // Jika tidak ada foto, tetap proses
        } else {
            $data_upload = $this->upload->data();
            $foto_dosen = $data_upload['file_name'];
        }

        $data = [
            'nama_dosen' => $this->input->post('nama_dosen'),
            'nomer_induk_dosen' => $this->input->post('nomer_induk_dosen'),
            'mata_kuliah_dosen' => $this->input->post('mata_kuliah_dosen'),
            'program_studi_dosen' => $this->input->post('program_studi_dosen'),
            'no_telp_dosen' => $this->input->post('no_telp_dosen'),
            'email_dosen' => $this->input->post('email_dosen'),
            'foto_dosen' => $foto_dosen
        ];

        $this->M_dosen->insert_data($data);
        $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
        redirect('dosen/index');
    }

    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $data['dosen'] = $this->M_dosen->get_data_by_id($id);
        if (!$data['dosen']) {
            show_404(); // Jika ID tidak ditemukan
        }

        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('edit_dosen', $data);
        $this->load->view('template/footer');
    }

    public function update() {
        $id = $this->input->post('id_dosen'); // Ambil ID dosen dari input hidden

        if (empty($id)) {
            $this->session->set_flashdata('error', 'ID Dosen Tidak Ditemukan');
            redirect('dosen/index');
        }

        // Konfigurasi untuk unggahan file
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->upload->initialize($config);

        // Cek apakah ada file foto baru yang diunggah
        if (!empty($_FILES['foto_dosen']['name'])) {
            if (!$this->upload->do_upload('foto_dosen')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('dosen/edit/' . $id);
            } else {
                $data_upload = $this->upload->data();
                $foto_dosen = $data_upload['file_name'];
            }
        } else {
            // Gunakan foto lama jika tidak ada unggahan baru
            $foto_dosen = $this->input->post('foto_dosen_lama');
        }

        $data = [
            'nama_dosen' => $this->input->post('nama_dosen'),
            'nomer_induk_dosen' => $this->input->post('nomer_induk_dosen'),
            'mata_kuliah_dosen' => $this->input->post('mata_kuliah_dosen'),
            'program_studi_dosen' => $this->input->post('program_studi_dosen'),
            'no_telp_dosen' => $this->input->post('no_telp_dosen'),
            'email_dosen' => $this->input->post('email_dosen'),
            'foto_dosen' => $foto_dosen
        ];

        // Update data dosen di database
        if ($this->M_dosen->update_data($id, $data)) {
            $this->session->set_flashdata('message', 'Data Berhasil Diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal Memperbarui Data');
        }

        redirect('dosen/index');
    }

    public function delete($id) {
        if ($this->M_dosen->delete_data($id)) {
            $this->session->set_flashdata('message', 'Data Dosen Berhasil Dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal Menghapus Data');
        }

        redirect('dosen/index');
    }

    public function exportExcel() {
        $data = $this->M_dosen->get_data();
        include_once APPPATH . 'third_party/xlsxwriter.class.php';
    
        $filename = "report-" . date('d-m-Y-H-i-s') . ".xlsx";
    
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
    
        $writer = new XLSXWriter();
    
        // Define header
        $header = [
            'No' => 'integer',
            'Nama Dosen' => 'string',
            'Nomor Induk Dosen' => 'string',
            'Mata Kuliah' => 'string',
            'Program Studi' => 'string',
            'No. Telepon' => 'string',
            'Email' => 'string',
            'Foto' => 'string',
            'Created At' => 'string',
            'Updated At' => 'string'
        ];
    
        // Define unique pastel colors for each column (both header and data)
        $columnStyles = [
            'No' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#FADADD', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Pink for No
            'Nama Dosen' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#FFECB3', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Yellow for Nama Dosen
            'Nomor Induk Dosen' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#D0E6FF', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Blue for Nomor Induk Dosen
            'Mata Kuliah' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#C8E6C9', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Green for Mata Kuliah
            'Program Studi' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#FFCCBC', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Orange for Program Studi
            'No. Telepon' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#E1BEE7', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Purple for No. Telepon
            'Email' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#FFF9C4', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Light Yellow for Email
            'Foto' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#FFCDD2', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Red for Foto
            'Created At' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#B3E5FC', 'halign' => 'center', 'border' => 'left,right,top,bottom'],  // Pastel Light Blue for Created At
            'Updated At' => ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#C8E6C9', 'halign' => 'center', 'border' => 'left,right,top,bottom']   // Pastel Mint for Updated At
        ];
    
        // Styles for the header row (set individual column colors for header)
        $headerStyles = [
            'widths' => [5, 25, 28, 25, 25, 20, 34, 30, 20, 20],
            'font' => 'Arial',
            'font-size' => 12,
            'font-style' => 'bold',
            'fill' => '#f2f2f2',
            'halign' => 'center',
            'border' => 'left,right,top,bottom'
        ];
    
        // Write header row with individual column colors
        $writer->writeSheetHeader('Sheet1', $header, $headerStyles);
    
        // Write data rows with unique pastel colors per column
        $no = 1;
        foreach ($data as $row) {
            $foto = !empty($row->foto_dosen) ? base_url('uploads/' . $row->foto_dosen) : 'No Photo';  // Link to photo or placeholder text
    
            // Apply individual styles for each column
            $writer->writeSheetRow('Sheet1', [
                $no++,  // Apply Pastel Pink for No
                $row->nama_dosen,  // Apply Pastel Yellow for Nama Dosen
                $row->nomer_induk_dosen,  // Apply Pastel Blue for Nomor Induk Dosen
                $row->mata_kuliah_dosen,  // Apply Pastel Green for Mata Kuliah
                $row->program_studi_dosen,  // Apply Pastel Orange for Program Studi
                $row->no_telp_dosen,  // Apply Pastel Purple for No. Telepon
                $row->email_dosen,  // Apply Pastel Light Yellow for Email
                $foto,  // Apply Pastel Red for Foto
                $row->created_at,  // Apply Pastel Light Blue for Created At
                $row->update_at   // Apply Pastel Mint for Updated At
            ], [
                $columnStyles['No'], // No column style
                $columnStyles['Nama Dosen'], // Nama Dosen column style
                $columnStyles['Nomor Induk Dosen'], // Nomor Induk Dosen column style
                $columnStyles['Mata Kuliah'], // Mata Kuliah column style
                $columnStyles['Program Studi'], // Program Studi column style
                $columnStyles['No. Telepon'], // No. Telepon column style
                $columnStyles['Email'], // Email column style
                $columnStyles['Foto'], // Foto column style
                $columnStyles['Created At'], // Created At column style
                $columnStyles['Updated At'] // Updated At column style
            ]);
        }
    
        // Output the Excel file
        $writer->writeToStdOut();
    }        
        

    public function pdf1() {
        $this->load->library('pdf');  // Ensure PDF library is loaded
        $dataDosen = $this->M_dosen->get_data();  // Fetch data from model
    
        // Create PDF object
        $pdf = new Pdf();
        $pdf->AddPage();
    
        // Set font for the title (bigger size)
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Data Dosen', 0, 1, 'C');
        $pdf->Ln(10);
    
        // Set pastel blue color for table header background
        $pdf->SetFillColor(173, 216, 230);  // RGB for pastel blue
        $pdf->SetTextColor(0, 0, 0);        // Black text color
    
        // Set font for table headers
        $pdf->SetFont('Arial', 'B', 8);  // Slightly larger font for headers
        $pdf->Cell(10, 20, 'No', 1, 0, 'C', true);
        $pdf->Cell(20, 20, 'Nama Dosen', 1, 0, 'C', true);
        $pdf->Cell(28, 20, 'Nomor Induk Dosen', 1, 0, 'C', true);
        $pdf->Cell(25, 20, 'Mata Kuliah', 1, 0, 'C', true);
        $pdf->Cell(25, 20, 'Program Studi', 1, 0, 'C', true);
        $pdf->Cell(20, 20, 'No. Telepon', 1, 0, 'C', true);
        $pdf->Cell(34, 20, 'Email', 1, 0, 'C', true);
        $pdf->Cell(30, 20, 'Foto', 1, 0, 'C', true);
        $pdf->Ln();
    
        // Set font for table data
        $pdf->SetFont('Arial', '', 6);  // Smaller font size
        $no = 1;
        foreach ($dataDosen as $row) {
            $pdf->Cell(10, 20, $no++, 1, 0, 'C');
            $pdf->Cell(20, 20, $row->nama_dosen, 1, 0, 'L');
            $pdf->Cell(28, 20, $row->nomer_induk_dosen, 1, 0, 'L');
            $pdf->Cell(25, 20, $row->mata_kuliah_dosen, 1, 0, 'L');
            $pdf->Cell(25, 20, $row->program_studi_dosen, 1, 0, 'L');
            $pdf->Cell(20, 20, $row->no_telp_dosen, 1, 0, 'L');
            $pdf->Cell(34, 20, $row->email_dosen, 1, 0, 'L');
    
            // Add image or placeholder for photo
            if (!empty($row->foto_dosen)) {
                $photoPath = './uploads/' . $row->foto_dosen;
    
                if (file_exists($photoPath)) {
                    list($width, $height) = getimagesize($photoPath);
                    $maxWidth = 18;  // Maximum width in mm for the "Foto" column
                    $maxHeight = 18; // Maximum height in mm for the "Foto" column
                    $ratio = min($maxWidth / $width, $maxHeight / $height);
                    $newWidth = $width * $ratio;
                    $newHeight = $height * $ratio;
    
                    $x = $pdf->GetX();
                    $y = $pdf->GetY();
    
                    $pdf->Cell(30, 20, '', 1, 0, 'C');  // Create a cell for the photo
                    $pdf->Image($photoPath, $x + 6, $y + 2, $newWidth, $newHeight);  // Center the image inside the cell
                } else {
                    $pdf->Cell(30, 20, 'No Photo', 1, 0, 'C');
                }
            } else {
                $pdf->Cell(30, 20, 'No Photo', 1, 0, 'C');
            }
    
            $pdf->Ln();
        }
    
        // Output the PDF directly to download
        $pdf->Output('D', 'Data_Dosen.pdf');  // 'D' forces download, 'Data_Dosen.pdf' is the filename
    }
        

    public function detail($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id); // Menambahkan data user
        
        $data['detail'] = $this->M_dosen->get_data_by_id($id);
        if (!$data['detail']) {
            show_404(); // Jika data tidak ditemukan, tampilkan halaman 404
        }
        
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('detail_dosen', $data); // View renamed to 'detail_dosen'
        $this->load->view('template/footer');
    }
    

    public function print_dosen() {
        $data['dosen'] = $this->M_dosen->get_data();
        $this->load->view('print_dosen', $data); // View renamed to 'print_dosen'
    }
    
    public function tampil_grafik() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id); // Fetching user data
    
        // Fetch the data for the chart (kept as $grafik for consistency)
        $data['hasil'] = $this->M_dosen->get_grafik_data(); 
    
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('v_grafik_dosen', $data); // View renamed to 'v_grafik_dosen'
        $this->load->view('template/footer');
    }
    
    
    
}
