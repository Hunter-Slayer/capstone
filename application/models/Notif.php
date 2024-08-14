<?php

use Carbon\Carbon;

class Notif extends CI_Model {

	public function insertNotification($data) {
        $this->db->insert('notifications', $data);
    }

	public function getGroupedNotifications($userId)
    {
        $this->db->select('data, COUNT(*) as count');
		$this->db->where('DATE(created_at)', Carbon::today()->toDateString());
        $this->db->group_by('data');
        $query = $this->db->get('notifications');
        return $query->result_array();
    }

	public function getNotifications()
	{
		$userId = $this->session->userdata('user_id');
		$notifications = $this->Notif->getGroupedNotifications($userId);
		return $notifications;
	}
}
