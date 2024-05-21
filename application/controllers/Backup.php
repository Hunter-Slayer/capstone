<?php

use Config\Database;
defined('BASEPATH') or exit('No direct script access allowed');

class Backup extends CI_Controller
{

	public function index()
	{
		$userId = $this->session->userdata('user_id');
		$data['user'] = $this->User->getUserInfo($userId);
		$this->load->view('partials/header');
		$this->load->view('partials/admin/navbar', $data);
		$this->load->view('partials/admin/sidebar', $data);
		$this->load->view('admin/backup/index');
		$this->load->view('partials/footer');
	}
	
	public function backupData()
	{
		// Load the database utility library
		$this->load->dbutil();
	
		// Get all tables in the database
		$tables = $this->db->list_tables();
	
		// Initialize an empty SQL string
		$sql = '';
	
		// Loop through each table and append its backup to the SQL string
		foreach ($tables as $table) {
			$sql .= $this->dbutil->backup(['tables' => [$table]]);
			$sql .= "\n\n"; // Add newline between table backups
		}
	
		// Convert the SQL content to plain text
		$sql = htmlspecialchars_decode($sql);
	
		// Set headers to force download the backup file
		$this->load->helper('download');
		force_download('backup.sql', $sql);

		$user_id = $this->session->userdata('user_id');
		$username = $this->session->userdata('username');

		if ($user_id) {
			// Prepare audit trail data
			$audit_data = [
				'user_id' => $user_id,
				'action' => 'Backed Database',
				'data' => json_encode(['username' => $username]), // Correctly format the data field
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			];
	

            // Insert audit trail record
            $this->Audit->insert_audit_trail($audit_data);
        }
	}
	
	
	
	
	
}

