<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();

		
		
		$this->checkLogin();
		
		$data['totalGovScholar'] = $this->Scholarship->totalGovernmentScholarships();
		$data['totalPrivateScholar'] = $this->Scholarship->totalPrivateScholarships();

		$data['totalActiveGovScholar'] = $this->Scholarship->totalActiveGovernmentScholar();
		$data['totalActivePrivateScholar'] = $this->Scholarship->totalActivePrivateScholar();

		$data['years'] = $this->SchoolYear->getSchoolYear();
		
		//
		$data['totalGovernmentStudent'] = $this->Scholarship->totalGovernmentStudent();
		$data['totalPrivateStudent'] = $this->Scholarship->totalPrivateStudent();
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('partials/footer');
	}



	public function checkLogin()
	{
		if(!$this->session->userdata('logged_in')){
			redirect('login');
			exit();
		}
	}

	public function getCampusStudentData()
	{
		$scholarship_id = $this->input->get('scholarship_id');
		$school_year = $this->input->get('school_year');
	
		$data = $this->Scholarship->getCampusStudentCounts($scholarship_id, $school_year);
		echo json_encode($data);
	}
	

	public function getStudents()
	{
		// Get the current user's campus
		$userCampus = $this->session->userdata('campus'); // Assuming you store the user's campus in the session

		$selectedScholarshipType = $this->input->get('type1');
		$selectedYear = $this->input->get('selectedYear');

		// Retrieve students count for the user's campus
		$this->db->select('campuses.campus_name as label, COUNT(*) as data');
		$this->db->from('grantees');
		$this->db->join('students', 'grantees.student_id = students.id');
		$this->db->join('campuses', 'students.campus_id = campuses.id');
		$this->db->where('grantees.scholarship_type', $selectedScholarshipType);
		$this->db->where('grantees.school_year', $selectedYear);
		$this->db->where('students.campus_id', $userCampus); // Filter by the user's campus
		$this->db->group_by('campuses.campus_name');
		$studentsCount = $this->db->get()->result_array();

		echo json_encode($studentsCount);
	}


}
