<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter controller with database driven CKEditor inline-editing functionality.
 *
 * Replace welcome.php with this version in the application/controllers/ directory.
 */

class Welcome extends CI_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$this->update();
	}

	public function update()
	{

		if (! empty($_POST))
		{
			$query = $this->db->get_where('content', array('content_id' => $_POST['content_id']));

			// update if present, otherwise create a new row if unique ($conent_id)
			if ($query->num_rows() > 0)
			{
				$data = array(
					'date' => time(),
					'content_id' => $_POST['content_id'],
					'content' => $_POST['content']
				);

				$this->db->where('content_id', $_POST['content_id']);
				$this->db->update('content', $data);
			}
			else
			{
				$data = array(
					'id' => null,
					'date' => time(),
					'content_id' => $_POST['content_id'],
					'content' => $_POST['content']
				);

				$this->db->insert('content', $data);
			}
		}

		// set page content elements to default string
		$elements = array('title', 'editable1', 'editable2', 'editable3');
		$default = 'click to edit.';
		foreach ($elements as $element)
		{
			$view_data[$element] = $default;
		}

		// populate elements from db
		$query = $this->db->get('content');
		$data = $query->result();

		foreach ($data as $row)
		{
			if (in_array($row->content_id, $elements))
			{
				$view_data[$row->content_id] = $row->content;
			}
		}

		$this->load->view('welcome_message', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */