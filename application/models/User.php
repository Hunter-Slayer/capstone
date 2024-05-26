<?php

class User extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	
	public function getUsers()
	{
		$sql = "SELECT users.*, users.id AS userId, users.name AS nameUser, user_types.name AS userTypeName, campus.name AS campusName
				FROM users
				LEFT JOIN user_types ON users.type_id = user_types.id
				LEFT JOIN campus ON users.campus_id = campus.id
				ORDER BY users.created_at ASC";
	
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

	public function getUser($userId)
	{
		$sql = "SELECT * FROM users 
		WHERE id = ?";
		
		$query = $this->db->query($sql, array($userId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function updateUser($data, $userId)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $data);

        if ($this->db->affected_rows() > 0) {
            return true; 
        } else {
            return false; 
        }
    }

	// Login
	public function check_credentials($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row_array();

            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false; 
    }

	public function getUserInfo($userId)
	{
		$sql = "SELECT users.id, users.name AS usersFullName, user_types.name as userTypeName, campus.name as campusName, users.type_id, users.campus_id as campusType
				FROM users
				LEFT JOIN user_types ON users.type_id = user_types.id
				LEFT JOIN campus ON users.campus_id = campus.id
				WHERE users.id = ?";

		$query = $this->db->query($sql, array($userId));

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function getUserRole($userId)
	{
		$sql = "SELECT users.campus_id 
		FROM users
		WHERE users.id = ?";
		
		$query = $this->db->query($sql, array($userId));
		
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}

	public function getUserDetails($userId) {
		$sql = "SELECT users.type_id AS userType, users.campus_id
				FROM users
				WHERE users.id = ?";
	
		$query = $this->db->query($sql, array($userId));
	
		if ($query->num_rows() > 0) {
			$userData = $query->row_array();
			return $userData; // Return the user data array directly
		} else {
			return null; // Or return an empty array if no user found
		}
	}
}
