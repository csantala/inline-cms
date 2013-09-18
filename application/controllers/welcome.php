<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter welcome controller with many additions.
 * enhanced by Chris Santala 2013.
 *
 * Primarily receives POST variables from js/ckeditor_inline.js and saves the values to the database.
 */

class Welcome extends CI_Controller
{

	public $reset_data = array(
		'title' => '<h1>Welcome to the CodeIgniter-CKEditor Inline Text Editor Demo!</h1>',
		'editable1' => '<h3>Click any block of text to edit it, click outside of the edit field to save to db.</h3>',
		'editable2' => '<p>What is this?  What\'s it good for?  This is a method to integrate the excellent CKEditor js application into CodeIgniter to allow for inline-editing of any content. Click this paragraph to see it in action! See the documentation and code at <a href="https://github.com/csantala/inline-cms">GitHub</a> to add this terrific functionality into any website.</p>
',
		'editable3' => '<p><img alt="" src="/images/awesome.jpg " style="float:left; height:74px; width:100px; margin-right:10px;" />
Labore mnesarchum conclusionemque ex vix. Vidit doming eos at, euismod mnesarchum reprimique cum ad. Nibh delicata intellegebat no quo. Pri et dico vidit honestatis, mea cu reque ubique. Vis viris quando democritum an, vim eu summo zril apeirian. Pro dicant euismod patrioque ex, laudem graece eu has, qui in velit comprehensam.</p>
'
	);

	public $elements = array('title', 'editable1', 'editable2', 'editable3');

	public function __construct ()
	{
		parent::__construct();
		$this->load->database();
	}

	// the default invocation of the welcome view sets the editable elements' content to a default setting
	// and then checks the db for any of their values & populates where found.
	public function index()
	{
		$this->update();
	}

	// resets db values with hardcoded public data above
	public function reset()
	{
		if (isset($_POST['reset']))
		{
			$i = 0;
			foreach ($this->reset_data as $element => $content)
			{
				$data = array(
					'content' => $content
				);
				error_log($this->elements[$i]);
				$this->db->where('content_id', $this->elements[$i]);
				$this->db->update('content', $data);
				$i++;
			}
		}
	}

	/**
	 * updates database with text from editable elements in the welcome view
	 * checks for POST from /js/ckeditor_inline.js
	 * sets initial value of editable inline elements to 'click to edit' and populates with matching db values
	 */
	public function update()
	{
		if (! empty($_POST))
	 	{
			$query = $this->db->get_where('content', array('content_id' => $_POST['content_id']));
			// update if present, otherwise create a new row if unique ($content_id)
			if ($query->num_rows() > 0) {
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
		$elements = $this->elements;
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