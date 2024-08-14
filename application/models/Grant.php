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
				CONCAT( barangay.brgyDesc, ' ', municipality.citymunDesc, ' ', province.provDesc ) AS studentAddress,
				grantees.*, 
				scholarship.name AS scholarName, 
				scholarship.id AS scholarId,
				scholarship.type AS studentType,
				students.id AS studentId,
				students.student_id AS studentReference,
				students.gender,
				students.civil_status,
				students.year_level,
				campus.name AS campusName
		FROM grantees 
		LEFT JOIN students ON students.id = grantees.student_id
		LEFT JOIN scholarship ON scholarship.id = grantees.scholarship_id
		LEFT JOIN campus ON campus.id = students.campus_id
		LEFT JOIN province ON students.province_id = province.provCode
		LEFT JOIN municipality ON students.municipal_id = municipality.citymunCode
		LEFT JOIN barangay ON students.barangay_id = barangay.brgyCode
		WHERE students.campus_id = ? OR ? = 0 AND grantees.status = 0
		ORDER BY grantees.created_at ASC
		";
		
		$query = $this->db->query($sql, array($role,$role));
		return $query->result_array();
	}


	// filter
	// gov

	public function filterGov()
	{
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
		// Assuming that the campus_id for the current user is stored in a session variable or can be retrieved from the database
		$campusId = $this->session->userdata('campus_id');

		$sql = "SELECT grantees.id AS granteeId, 
                       CONCAT(students.first_name,' ', students.last_name) AS fullName,
					   CONCAT( barangay.brgyDesc, ' ', municipality.citymunDesc, ' ', province.provDesc ) AS studentAddress,
                       grantees.*, 
                       scholarship.name AS scholarName, 
                       scholarship.id AS scholarId,
					   scholarship.type AS studentType,
                       students.id AS studentId,
					   students.student_id AS studentReference,
					   students.gender,
					   students.civil_status,
					   students.year_level,
                       campus.name AS campusName
					   FROM grantees
					   LEFT JOIN scholarship ON scholarship.id = grantees.scholarship_id
					   LEFT JOIN students ON students.id = grantees.student_id
					   LEFT JOIN campus ON campus.id = students.campus_id
					   LEFT JOIN province ON students.province_id = province.provCode
						LEFT JOIN municipality ON students.municipal_id = municipality.citymunCode
						LEFT JOIN barangay ON students.barangay_id = barangay.brgyCode
					   WHERE( students.campus_id = ? OR ? = 0)
					   AND scholarship.type = 0
					   AND grantees.status = 0
					   ORDER BY grantees.created_at ASC";

        $query = $this->db->query($sql, array($role,$role));
		return $query->result_array();

	}

	
// private
public function filterPrivate()
	{
		$userId = $this->session->userdata('user_id');
		$role = $this->User->getUserRole($userId);
		// Assuming that the campus_id for the current user is stored in a session variable or can be retrieved from the database
		$campusId = $this->session->userdata('campus_id');

		$sql = "SELECT grantees.id AS granteeId, 
                       CONCAT(students.first_name,' ', students.last_name) AS fullName,
					   CONCAT( barangay.brgyDesc, ' ', municipality.citymunDesc, ' ', province.provDesc ) AS studentAddress,
                       grantees.*, 
                       scholarship.name AS scholarName, 
                       scholarship.id AS scholarId,
					   scholarship.type AS studentType,
                       students.id AS studentId,
					   students.student_id AS studentReference,
					   students.gender,
					   students.civil_status,
					   students.year_level,
                       campus.name AS campusName
					   FROM grantees
					   LEFT JOIN scholarship ON scholarship.id = grantees.scholarship_id
					   LEFT JOIN students ON students.id = grantees.student_id
					   LEFT JOIN campus ON campus.id = students.campus_id
					   LEFT JOIN province ON students.province_id = province.provCode
						LEFT JOIN municipality ON students.municipal_id = municipality.citymunCode
						LEFT JOIN barangay ON students.barangay_id = barangay.brgyCode
					   WHERE (students.campus_id = ? OR ? = 0)
					   AND scholarship.type = 1
					   AND grantees.status = 0
					   ORDER BY grantees.created_at ASC";

        $query = $this->db->query($sql, array($role,$role));
		return $query->result_array();

	}
	// end
	
	public function countScholarships($studentId)
	{
		$this->db->where('student_id', $studentId);
		$this->db->from('grantees');
		return $this->db->count_all_results();
	}
	

	public function getGrant($granteeId)
	{
		$sql = "SELECT grantees.*, students.*, scholarship.id as scholarship_id, scholarship.name as scholarship_name, scholarship.type as scholarship_type, courses.name as courses_name,
					campus.description AS campusName
				FROM grantees
				LEFT JOIN students ON grantees.student_id = students.id
				LEFT JOIN scholarship ON grantees.scholarship_id = scholarship.id
				LEFT JOIN courses ON students.course_id = courses.id
				LEFT JOIN campus ON students.campus_id = campus.id
				WHERE grantees.id = ?";

		$query = $this->db->query($sql, array($granteeId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function update_status($granteeId, $status) {
        $data = array('status' => $status);
        $this->db->where('student_id', $granteeId);
        return $this->db->update('grantees', $data);
    }

    public function get_student_reference_by_grantee_id($granteeId) {
        $this->db->select('studentReference');
        $this->db->from('grantees');
        $this->db->where('student_id', $granteeId);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row()->studentReference;
        }
        return false;
    }
	
}
