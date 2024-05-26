<?php

class Audit extends CI_Model {

    public function insert_audit_trail($data) {
        $this->db->insert('audit_trail', $data);
    }
	public function __construct()
	{
		$this->load->database();
	}

	public function getAuditTrail() {

        $sql = "SELECT audit_trail.*, users.id, users.name AS usersName, user_types.name As userTypeName, campus.name AS campusName 
			FROM audit_trail
			LEFT JOIN users ON users.id = audit_trail.user_id
			LEFT JOIN user_types ON user_types.user_type = users.type_id
			LEFT JOIN campus ON campus.id = users.campus_id
			ORDER BY audit_trail.created_at DESC";

        $query = $this->db->query($sql);
        return $query->result_array();
	}

}
