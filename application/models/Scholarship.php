<?php

use DB;

class Scholarship extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getScholarships()
	{
		$sql = "SELECT scholarship.id, scholarship.name, scholarship.code, scholarship.status, scholarship.type
				FROM scholarship 
				ORDER BY scholarship.name ASC";
		
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


	// Start


	public function totalGovernmentScholarships()
    {
        // Custom SQL query to count scholarships where type = 0
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);

        $query = $this->db->query("SELECT COUNT(*) AS totalGovScholar FROM scholarship 
		
		WHERE type = 0");
        $result = $query->row();
        return $result->totalGovScholar;
    }


	// filter government
		public function getGovernment()
		{
		$sql = "SELECT scholarship.id, scholarship.name, scholarship.code, 
				scholarship.status, scholarship.type
				FROM scholarship 
				WHERE type = 0
				ORDER BY scholarship.name ASC";

		$query = $this->db->query($sql);
		return $query->result_array();
		}
		public function getActiveGovernment()
		{
			$sql = "SELECT scholarship.id, scholarship.name, scholarship.code, 
			scholarship.status, scholarship.type
			FROM scholarship 
			WHERE type = 0 AND status = 0
			ORDER BY scholarship.name ASC";

			$query = $this->db->query($sql);
			return $query->result_array();
		}
	// private filter function
		public function getPrivate()
		{
		$sql = "SELECT scholarship.id, scholarship.name, scholarship.code, 
				scholarship.status, scholarship.type
				FROM scholarship 
				WHERE type = 1
				ORDER BY scholarship.name ASC";

		$query = $this->db->query($sql);
		return $query->result_array();
		}
		public function getActivePrivate()
		{
		$sql = "SELECT scholarship.id, scholarship.name, scholarship.code, 
				scholarship.status, scholarship.type
				FROM scholarship 
				WHERE type = 1 AND status = 0
				ORDER BY scholarship.name ASC";

		$query = $this->db->query($sql);
		return $query->result_array();
		}
	// end

	

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
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
	
		// Assuming that the campus_id for the current user is stored in a session variable or can be retrieved from the database
		$campusId = $this->session->userdata('campus_id');
	
		// Adjust the query to handle role and campus_id correctly
		$sql = "
			SELECT COUNT(*) AS totalGovStudent
			FROM grantees g
			LEFT JOIN scholarship s ON g.scholarship_id = s.id
			LEFT JOIN students st ON st.id = g.student_id
			WHERE s.type = 0 AND g.status = 0 AND 
			(st.campus_id = ? OR ? = 0)
		";
	
		$query = $this->db->query($sql, array($role, $role));
		$result = $query->row();
		return $result->totalGovStudent;
	}
	

	public function totalPrivateStudent()
	{
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
	
		// Assuming that the campus_id for the current user is stored in a session variable or can be retrieved from the database
		$campusId = $this->session->userdata('campus_id');
	
		// Adjust the query to handle role and campus_id correctly
		$sql = "
			SELECT COUNT(*) AS totalPrivateStudent
			FROM grantees g
			LEFT JOIN scholarship s ON g.scholarship_id = s.id
			LEFT JOIN students st ON st.id = g.student_id
			WHERE s.type = 1 AND g.status = 0 AND 
			(st.campus_id = ? OR ? = 0)
		";
	
		$query = $this->db->query($sql, array($role, $role));
		$result = $query->row();
		return $result->totalPrivateStudent;
	}
	


	// Bar Chart
	public function getCampusStudentCounts($scholarship_id = null, $school_year = null)
	{
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);

		$sql = "SELECT 
				campus.name AS campus_name, 
				COUNT(grantees.student_id) AS student_count
			FROM 
				campus
			LEFT JOIN 
				students ON students.campus_id = campus.id
			LEFT JOIN 
				grantees ON grantees.student_id = students.id
			WHERE (? = 0 OR students.campus_id = ?) ";
	
		if ($scholarship_id) {
			$sql .= " AND grantees.scholarship_id = " . $this->db->escape($scholarship_id);
		}
	
		if ($school_year) {
			$sql .= " AND grantees.school_year = " . $this->db->escape($school_year);
		}
	
		$sql .= " GROUP BY campus.name";
	
		$query = $this->db->query($sql, array($role, $role));
		return $query->result();
	}


	public function getCampusData() {
		$selectedScholarshipType = $this->input->post('type1'); // Access form data
		$selectedYear = $this->input->post('school_year');
	  
		$userId = $this->session->userdata('user_id'); // Get user ID from session
		$campusId = $this->session->userdata('campus_id');
	  
		// Filter based on user's campus
		$this->db->where('students.campus', $campusId); // Replace 'userId' with appropriate field for user's campus
	  
		// Build the query with joins, filtering, and grouping
		$studentsCount = $this->db->select([
		  'scholarship_name.codeName AS label',
		  D# Import the 'DB' module if it exists
from module_name import DB

# Or define the 'DB' type if it doesn't exist
class DB:
    # Add DB class implementation here

# Use the 'DB' type as needed in your codeB::raw('COUNT(*) AS data')
		])
		->from('grantees')
		->join('scholarship_name', 'grantees.scholarship_name', '=', 'scholarship_name.id')
		->join('students', 'grantees.student_id', '=', 'students.id')
		->where('grantees.scholarship_type', $selectedScholarshipType)
		->where('grantees.school_year', $selectedYear)
		->group_by('scholarship_name.codeName')
		->get();
	  
		// Handle potential query errors (optional)
		if ($studentsCount->num_rows() === 0) {
		  return []; // Return empty array if no results found (optional)
		}
	  
		$results = $studentsCount->result_array();
	  
		return json_encode($results); // Convert to JSON for response
	  }
	  




	

}
