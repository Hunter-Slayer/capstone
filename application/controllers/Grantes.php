<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grantes extends CI_Controller
{

	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['grantees'] = $this->Grant->getGrantees();
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getActiveCampus();
		$data['years'] = $this->SchoolYear->getSchoolYear();
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/create', $data);
		$this->load->view('partials/footer');
	}

	public function store()
	{
		$data = array(
			'campus_id' => $this->input->post('campus_id'),
			'name' => $this->input->post('name'),
			'abbrevation' => $this->input->post('abbrevation'),
			'status' => $this->input->post('status'),
		);

		$this->Course->insertCourse($data);

		$this->session->set_flashdata('success', 'Course Saved Successfully.');

		redirect($_SERVER['HTTP_REFERER']);
	}

	

	public function show($granteeId)
	{
		$this->checkLogin();
		$data['student'] = $this->Grant->getGrant($granteeId);

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['years'] = $this->SchoolYear->getSchoolYear();
		$data['notifications'] = $this->Notif->getNotifications();
		$data['campuses'] = $this->Camp->getActiveCampus();

		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/show', $data);
		$this->load->view('partials/footer');
	}

	public function edit($granteeId)
	{
		$this->checkLogin();
		$data['student'] = $this->Grant->getGrant($granteeId);

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['years'] = $this->SchoolYear->getSchoolYear();
		$data['notifications'] = $this->Notif->getNotifications();

		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/edit', $data);
		$this->load->view('partials/footer');
	}


	public function govgrantee() {
		$this->checkLogin();
		
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['governments'] = $this->Grant->filterGov();
		$data['notifications'] = $this->Notif->getNotifications();
	
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/govgrantee', $data);
		$this->load->view('partials/footer');
	}
	
	

		// Fetch private grantees
		public function prigrantee() {
			$this->checkLogin();
			$userId = $this->session->userdata('user_id');
			$data['user'] = $this->User->getUserInfo($userId);
			$data['privates'] = $this->Grant->filterPrivate(); // Assuming method to fetch private grantees
			$data['notifications'] = $this->Notif->getNotifications();

			$this->load->view('partials/header');
			$this->load->view('partials/admin/navbar', $data);
			$this->load->view('partials/admin/sidebar', $data);
			$this->load->view('admin/grantes/prigrantee', $data);
			$this->load->view('partials/footer');
		}

	public function checkLogin()
	{
		if(!$this->session->userdata('logged_in')){
			redirect('login');
			exit();
		}
	}

	public function delete($granteeId) {
        $studentReference = $this->Grant->get_student_reference_by_grantee_id($granteeId);
        if ($studentReference) {
            $this->Student->update_status_by_reference($studentReference, 1);
            $this->Grant->update_status($granteeId, 1);
            $this->session->set_flashdata('message', 'Deleted successfully.');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete.');
        }
        redirect('admin/grantes');
    }

}
