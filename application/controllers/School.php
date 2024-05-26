<?php

use Config\Database;
defined('BASEPATH') or exit('No direct script access allowed');

class School extends CI_Controller{

	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['notifications'] = $this->Notif->getNotifications();

		$data['users'] = $this->User->getUsers();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/schoolyear/index', $data);
		$this->load->view('partials/footer');
	}
	public function checkLogin()
{
	if(!$this->session->userdata('logged_in')){
		redirect('login');
		exit();
	}
}

public function store() {
    $this->checkLogin();
    $userId = $this->session->userdata('user_id');
    $data['user'] = $this->User->getUserInfo($userId);
    $data['users'] = $this->User->getUsers();
	$data['notifications'] = $this->Notif->getNotifications();


    $this->form_validation->set_rules('year', 'School Year', 'required|regex_match[/^\d{4}-\d{4}$/]');

    if ($this->form_validation->run() === FALSE) {
        $data['title'] = 'Add School Year';
        $this->load->view('partials/header', $data);
        $this->load->view('partials/admin/navbar', $data);
        $this->load->view('partials/admin/sidebar', $data);
        $this->load->view('admin/schoolyear/index', $data);
        $this->load->view('partials/footer');
    } else {
        $schoolYearData = array(
            'school_year' => $this->input->post('year'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        if ($this->SchoolYear->insertSchoolYear($schoolYearData)) {
            $this->session->set_flashdata('message', 'School year added successfully!');

            
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

            // Prepare audit trail data
            $audit_data = [
                'user_id' => $user_id,
                'action' => 'Added new School Year',
                'data' => ('Added by' . $username),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
        } else {
            $this->session->set_flashdata('error', 'There was an error adding the school year. Please try again.');
        }

        redirect('admin/schoolyear/index');
    }
}



}
