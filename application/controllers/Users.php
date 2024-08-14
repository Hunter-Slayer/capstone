<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);

		$data['users'] = $this->User->getUsers();
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/users/index', $data);
		$this->load->view('partials/footer');
	}

	public function create()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['campus'] = $this->Camp->getActiveCampus();
		$data['userTypes'] = $this->UserType->getUsersType();
		$data['notifications'] = $this->Notif->getNotifications();

		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/users/create', $data);
		$this->load->view('partials/footer');
	}
	public function show($userId)
	{
		$this->checkLogin();
		// Check if user is logged in
		$loggedInUserId = $this->session->userdata('user_id');
		if (!$loggedInUserId) {
			redirect('login'); // Redirect to login page if not logged in
		}


		$data['user'] = $this->User->getUserInfo($loggedInUserId);

		$data['users'] = $this->User->getUser($userId);
		$data['campus'] = $this->Camp->getActiveCampus();
		$data['userTypes'] = $this->UserType->getUsersType();
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/users/show', $data);
		$this->load->view('partials/footer');
	}

		public function edit($userId)
		{
			$this->checkLogin();
			// Check if user is logged in
			$loggedInUserId = $this->session->userdata('user_id');
			if (!$loggedInUserId) {
				redirect('login'); // Redirect to login page if not logged in
			}

			// Fetch the logged-in user's info
			$data['user'] = $this->User->getUserInfo($loggedInUserId);

			// Fetch the user to be edited using the passed userId
			$data['users'] = $this->User->getUser($userId);

			// Fetch active campuses and user types
			$data['campus'] = $this->Camp->getActiveCampus();
			$data['userTypes'] = $this->UserType->getUsersType();
			$data['notifications'] = $this->Notif->getNotifications();


			// Load views with data
			$this->load->view('partials/header');
			$this->load->view('partials/admin/navbar', $data);
			$this->load->view('partials/admin/sidebar', $data);
			$this->load->view('admin/users/edit', $data);
			$this->load->view('partials/footer');
		}


	public function store()
    {
        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
    		$this->create();
        } else {
            // Validation successful, process the data
            $data = [
                'name' => $this->input->post(ucwords('name')),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'type_id' => $this->input->post('user_type'),
                'campus_id' => $this->input->post('campus_id'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            ];

			if ($this->User->insert($data)) {
                // Successfully inserted, redirect or show success message
                $this->session->set_flashdata('success', 'User added successfully.');
				redirect($_SERVER['HTTP_REFERER']);

            } else {
                // Failed to insert, show error message
                $this->session->set_flashdata('error', 'Failed to add user. Please try again.');
				redirect($_SERVER['HTTP_REFERER']);

            } 
        }
    }

	// Update
	public function update($userId)
{
    $this->form_validation->set_rules('name', 'Name' );
    $this->form_validation->set_rules('username', 'Username' );
    $this->form_validation->set_rules('email', 'Email', 'valid_email');
    $this->form_validation->set_rules('type_id', 'User Type',);

    if (!empty($this->input->post('password'))) {
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');
    }

    if ($this->form_validation->run() == FALSE) {
        $this->edit($userId);
    } else {
        $data = array(
            'name' => $this->input->post(ucwords('name')),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'type_id' => $this->input->post('type_id'),
            'campus_id' => $this->input->post('campus_id')
        );

        // Update password only if it's not empty
        if (!empty($this->input->post('password'))) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        // Assuming you have a model method to update user data, replace 'Your_model' with your actual model name
        $result = $this->User->updateUser($data, $userId);

        if ($result) {
            $this->session->set_flashdata('success', 'User Updated Successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Failed to update. Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
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
