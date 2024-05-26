<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuditController extends CI_Controller
{
	public function index()
	{
		$this->checkLogin();
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$data['users'] = $this->Audit->getAuditTrail();
		$data['notifications'] = $this->Notif->getNotifications();


		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/audit/index');
		$this->load->view('partials/footer');
	}


	public function checkLogin()
	{
		if(!$this->session->userdata('logged_in')){
			redirect('login');
			exit();
		}
	}

}
