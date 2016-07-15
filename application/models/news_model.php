<?php
class News_Model extends CI_Model {
	var $title = '';
	var $details = '';
	//var $date = '';

	function News_Model() {
		// Call the Model constructor
		parent::__construct();
	}

	function get_new_news() {
		$query = $this->db->get('news');
		/* echo "<h1>News items from DB :</h1>";
		var_dump($query->result()); */
		return $query->result();

// 		return "Something Kool";
	}

	function insert_news($title, $details) {
// 		$this->title = "Some News";
// 		$this->details = "Here is some news, woot!";
		$this->title = $title;
		$this->details = $details;

		$this->db->insert('news', $this);
	}
}
?>