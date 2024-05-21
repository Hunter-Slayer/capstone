<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);

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
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);

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
		$data = array();
		$data = $this->address($data);
		$userId = $this->session->userdata('user_id');
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

	public function show($studentId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);

		$data['student'] = $this->Student->getStudent($studentId);
		$data['provinces'] = $this->Address->getProvince();


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

        if ($this->form_validation->run() == FALSE) {
    		$this->create();
        } else {

		$data = array(
			'student_id' => $this->input->post('student_id'),
			'campus_id' => $this->input->post('campus_id'),
			'first_name' => $this->input->post('first_name'),
			'middle_name' => $this->input->post('middle_name'),
			'last_name' => $this->input->post('last_name'),
			'gender' => $this->input->post('gender'),
			'civil_status' => $this->input->post('civil_status'),
			'email' => $this->input->post('email'),
			'contact' => $this->input->post('contact'),
			'province_id' => $this->input->post('province_id'),
			'municipal_id' => $this->input->post('municipal_id'),
			'barangay_id' => $this->input->post('barangay_id'),
			'year_level' => $this->input->post('year_level'),
			'course_id' => $this->input->post('course_id'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
		);
	
		$this->Student->insert_student($data);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
            // Prepare audit trail data
            $audit_data = [
                'user_id' => $user_id,
                'action' => 'Added Student',
                'data' => json_encode(['Added '. $data['last_name']. ', '. $data['first_name']]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);

		$this->session->set_flashdata('success', 'Student data Added successfully.');

		redirect('students');
		}
		}
	}


	public function update($studentId)
	{
		$data = array(
			'student_id' => $this->input->post('student_id'),
			'campus_id' => $this->input->post('campus_id'),
			'first_name' => $this->input->post('first_name'),
			'middle_name' => $this->input->post('middle_name'),
			'last_name' => $this->input->post('last_name'),
			'gender' => $this->input->post('gender'),
			'civil_status' => $this->input->post('civil_status'),
			'email' => $this->input->post('email'),
			'contact' => $this->input->post('contact'),
			'province_id' => $this->input->post('province_id'),
			'municipal_id' => $this->input->post('municipal_id'),
			'barangay_id' => $this->input->post('barangay_id'),
			'year_level' => $this->input->post('year_level'),
			'course_id' => $this->input->post('course_id'),
			'father_name' => $this->input->post('father_name'),
			'mother_name' => $this->input->post('mother_name'),
		);
	
		$this->Student->updateStudent($studentId, $data);
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');
	
		if ($user_id) {
			// Prepare audit trail data
			$audit_data = [
				'user_id' => $user_id,
				'action' => 'Updated Student',
				'data' => json_encode(['Updated: '. $data]),
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
		$data['student'] = $this->Student->getStudent($studentId);
		$data['campus'] = $this->Camp->getActiveCampus();
		$data['years'] = $this->SchoolYear->getSchoolYear();

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);

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
	


}


