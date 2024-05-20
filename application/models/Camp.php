<?php

class Camp extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getCampus()
	{
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
		$sql = "SELECT campus.id, campus.name, campus.description, campus.status
				FROM campus
				WHERE campus.id = IF(? = 0, campus.id, ?)
				ORDER BY campus.created_at DESC";
	
		$query = $this->db->query($sql, array($role, $role));
		return $query->result_array();
	}
	

	public function getActiveCampus()
	{
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
	
		$sql = "SELECT campus.id, campus.name
				FROM campus
				WHERE campus.status = ?
				AND campus.id = IF(? = 0, campus.id, ?)
				ORDER BY campus.created_at DESC";
	
		$query = $this->db->query($sql, array(0, $role, $role));
		return $query->result_array();
	}
	
	
	public function insertCampus($data) {
        $this->db->insert('campus', $data);
    }

	public function getSingleCampus($scholarId)
	{
		$sql = "SELECT * FROM campus 
		WHERE id = ?";
		
		$query = $this->db->query($sql, array($scholarId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function updateCampus($campusId, $data)
	{
		$this->db->where('id', $campusId);
		$this->db->update('campus', $data);
	}
	
	
}
