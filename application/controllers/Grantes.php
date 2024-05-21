<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grantes extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['grantees'] = $this->Grant->getGrantees();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getActiveCampus();
		$data['years'] = $this->SchoolYear->getSchoolYear();

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
		$data['student'] = $this->Grant->getGrant($granteeId);

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['years'] = $this->SchoolYear->getSchoolYear();
		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/show', $data);
		$this->load->view('partials/footer');
	}

	public function edit($granteeId)
	{
		$data['student'] = $this->Grant->getGrant($granteeId);

		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['years'] = $this->SchoolYear->getSchoolYear();
		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/grantes/edit', $data);
		$this->load->view('partials/footer');
	}



}
