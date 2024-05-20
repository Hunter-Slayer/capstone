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
				ORDER BY grantees.created_at DESC";
		
		$query = $this->db->query($sql);
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
