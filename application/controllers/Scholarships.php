<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scholarships extends CI_Controller
{

	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholarships'] = $this->Scholarship->getScholarships();

		// filter
		$data['totalGovScholar'] = $this->Scholarship->totalGovernmentScholarships();
		$data['totalPrivateScholar'] = $this->Scholarship->totalPrivateScholarships();
		$data['notifications'] = $this->Notif->getNotifications();


		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/create');
		$this->load->view('partials/footer');
	}

	public function government()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();
		$data['govs'] = $this->Scholarship->getGovernment();



		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/government', $data);
		$this->load->view('partials/footer');
	}
	public function governmentActive()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();
		$data['actives'] = $this->Scholarship->getActiveGovernment();



		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/activegov',$data);
		$this->load->view('partials/footer');
	}
	public function private()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();
		$data['privates'] = $this->Scholarship->getPrivate();



		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/private',$data);
		$this->load->view('partials/footer');
	}
	public function privateActive()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();
		$data['actives'] = $this->Scholarship->getActivePrivate();



		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/activepri', $data);
		$this->load->view('partials/footer');
	}

	public function store()
	{
		$data = array(
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'type' => $this->input->post('type'),
		);

		$this->Scholarship->insertScholarship($data);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
            // Prepare audit trail data
            $audit_data = [
                'user_id' => $user_id,
                'action' => 'Added new Scholarship',
                'data' => ('Added: ' . $data['name']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);

		// Set flashdata message
		$this->session->set_flashdata('success', 'Scholarship saved successfully.');

		redirect($_SERVER['HTTP_REFERER']);
	}
}


	public function show($scholarId)
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholar'] = $this->Scholarship->getScholar($scholarId);
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/show', $data);
		$this->load->view('partials/footer');
	}
	public function edit($scholarId)
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholar'] = $this->Scholarship->getScholar($scholarId);
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update($scholarId)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'type' => $this->input->post('type'),
			'status' => $this->input->post('status'),
		);

		$this->Scholarship->updateScholar($scholarId, $data);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
            // Prepare audit trail data
            $audit_data = [
                'user_id' => $user_id,
                'action' => 'Updated Scolarship',
                'data' => ('Updated: ' . $data),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
	
			$this->session->set_flashdata('success', 'Scholar data updated successfully.');
			redirect($_SERVER['HTTP_REFERER']);
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

