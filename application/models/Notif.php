<?php

class Notif extends CI_Model {

	public function insertNotification($data) {
        $this->db->insert('notifications', $data);
    }
}
