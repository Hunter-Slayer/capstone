<?php

class UserType extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function getUsersType()
	{
		$sql = "SELECT * FROM user_types
				ORDER BY user_types.created_at DESC";
	
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
