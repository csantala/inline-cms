<?php

	class Stats_model extends CI_Model
	{

		var $time   	= '';
		var $referer 	= '';
		var $page    	= '';
		var $browser 	= '';
		var $os		 	= '';
		var $ip			= '';

		function count_entries()
		{
			return $this->db->count_all_results('stats');
		}

		function get_entries($limit = NULL, $offset = NULL)
		{
			$this->db->order_by("id", "desc");
			$query = $this->db->get('stats', $limit, $offset);
			return $query->result();
		 }

		function insert_entry()
		{
			$this->title = $data['time'];
			$this->db->insert('entries', $this);
		}
	}