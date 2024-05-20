<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campus extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getCampus();
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
		$this->load->view('admin/campus/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
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

		// Set flashdata message
		$this->session->set_flashdata('success', 'Campus Saved Successfully.');

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function show($campusId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getSingleCampus($campusId);
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
		$this->load->view('admin/campus/show', $data);
		$this->load->view('partials/footer');
	}


	public function edit($campusId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getSingleCampus($campusId);

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar');
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
	
		$this->session->set_flashdata('success', 'Campus Data Updated Successfully.');
	
		redirect($_SERVER['HTTP_REFERER']);

	}

}
