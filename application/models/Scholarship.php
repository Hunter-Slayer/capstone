<?php

class Scholarship extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getScholarships()
	{
		$sql = "SELECT scholarship.id, scholarship.name, scholarship.code, scholarship.status, scholarship.type
				FROM scholarship 
				ORDER BY scholarship.created_at DESC";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	
	public function insertScholarship($data) {
        $this->db->insert('scholarship', $data);
    }

	public function getScholar($scholarId)
	{
		$sql = "SELECT * FROM scholarship 
		WHERE id = ?";
		
		$query = $this->db->query($sql, array($scholarId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function updateScholar($scholarId, $data)
	{
		$this->db->where('id', $scholarId);
		$this->db->update('scholarship', $data);
	}
	
	public function getScholarType($type1)
	{
		$sql = "SELECT scholarship.id, scholarship.name
				FROM scholarship
				WHERE type = ?";
		$query = $this->db->query($sql, array($type1));
		return $query->result_array();    
	}

	public function totalGovernmentScholarships()
    {
        // Custom SQL query to count scholarships where type = 0
        $query = $this->db->query("SELECT COUNT(*) AS totalGovScholar FROM scholarship WHERE type = 0");
        $result = $query->row();
        return $result->totalGovScholar;
    }
	

	public function totalPrivateScholarships()
    {
        // Custom SQL query to count scholarships where type = 0
        $query = $this->db->query("SELECT COUNT(*) AS totalPrivateScholar FROM scholarship WHERE type = 1");
        $result = $query->row();
        return $result->totalPrivateScholar;
    }

	public function totalActiveGovernmentScholar()
    {
        // Custom SQL query to count scholarships where type = 0
        $query = $this->db->query("SELECT COUNT(*) AS totalGovScholar FROM scholarship WHERE type = 0 AND status = 0");
        $result = $query->row();
        return $result->totalGovScholar;
    }


	public function totalActivePrivateScholar()
    {
        // Custom SQL query to count scholarships where type = 0
        $query = $this->db->query("SELECT COUNT(*) AS totalGovScholar FROM scholarship WHERE type = 1 AND status = 0");
        $result = $query->row();
        return $result->totalGovScholar;
    }


	// Coungint grantess
	public function totalGovernmentStudent()
    {
        // Custom SQL query to count scholarships where type = 0
        $query = $this->db->query("SELECT COUNT(*) AS totalGovStudent FROM grantees WHERE status = 0");
        $result = $query->row();
        return $result->totalGovStudent;
    }

	public function totalPrivateStudent()
    {
        // Custom SQL query to count scholarships where type = 0
        $query = $this->db->query("SELECT COUNT(*) AS totalGovScholar FROM scholarship WHERE status = 1");
        $result = $query->row();
        return $result->totalGovScholar;
    }


	// Bar Chart
	public function getCampusStudentCounts($scholarship_id = null, $school_year = null)
	{
		$sql = "SELECT 
				campus.name AS campus_name, 
				COUNT(grantees.student_id) AS student_count
			FROM 
				campus
			LEFT JOIN 
				students ON students.campus_id = campus.id
			LEFT JOIN 
				grantees ON grantees.student_id = students.id
			WHERE 
				1 = 1
		";
	
		if ($scholarship_id) {
			$sql .= " AND grantees.scholarship_id = " . $this->db->escape($scholarship_id);
		}
	
		if ($school_year) {
			$sql .= " AND grantees.school_year = " . $this->db->escape($school_year);
		}
	
		$sql .= " GROUP BY campus.name";
	
		$query = $this->db->query($sql);
		return $query->result();
	}
	

}
