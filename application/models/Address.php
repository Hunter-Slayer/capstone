<?php

class Address extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	public function getProvince()
	{
		$sql = "SELECT province_id, provCode, provDesc
				FROM province
				WHERE regCode = ?";
		$query = $this->db->query($sql, array('01'));
		return $query->result_array();    
	}

	public function getMunicipalityByProvince($province_id)
		{
			$sql = "SELECT citymunCode, citymunDesc
					FROM municipality
					WHERE provCode = ?";
			$query = $this->db->query($sql, array($province_id));
			return $query->result_array();    
		}

		public function getBarangayByMunicipality($municipality_id)
		{
			$sql = "SELECT brgyCode, brgyDesc
					FROM barangay
					WHERE citymunCode = ?";
			$query = $this->db->query($sql, array($municipality_id));
			return $query->result_array();    
		}

}


