<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['courses'] = $this->Course->getCourses();
		
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/courses/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getActiveCampus();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/courses/create', $data);
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

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
            // Prepare audit trail data
            $audit_data = [
                'user_id' => $user_id,
                'action' => 'Added Courses',
                'data' => json_encode(['Added: ' => $data]),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
        }

		$this->Course->insertCourse($data);

		$this->session->set_flashdata('success', 'Course Saved Successfully.');

		redirect($_SERVER['HTTP_REFERER']);
	}

	public function show($courseId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['course'] = $this->Course->getCourse($courseId);
		$data['campus'] = $this->Camp->getActiveCampus();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/courses/show', $data);
		$this->load->view('partials/footer');
	}

	public function edit($courseId)
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['course'] = $this->Course->getCourse($courseId);
		$data['campus'] = $this->Camp->getActiveCampus();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/courses/edit', $data);
		$this->load->view('partials/footer');
	}

	public function update($courseId)
	{
		$data = array(
			'campus_id' => $this->input->post('campus_id'),
			'abbrevation' => $this->input->post('abbrevation'),
			'name' => $this->input->post('name'),
			'status' => $this->input->post('status'),
		);

		$this->Course->updateCourse($courseId, $data);
	
		$this->session->set_flashdata('success', 'Course data updated successfully.');
	
		redirect($_SERVER['HTTP_REFERER']);

	}

}
