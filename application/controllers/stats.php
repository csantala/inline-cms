<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stats extends CI_Controller
{

	// access stats via [domain]/stats/tracker
	public function tracker()
	{

		// alternatively, place these calls into autoload
		$this->load->database();
		$this->load->library('pagination');
		$this->load->model('stats_model');

		// results per page
		$per_page = 40;

		$config = array();
	    $config["uri_segment"] = 3;
		$config['base_url'] = '/stats/tracker';
		$config['total_rows'] = $this->stats_model->count_entries();
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '3';

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();

		$stats = $this->stats_model->get_entries($per_page, $this->uri->segment(3));

		$view_data = array
			(
				'stats' => $stats,
				'pagination' => $pagination
			);
		$this->load->view('stats_view', $view_data);
	}
}