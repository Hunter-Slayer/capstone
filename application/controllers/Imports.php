<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Imports extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
		$this->load->view('admin/import/index');
		$this->load->view('partials/footer');
	}

	public function ImportStudent()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["data_upload"]) && $_FILES["data_upload"]["error"] == UPLOAD_ERR_OK) {
            $file_tmp = $_FILES["data_upload"]["tmp_name"];
            
            // Check if the file has a CSV format
            $file_extension = pathinfo($_FILES["data_upload"]["name"], PATHINFO_EXTENSION);
            if ($file_extension != 'csv') {
                $this->session->set_flashdata('fail', 'Please upload a CSV file only.');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_tmp);

            $worksheet = $spreadsheet->getActiveSheet();

			foreach ($worksheet->getRowIterator(2) as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); 
			
				$data = [];
			
				// Iterate through cells
				foreach ($cellIterator as $cell) {
					$data[] = $cell->getValue();
				}
			
				// Check if all necessary columns are present
				if (count($data) < 19) { // Assuming there are 19 columns required for a student's data
					$this->session->set_flashdata('fail', 'Please check the CSV file columns and data.');
					redirect($_SERVER['HTTP_REFERER']);
				}
			
				$data = [
					'student_id' => $data[0], 
					'first_name' => $data[1], 
					'middle_name' => $data[2], 
					'last_name' => $data[3], 
					'email' => $data[4], 
					'gender' => $data[5], 
					'civil_status' => $data[6], 
					'barangay_id' => $data[7], 
					'municipal_id' => $data[8], 
					'province_id' => $data[9], 
					'campus_id' => $data[10], 
					'course_id' => $data[11], 
					'year_level' => $data[12], 
					'father_name' => $data[13], 
					'mother_name' => $data[14], 
					'contact' => $data[15], 
					'classification' => $data[16], 
					'previous_school' => $data[17], 
					'previous_school_year' => $data[18], 
				];
				
				$this->Student->insert_student($data);
			}			

            $this->session->set_flashdata('success', 'Student Successfully Imported.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('fail', 'Please check the CSV file Columns and Data.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    } else {
        redirect('dashboards');
    }
}


}
