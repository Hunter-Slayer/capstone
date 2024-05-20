<?php

class Course extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getCourses()
	{
		$sql = "SELECT courses.id AS courseId, courses.name, courses.status, courses.campus_id, campus.name as CampusName
				FROM courses 
				LEFT JOIN campus
				ON campus.id = courses.campus_id
				ORDER BY courses.created_at DESC";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveCourses()
	{
		$sql = "SELECT courses.id AS courseId, courses.name, courses.status, courses.campus_id
				FROM courses 
				WHERE courses.status = ?
				ORDER BY courses.created_at DESC";
		
		$query = $this->db->query($sql, array(0));
		return $query->result_array();
	}



	public function insertCourse($data) {
        $this->db->insert('courses', $data);
    }

	public function getCourse($courseId)
	{
		$sql = "SELECT * FROM courses 
		WHERE id = ?";
		
		$query = $this->db->query($sql, array($courseId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function updateCourse($courseId, $data)
	{
		$this->db->where('id', $courseId);
		$this->db->update('courses', $data);
	}
	
	// Course filtering
	public function getCourseByCampus($campus_id)
	{
		$sql = "SELECT courses.id, courses.name
				FROM courses
				WHERE campus_id = ?";
		$query = $this->db->query($sql, array($campus_id));
		return $query->result_array();    
	}
	
}
