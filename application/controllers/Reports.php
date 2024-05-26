<?php
defined('BASEPATH') or exit ('No direct script access allowed');
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
        $data['years'] = $this->SchoolYear->getSchoolYear();
		$data['notifications'] = $this->Notif->getNotifications();


        $this->load->view('partials/header');
        $this->load->view('partials/admin/navbar', $data);
        $this->load->view('partials/admin/sidebar', $data);
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

        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('school_year', 'School Year', 'required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Invalid input data. Please check your inputs.');
			return redirect('reports');
			
            
        }

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

        if (empty($students)) {

			$this->session->set_flashdata('error', 'No data found for the given criteria.');
			return redirect('reports');
        }

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers to the Excel sheet
        $headers = [
			'A1' => 'No.',
			'B1' => 'Student ID',
			'C1' => 'Full Name',
			'D1' => 'Sex',
			'E1' => 'Barangay',
			'F1' => 'Municipality',
			'G1' => 'Province',
            'H1' => 'Campus',
            'I1' => 'Course/Program',
            'J1' => 'Year Level',
            'K1' => 'Semester',
			'L1' => 'School Year',
			'M1' => 'Scholarship Type',
            'N1' => 'Scholarship'
        ];
		

        foreach ($headers as $cell => $header) {
            $sheet->setCellValue($cell, $header);
        }


		$counter = 1;
        // Populate Excel sheet with student records
        $row = 2; // Start from second row
        foreach ($students as $student) {
			$semesterOrdinal = $student['semester'] % 10 === 1 ? $student['semester'] . 'st' : ($student['semester'] % 10 === 2 ? $student['semester'] . 'nd' : $student['semester'] . 'th');
			$student['no'] = $counter;  // Add 'no' key to each student data
			$counter++;


            $sheet->setCellValue('A' . $row, $student['no']);
            $sheet->setCellValue('B' . $row, $student['studentId']);
			$sheet->setCellValue('C' . $row, $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']);

            $gender = $student['gender'] == 0 ? 'Male' : 'Female';
            $sheet->setCellValue('D' . $row, $gender);

            $sheet->setCellValue('E' . $row, $student['barangay_name']);
            $sheet->setCellValue('F' . $row, $student['municipal_name']);
            $sheet->setCellValue('G' . $row, $student['province_name']);
            $sheet->setCellValue('H' . $row, $student['campus_name']);
            $sheet->setCellValue('I' . $row, $student['course_name']);
            $sheet->setCellValue('J' . $row, $student['year_level']);
            $sheet->setCellValue('K' . $row, $semesterOrdinal);
            $sheet->setCellValue('L' . $row, $student['school_year']);
			$typeScholar = $student['scholarship_type'] == 0 ? 'Government' : 'Private';
            $sheet->setCellValue('M' . $row, $typeScholar);
            $sheet->setCellValue('N' . $row, $student['scholarshipName']);

            $row++;
        }

		// Set headers for Excel file
		ob_end_clean(); // Clear any previous output buffering
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="report.xlsx"');
		header('Cache-Control: max-age=0');
		header('Expires: 0');
		header('Pragma: public');

		// Auto-size columns after populating data
		foreach (range('A', 'N') as $col) { // Loop through columns A to N
			$sheet->getColumnDimension($col)->setAutoSize(true);
		  }
		

        // Save Excel file to output
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
		$user_id = $this->session->userdata('user_id');

	if ($user_id) {
		// Prepare audit trail data
		$audit_data = [
			'user_id' => $user_id,
			'action' => 'Reports have been generated',
			'data' => ('Reports have been generated'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		// Insert audit trail record
		$this->Audit->insert_audit_trail($audit_data);
	}
        exit;

    }

    public function checkLogin()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
            exit();
        }
    }
}
