<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

class Reports extends CI_Controller
{

	public function index()
	{
		$data = array();
		$data = $this->address($data);

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);

		$data['campus'] = $this->Camp->getActiveCampus();
		$data['courses'] = $this->Course->getActiveCourses();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
		$this->load->view('admin/report/index', $data);
		$this->load->view('partials/footer');
	}
	public function address($data)
	{
		$data['provinces'] = $this->Address->getProvince();
		return $data;
	}
	


	public function generateReport()
{
    // Retrieve form data
    $province_id = $this->input->post('province_id');
    $municipal_id = $this->input->post('municipal_id');
    $barangay_id = $this->input->post('barangay_id');
    $campus_id = $this->input->post('campus_id');
    $course_id = $this->input->post('course_id');
    $semester = $this->input->post('semester');
    $school_year = $this->input->post('school_year');
    $type2 = $this->input->post('type2');
    $scholarship_id2 = $this->input->post('scholarship_id2');

    // Query database to fetch student records based on form data
    $students = $this->Student->getStudentsReport($province_id, $municipal_id, $barangay_id, $campus_id, $course_id, $semester, $school_year, $type2, $scholarship_id2);

    // Check if students data is available
    if (empty($students)) {
        // Handle the case when no data is found, you can redirect or show a message
        echo "No data found for the given criteria.";
        return;
    }

    // Create new Spreadsheet object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Add headers to the Excel sheet
    $sheet->setCellValue('A1', 'Student ID');
    $sheet->setCellValue('B1', 'First Name');
    $sheet->setCellValue('C1', 'Middle Name');
    $sheet->setCellValue('D1', 'Last Name');
    $sheet->setCellValue('E1', 'Email Address');
    $sheet->setCellValue('F1', 'Sex');
    $sheet->setCellValue('G1', 'Civil Status');
    $sheet->setCellValue('H1', 'Barangay');
    $sheet->setCellValue('I1', 'Municipal');
    $sheet->setCellValue('J1', 'Province');
    $sheet->setCellValue('K1', 'Campus');
    $sheet->setCellValue('L1', 'Course/Program');
    $sheet->setCellValue('M1', 'Year Level');
    $sheet->setCellValue('N1', 'Father Name');
    $sheet->setCellValue('O1', 'Mother Name');
    $sheet->setCellValue('P1', 'Contact Number');
    $sheet->setCellValue('Q1', 'Type of Student');
    $sheet->setCellValue('R1', 'Name of School Last Attended');
    $sheet->setCellValue('S1', 'Last School Year Attended');

    // Populate Excel sheet with student records
    $row = 2; // Start from second row
    foreach ($students as $student) {
        $sheet->setCellValue('A' . $row, $student['student_id']);
        $sheet->setCellValue('B' . $row, $student['first_name']);
        $sheet->setCellValue('C' . $row, $student['middle_name']);
        $sheet->setCellValue('D' . $row, $student['last_name']);
        $sheet->setCellValue('E' . $row, $student['email']);
       
		$gender = $student['gender'] == 0 ? 'Male' : 'Female';
        $sheet->setCellValue('F' . $row, $gender);
		
		$status = $student['civil_status'] == 0 ? 'Single' : 'Married';
        $sheet->setCellValue('G' . $row, $status);

        $sheet->setCellValue('H' . $row, $student['barangay_name']);
        $sheet->setCellValue('I' . $row, $student['municipal_name']); 
        $sheet->setCellValue('J' . $row, $student['province_name']); 
        $sheet->setCellValue('K' . $row, $student['campus_name']); 
        $sheet->setCellValue('L' . $row, $student['course_name']); 
        $sheet->setCellValue('M' . $row, $student['year_level']);
        $sheet->setCellValue('N' . $row, $student['father_name']);
        $sheet->setCellValue('O' . $row, $student['mother_name']);
        $sheet->setCellValue('P' . $row, $student['contact']);
        $sheet->setCellValue('Q' . $row, $student['classification']);
        $sheet->setCellValue('R' . $row, $student['previous_school']);
        $sheet->setCellValue('S' . $row, $student['previous_school_year']);
        $row++;
    }

    // Set headers for Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="student_report.xlsx"');
    header('Cache-Control: max-age=0');

    // Save Excel file to output
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
}

}
