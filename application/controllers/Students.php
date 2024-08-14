<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
{

	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();
		$data['students'] = $this->Student->getStudents();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/student/index', $data);
		$this->load->view('partials/footer');
	}
	public function is_student_id_exists($student_id) {
        $query = $this->db->get_where('students', ['student_id' => $student_id]);
        return $query->num_rows() > 0;
    }

	public function edit($studentId)
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();

		$data['student'] = $this->Student->getStudent($studentId);
		$data = $this->address($data);

		// others
		$data['campus'] = $this->Camp->getActiveCampus();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/student/edit', $data);
		$this->load->view('partials/footer');
	}

		public function create()
		{
			$this->checkLogin();
			$data = array();
			$data = $this->address($data);
			$userId = $this->session->userdata('user_id');
			$data['notifications'] = $this->Notif->getNotifications();
			$data['user'] = $this->User->getUserInfo($userId);

			// courses
			$data['campus'] = $this->Camp->getActiveCampus();
			$data['courses'] = $this->Course->getActiveCourses();

			$this->load->view('partials/header');
			$this->load->view('partials/admin/navbar', $data);
			$this->load->view('partials/admin/sidebar', $data);
			$this->load->view('admin/student/create', $data);
			$this->load->view('partials/footer');
		}
		
		public function searchStudent() {
			$student_id = $this->input->post('student_id');
			$result = $this->Student->searchStudentById($student_id);
			echo json_encode($result);
		}
		
		public function getStudentData() {
			$student_id = $this->input->post('student_id');
			$result = $this->Student->getStudentById($student_id);
			echo json_encode($result);
		}
		

		public function show($studentId)
		{
			$this->checkLogin();
			$userId = $this->session->userdata('user_id');
			$data['user'] = $this->User->getUserInfo($userId);
	
			$data['student'] = $this->Student->getStudent($studentId);
			$data['provinces'] = $this->Address->getProvince();
			$data['notifications'] = $this->Notif->getNotifications();
	
			$data['campus'] = $this->Camp->getActiveCampus();
	
	
			$this->load->view('partials/header');
			$this->load->view('partials/admin/navbar', $data);
			$this->load->view('partials/admin/sidebar', $data);
			$this->load->view('admin/student/show', $data);
			$this->load->view('partials/footer');
		}
	
	
	
		public function store()
		{
	
			$this->form_validation->set_rules('student_id', 'Student ID', 'required|is_unique[students.student_id]');
			$this->form_validation->set_rules('classification', 'Student Type', 'required');
	
			
			if ($this->form_validation->run() == FALSE) {
				$this->create();
			} else {
	
			$data = array(
				'student_id' => $this->input->post('student_id'),
				'campus_id' => $this->input->post('campus_id'),
				'first_name' => ucwords(strtolower($this->input->post('first_name'))),
				'middle_name' => ucwords(strtolower($this->input->post('middle_name'))),
				'last_name' => ucwords(strtolower($this->input->post('last_name'))),
				'gender' => $this->input->post('gender'),
				'civil_status' => $this->input->post('civil_status'),
				'email' => $this->input->post('email'),
				'contact' => $this->input->post('contact'),
				'province_id' => $this->input->post('province_id'),
				'municipal_id' => $this->input->post('municipal_id'),
				'barangay_id' => $this->input->post('barangay_id'),
				'year_level' => $this->input->post('year_level'),
				'course_id' => $this->input->post('course_id'),
				'father_name' => ucwords(strtolower($this->input->post('father_name'))),
				'mother_name' => ucwords(strtolower($this->input->post('mother_name'))),
				'classification' => $this->input->post('classification'),
				'previous_school' => $this->input->post('previous_school'),
				'previous_school_year' => $this->input->post('previous_school_year'),
			);
		
			$this->Student->insert_student($data);
	
			$user_id = $this->session->userdata('user_id');
			$username = $this->session->userdata('username');
	
			if ($user_id) {
				// Prepare audit trail data
				$audit_data = [
					'user_id' => $user_id,
					'action' => 'Added new Student',
					'data' => ('Added '. $data['last_name']. ', '. $data['first_name']),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				];
	
				// Insert audit trail record
				$this->Audit->insert_audit_trail($audit_data);
	
			$this->session->set_flashdata('success', 'Student data Added successfully.');
	
			redirect('admin/student/create');
			}
			}
		}
	
	
		public function update($studentId)
		{
			$data = array(
				'student_id' => $this->input->post('student_id'),
				'campus_id' => $this->input->post('campus_id'),
				'first_name' => ucwords(strtolower($this->input->post('first_name'))),
				'middle_name' => ucwords(strtolower($this->input->post('middle_name'))),
				'last_name' => ucwords(strtolower($this->input->post('last_name'))),
				'gender' => $this->input->post('gender'),
				'civil_status' => $this->input->post('civil_status'),
				'email' => $this->input->post('email'),
				'contact' => $this->input->post('contact'),
				'province_id' => $this->input->post('province_id'),
				'municipal_id' => $this->input->post('municipal_id'),
				'barangay_id' => $this->input->post('barangay_id'),
				'year_level' => $this->input->post('year_level'),
				'course_id' => $this->input->post('course_id'),
				'father_name' => ucwords(strtolower($this->input->post('father_name'))),
				'mother_name' => ucwords(strtolower($this->input->post('mother_name'))),
				'classification' => $this->input->post('classification'),
				'previous_school' => $this->input->post('previous_school'),
				'previous_school_year' => $this->input->post('previous_school_year'),
			);
		
			$this->Student->updateStudent($studentId, $data);
			$user_id = $this->session->userdata('user_id');
			$username = $this->session->userdata('username');
		
			if ($user_id) {
				// Prepare audit trail data
				$audit_data = [
					'user_id' => $user_id,
					'action' => 'Updated Student',
					'data' => (['Updated: '. $data]),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				];
		
				// Insert audit trail record
				$this->Audit->insert_audit_trail($audit_data);
		
			$this->session->set_flashdata('success', 'Student data updated successfully.');
		
			redirect('admin/student/edit/' . $studentId, 'refresh');
		
		}
	}
	
	
	public function address($data)
	{
		$data['provinces'] = $this->Address->getProvince();
		return $data;
	}

	public function getMunicipalities()
	{
		$province_id = $this->input->post('province_id');
		$municipalities = $this->Address->getMunicipalityByProvince($province_id);
		$options = "<option selected value=''>Choose from below</option>";
		foreach ($municipalities as $municipality) {
			$options .= "<option value='" . $municipality['citymunCode'] . "'>" . $municipality['citymunDesc'] . "</option>";
		}
		echo $options;
	}

	public function getBarangays()
	{
		$municipal_id = $this->input->post('municipal_id');
		$barangays = $this->Address->getBarangayByMunicipality($municipal_id);
		$options = "<option selected value=''>Choose from below</option>";
		foreach ($barangays as $barangay) {
			$options .= "<option value='" . $barangay['brgyCode'] . "'>" . $barangay['brgyDesc'] . "</option>";
		}
		echo $options;
	}

	public function getCourses()
	{
		$campus_id = $this->input->post('campus_id');
		$courses = $this->Course->getCourseByCampus($campus_id);
		$options = "<option selected value=''>Choose from below</option>";
		foreach ($courses as $course) {
			$options .= "<option value='" . $course['id'] . "'>" . $course['name'] . "</option>";
		}
		echo $options;
	}


	// add Grantee
	public function grantee($studentId)
	{
		$this->checkLogin();
		$data['student'] = $this->Student->getStudent($studentId);
		$data['campus'] = $this->Camp->getActiveCampus();
		$data['years'] = $this->SchoolYear->getSchoolYear();

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/student/grantee', $data);
		$this->load->view('partials/footer');
	}

	// Add Grantee
	public function addGrantee($studentId)
	{
	
		$inserted = false;
	
		if (
			!empty($this->input->post('scholarship_id1')) &&
			!empty($this->input->post('semester1')) &&
			!empty($this->input->post('school_year1')) 
		) {
			// Get data for the first scholarship
			$data1 = array(
				'student_id' => $studentId,
				'scholarship_id' => $this->input->post('scholarship_id1'),
				'semester' => $this->input->post('semester1'),
				'school_year' => $this->input->post('school_year1'),
			);
	
			// Insert the first set of data into the grantees table
			if ($this->Grant->insertGrantee($data1)) {
				$inserted = true;
				
			}
		}
	
		// Check if the second set of inputs are not empty
		if (
			!empty($this->input->post('scholarship_id2')) &&
			!empty($this->input->post('semester2')) &&
			!empty($this->input->post('school_year2')) 
		) {
			// Get data for the second scholarship
			$data2 = array(
				'student_id' => $studentId,
				'scholarship_id' => $this->input->post('scholarship_id2'),
				'semester' => $this->input->post('semester2'),
				'school_year' => $this->input->post('school_year2'),
			);
	
			// Insert the second set of data into the grantees table
			if ($this->Grant->insertGrantee($data2)) {
				$inserted = true;
			}
		}
	
		if ($inserted) {
		$userId = $this->session->userdata('user_id');
        $userData = $this->User->getUserInfo($userId); // Get user data
        $userType = $userData['type_id'];
        $userTypeName = $userData['userTypeName'];
        $campusName = $userData['campusName'];

        // Determine the notification message
        if ($userType == 1 || $userType == 2) {
            $notificationMessage = $userTypeName;
        } else {
            $notificationMessage = $userTypeName . ' - ' . $campusName;
        }

        // Prepare notification data
        $notificationData = array(
            'user_id' => $userId,
            'data' => $notificationMessage,
            'read_at' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

		        // Insert notification data
				$this->Notif->insertNotification($notificationData);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');
		// Prepare audit trail data
		$audit_data = [
			'user_id' => $user_id,
			'action' => 'Added new Grantee',
			'data' => ('Added new Grantee'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		// Insert audit trail record
		$this->Audit->insert_audit_trail($audit_data);




			// Redirect back with a success message
			$this->session->set_flashdata('success', 'Scholarship(s) added successfully.');
			
		} else {
			// Redirect back with an error message
			$this->session->set_flashdata('error', 'Failed to add scholarship(s). Please ensure all required fields are filled.');
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	

	public function getScholars()
	{
		$type = $this->input->post('type');
		$scholars = $this->Scholarship->getScholarType($type);
	
		echo '<option value="">Choose from below</option>';
		foreach ($scholars as $scholar) {
			echo '<option value="' . $scholar['id'] . '">' . $scholar['name'] . '</option>';
		}
	}
	
	public function getScholarsTwo()
	{
		$type = $this->input->post('type');
		$scholars = $this->Scholarship->getScholarType($type);
	
		echo '<option value="">Scholarships</option>';
		foreach ($scholars as $scholar) {
			echo '<option value="' . $scholar['id'] . '">' . $scholar['name'] . '</option>';
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


