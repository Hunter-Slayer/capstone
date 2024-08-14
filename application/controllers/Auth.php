<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function login()
	{
		$this->load->view('partials/header');
		$this->load->view('auth/login');
		$this->load->view('partials/footer');
	}

	public function loginProcess()
	{
		// Set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'All fields are required');
			redirect('login');
			// $this->login();

		} else {
			// Validation passed, process the login
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Call the model method to check the credentials
			$user = $this->User->check_credentials($username, $password);

			if ($user) {
				// Credentials are correct, set session data
				$this->session->set_userdata('logged_in', TRUE);
				$this->session->set_userdata('user_id', $user['id']);
				$this->session->set_userdata('username', $user['username']);

				// Prepare audit trail data
				$audit_data = [
					'user_id' => $user['id'],
					'action' => 'Logged in',
					'data' => ('Username: ' . $user['username']), // Correctly format the data field
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s')
				];

				// Insert audit trail record
				$this->Audit->insert_audit_trail($audit_data);
				// Redirect to a protected area
				redirect('dashboard');
			} else {
				// Credentials are incorrect, set an error message
				$this->session->set_flashdata('error', 'Invalid Username or Password');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}


	// log out
	public function logout()
	{
		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
			// Prepare audit trail data
			$audit_data = [
				'user_id' => $user_id,
				'action' => 'Logged out',
				'data' => ('Username' . $username), // Correctly format the data field
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			];
	

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
        }
		
		$this->session->sess_destroy();
		redirect('login');
	}
}
