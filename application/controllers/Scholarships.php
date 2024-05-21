<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scholarships extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholarships'] = $this->Scholarship->getScholarships();

		// filter
		$data['totalGovScholar'] = $this->Scholarship->totalGovernmentScholarships(0);
		$data['totalPrivateScholar'] = $this->Scholarship->totalPrivateScholarships(1);

		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/create');
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
                'action' => 'Added Scholarship',
                'data' => json_encode(['Added: ' => $data['name']]),
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
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholar'] = $this->Scholarship->getScholar($scholarId);

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/scholar/show', $data);
		$this->load->view('partials/footer');
	}
	public function edit($scholarId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholar'] = $this->Scholarship->getScholar($scholarId);

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
                'data' => json_encode(['Updated: ' => $data]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
	
			$this->session->set_flashdata('success', 'Scholar data updated successfully.');
			redirect($_SERVER['HTTP_REFERER']);
		}

	}

}

