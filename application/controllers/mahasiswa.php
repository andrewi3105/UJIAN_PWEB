<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_mhs');
        $this->load->model('M_users');
        $this->load->helper('form');
        $this->load->library('session');
    }

    public function pdf1() {
        $this->load->library('pdf');  // Pastikan library pdf sudah di-load
        $dataMahasiswa = $this->M_mhs->get_data();
    
        // Create PDF object
        $pdf = new Pdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
    
        // Add a title
        $pdf->Cell(0, 10, 'Data Mahasiswa', 0, 1, 'C');
    
        // Add table headers
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 10, 'No', 1);
        $pdf->Cell(50, 10, 'Nama Mahasiswa', 1);
        $pdf->Cell(30, 10, 'NIM', 1);
        $pdf->Cell(50, 10, 'Tanggal Lahir', 1);
        $pdf->Cell(50, 10, 'Jurusan', 1);
        $pdf->Ln();
    
        // Populate table rows
        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($dataMahasiswa as $row) {
            $pdf->Cell(10, 10, $no++, 1);
            $pdf->Cell(50, 10, $row->nama, 1);
            $pdf->Cell(30, 10, $row->nim, 1);
            $pdf->Cell(50, 10, $row->tgl_lahir, 1);
            $pdf->Cell(50, 10, $row->jurusan, 1);
            $pdf->Ln();
        }
    
        // Output the PDF
        $pdf->Output('D', 'DataMahasiswa.pdf');
    }

    public function exportExcel() {
        $data = $this->M_mhs->get_data();
        include_once APPPATH . 'third_party/xlsxwriter.class.php';
    
        $filename = "report-" . date('d-m-Y-H-i-s') . ".xlsx";
    
        header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate");
        header("Pragma: public");
    
        $writer = new XLSXWriter();
    
        $header = [
            'No' => 'integer',
            'Nama Mahasiswa' => 'string',
            'NIM' => 'string',
            'Tanggal Lahir' => 'string',
            'Jurusan' => 'string'
        ];
    
        $styles = [
            'widths' => [5, 25, 20, 20, 25],
            'font' => 'Arial',
            'font-size' => 12,
            'font-style' => 'bold',
            'fill' => '#f2f2f2',
            'halign' => 'center',
            'border' => 'left,right,top,bottom'
        ];
    
        $styles2 = [
            ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#7ef786', 'halign' => 'left', 'border' => 'left,right,top,bottom'],
            ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#e6bbfa', 'halign' => 'left', 'border' => 'left,right,top,bottom'],
            ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'bold', 'fill' => '#ffcccc', 'halign' => 'center', 'border' => 'left,right,top,bottom'],
            ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#bbfae1', 'halign' => 'left', 'border' => 'left,right,top,bottom'],
            ['font' => 'Arial', 'font-size' => 10, 'font-style' => 'normal', 'fill' => '#f5bfe5', 'halign' => 'left', 'border' => 'left,right,top,bottom']
        ];
    
        $writer->writeSheetHeader('Sheet1', $header, $styles);
    
        $no = 1;
        foreach ($data as $row) {
            $writer->writeSheetRow('Sheet1', [
                $no++, 
                $row->nama, 
                $row->nim, 
                $row->tgl_lahir, 
                $row->jurusan
            ], $styles2);
        }
    
        $writer->writeToStdOut();
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $this->output->delete_cache();
        $keyword = $this->input->post('keyword');
        if ($keyword) {
            $data['mahasiswa'] = $this->M_mhs->search_data($keyword);
        } else {
            $data['mahasiswa'] = $this->M_mhs->get_data();
        }

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('mahasiswa', $data);
        $this->load->view('template/footer');
    }

    public function tampil_grafik() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        // Get the updated data
        $data['hasil'] = $this->M_mhs->Jum_mahasiswa_perjurusan();
        
        // Pass the data to the view
        $this->output->delete_cache();
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('v_grafik', $data);
        $this->load->view('template/footer');
    }
    

    public function tambah() {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $this->output->delete_cache();
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('tambah_mahasiswa');
        $this->load->view('template/footer');
    }

    public function tambah_aksi() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $error = $this->upload->display_errors();
            echo "Upload Error: " . $error;
            return;
        } else {
            $data_upload = $this->upload->data();
            $foto = $data_upload['file_name'];
        }

        $data = array(
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jurusan' => $this->input->post('jurusan'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'foto' => $foto
        );

        $this->M_mhs->insert_data($data);
        $this->session->set_flashdata('message', 'Data Berhasil di Input');
        redirect('mahasiswa/index');
    }

    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $this->output->delete_cache();
        $data['mahasiswa'] = $this->M_mhs->get_data_by_id($id);
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('edit_mahasiswa', $data);
        $this->load->view('template/footer');
    }

    public function update() {
        $id = $this->input->post('id');
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);
        
        if (!empty($_FILES['foto']['name'])) {
            if (!$this->upload->do_upload('foto')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error);
                redirect('mahasiswa/edit/' . $id);
            } else {
                $uploadData = $this->upload->data();
                $foto = $uploadData['file_name'];
            }
        } else {
            $foto = $this->input->post('foto_lama');
        }
    
        $data = array(
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jurusan' => $this->input->post('jurusan'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'foto' => $foto
        );
    
        $this->M_mhs->update_data($id, $data);
        $this->session->set_flashdata('message', 'Data Berhasil di Update');
        redirect('mahasiswa/index');
    }

    public function delete($id) {
        // Menghapus data mahasiswa berdasarkan ID
        $this->M_mhs->delete_data($id);
    
        // Ambil kembali data yang terupdate
        $data['hasil'] = $this->M_mhs->Jum_mahasiswa_perjurusan();
    
        // Kirim data terbaru untuk grafik
        $this->session->set_flashdata('message', 'Data mahasiswa berhasil dihapus');
        redirect('mahasiswa/index');  // Kembali ke halaman grafik yang sudah diperbarui
    }
    
    

    public function detail($id) {
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->M_users->get_user_by_id($user_id);

        $data['detail'] = $this->M_mhs->get_data_by_id($id);
        if (!$data['detail']) {
            show_404(); // Jika data tidak ditemukan, tampilkan halaman 404
        }
        
        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar');
        $this->load->view('detail', $data); 
        $this->load->view('template/footer');
    }

    public function print_mahasiswa() {
        $data['mahasiswa'] = $this->M_mhs->get_data();
        $this->load->view('print_mahasiswa', $data);
    }
}
?>
