<?php

class Grant extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function insertGrantee($data)
    {
        return $this->db->insert('grantees', $data);
    }
	public function getGrantees() 
	{

		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
		// Assuming that the campus_id for the current user is stored in a session variable or can be retrieved from the database
		$campusId = $this->session->userdata('campus_id');

		$sql = "SELECT grantees.id AS granteeId, 
					   CONCAT(students.first_name, ' ', students.last_name) AS fullName,
					   grantees.*, 
					   scholarship.name AS scholarName, 
					   scholarship.id AS scholarId,
					   students.id AS studentId,
					   students.student_id AS studentRefference,
					   students.status AS studentStatus,
					   campus.name AS campusName
				FROM grantees 
				LEFT JOIN students ON students.id = grantees.student_id
				LEFT JOIN scholarship ON scholarship.id = grantees.scholarship_id
				LEFT JOIN campus ON campus.id = students.campus_id
				WHERE students.campus_id = ? OR ? = 0
				ORDER BY grantees.created_at ASC";
		
		$query = $this->db->query($sql, array($role,$role));
		return $query->result_array();
	}
	


	public function getGrant($granteeId)
	{
		$sql = "SELECT * FROM grantees 
		LEFT JOIN students ON grantees.student_id = students.id
		LEFT JOIN scholarship ON  grantees.scholarship_id = scholarship.id 

		WHERE grantees.id = ?";
		
		$query = $this->db->query($sql, array($granteeId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}
	
}
