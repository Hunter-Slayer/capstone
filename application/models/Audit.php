<?php

class Audit extends CI_Model {

    public function insert_audit_trail($data) {
        $this->db->insert('audit_trail', $data);
    }
}
