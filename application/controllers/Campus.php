<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campus extends CI_Controller
{

	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getCampus();
		$data['notifications'] = $this->Notif->getNotifications();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/campus/index', $data);
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
		$this->load->view('admin/campus/create');
		$this->load->view('partials/footer');
	}

	public function store()
	{
		$data = array(
			'description' => $this->input->post('description'),
			'name' => $this->input->post('name'),
		);

		$this->Camp->insertCampus($data);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
			// Prepare audit trail data
			$audit_data = [
				'user_id' => $user_id,
				'action' => 'Added Campus',
				'data' => ('Username: ' . $username), // Correctly format the data field
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			];
	

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
        }

		// Set flashdata message
		$this->session->set_flashdata('success', 'Campus Saved Successfully.');

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function show($campusId)
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getSingleCampus($campusId);
		$data['notifications'] = $this->Notif->getNotifications();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/campus/show', $data);
		$this->load->view('partials/footer');
	}


	public function edit($campusId)
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getSingleCampus($campusId);
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/campus/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update($campusId)
	{
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'status' => $this->input->post('status'),
		);

		$this->Camp->updateCampus($campusId, $data);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
            // Prepare audit trail data
            $audit_data = [
                'user_id' => $user_id,
                'action' => 'Updated campus',
                'data' => ('Updated: ' . $data),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
        }
	
		$this->session->set_flashdata('success', 'Campus Data Updated Successfully.');
	
		redirect($_SERVER['HTTP_REFERER']);

	}
	public function checkLogin()
	{
		if(!$this->session->userdata('logged_in')){
			redirect('login');
			exit();
		}
	}

}
