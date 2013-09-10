<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $reset_data = array(
		'title' => '<h1>Welcome to the Codeigniter-CKEditor Inline Text Editor Demo!</h1>',
		'editable1' => '<h3>Click to edit any paragraph, click outside of the edit to save to db.</h3>',
		'editable2' => '<p>Te tota aeque nobis vix, exerci libris equidem id ius, debitis alienum nam et. No illum mentitum pri, pro legimus tractatos consulatu et. Et eos oratio putant reformidans, vix fierent conceptam ex, ea eam nobis elaboraret. Duo tantas assentior ne, altera virtute repudiare nam ei. Vel nibh tincidunt id, cibo adipisci ne vel. Quaeque constituam theophrastus ei nam, cum ex exerci pertinax.</p>
',
		'editable3' => '<p><img alt="" src="http://vibrationofawesome.com/wp-content/uploads/2013/02/i_awesome6.jpg " style="float:left; height:74px; width:100px; margin-right:10px;" />
Labore mnesarchum conclusionemque ex vix. Vidit doming eos at, euismod mnesarchum reprimique cum ad. Nibh delicata intellegebat no quo. Pri et dico vidit honestatis, mea cu reque ubique. Vis viris quando democritum an, vim eu summo zril apeirian. Pro dicant euismod patrioque ex, laudem graece eu has, qui in velit comprehensam.</p>
'
	);

	public $elements = array('title', 'editable1', 'editable2', 'editable3');

	public function __construct () {
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$this->update();
	}

	public function reset()
	{
		if (! empty($_POST)) {
			if ($_POST['reset']) {
				$i = 0;
				foreach ($this->reset_data as $element => $content) {
					$data = array(
						'content' => $content
					);
					error_log($this->elements[$i]);
					$this->db->where('content_id', $this->elements[$i]);
					$this->db->update('content', $data);
					$i++;
				}

			//	$this->db->update('content', $data);
			//	error_log('insert!');
			}
		}
	}

	public function update() {

		if (! empty($_POST)) {
			$query = $this->db->get_where('content', array('content_id' => $_POST['content_id']));

			// update if present, otherwise create a new row if unique ($conent_id)
			if ($query->num_rows() > 0) {
				$data = array(
					'date' => time(),
					'content_id' => $_POST['content_id'],
					'content' => $_POST['content']
				);

				$this->db->where('content_id', $_POST['content_id']);
				$this->db->update('content', $data);

			} else {
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
		foreach ($elements as $element) {
			$view_data[$element] = $default;
		}

		// populate elements from db
		$query = $this->db->get('content');
		$data = $query->result();

		foreach ($data as $row) {
			if (in_array($row->content_id, $elements)) {
				$view_data[$row->content_id] = $row->content;
			}
		}

		$this->load->view('welcome_message', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */