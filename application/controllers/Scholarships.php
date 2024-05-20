<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scholarships extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholarships'] = $this->Scholarship->getScholarships();
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
		$this->load->view('admin/scholar/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
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

		// Set flashdata message
		$this->session->set_flashdata('success', 'Scholarship saved successfully.');

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function show($scholarId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['scholar'] = $this->Scholarship->getScholar($scholarId);

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
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
		$this->load->view('partials/admin/sidebar');
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
	
		$this->session->set_flashdata('success', 'Scholar data updated successfully.');
	
		redirect($_SERVER['HTTP_REFERER']);

	}

}
