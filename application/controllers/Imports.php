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
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
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
						'first_name' => isset($data[1]) ? ucwords(strtolower($data[1])) : null, 
						'last_name' => isset($data[2]) ? ucwords(strtolower($data[2])) : null, 
						'middle_name' => isset($data[3]) ? ucwords(strtolower($data[3])) : null, 
						'email' => isset($data[4]) ? $data[4] : null, 
						'gender' => isset($data[5]) ? $data[5] : null, 
						'civil_status' => isset($data[6]) ? $data[6] : null, 
						'barangay_id' => isset($data[7]) ? $data[7] : null, 
						'municipal_id' => isset($data[8]) ? $data[8] : null, 
						'province_id' => isset($data[9]) ? $data[9] : null, 
						'campus_id' => isset($data[10]) ? $data[10] : null, 
						'course_id' => isset($data[11]) ? $data[11] : null, 
						'year_level' => isset($data[12]) ? $data[12] : null, 
						'father_name' => isset($data[13]) ? ucwords(strtolower($data[13])) : null, 
						'mother_name' => isset($data[14]) ? ucwords(strtolower($data[14])) : null, 
						'contact' => isset($data[15]) ? $data[15] : null, 
						'classification' => isset($data[16]) ? $data[16] : null, 
						'previous_school' => isset($data[17]) ? $data[17] : null,     
						'previous_school_year' => isset($data[18]) ? $data[18] : null, 
					];
					
					

					// Check if student_id is unique
					if ($this->Student->is_student_id_exists($data['student_id'])) {
						$this->session->set_flashdata('fail', 'Duplicate student ID found: ' . $data['student_id']);
						redirect($_SERVER['HTTP_REFERER']);
					}
					
					$this->Student->insert_student($data);
				}			

				$this->session->set_flashdata('success', 'Student Successfully Imported.');
				$user_id = $this->session->userdata('user_id');
				$username = $this->session->userdata('username');

			if ($user_id) {
				// Prepare audit trail data
				$audit_data = [
					'user_id' => $user_id,
					'action' => 'Imported Students data',
					'data' => ('Imported Students data by ' . $username),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				];

				// Insert audit trail record
				$this->Audit->insert_audit_trail($audit_data);
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
public function checkLogin()
{
	if(!$this->session->userdata('logged_in')){
		redirect('login');
		exit();
	}
}
}
