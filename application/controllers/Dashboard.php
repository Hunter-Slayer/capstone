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
	

	public function getStudents() {
		$type1 = $this->input->get('type1');
		$school_year = $this->input->get('school_year');
	
		$data = $this->Scholarship->getCampusData($type1, $school_year);
		echo json_encode($data);
	}

}
