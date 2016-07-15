<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/models/NewsArticle.php';

class News extends CI_Controller {

	function News() {
		parent::__construct();
		//$this->load->library('session');

		// Loading url helper
		$this->load->helper('url');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/index.php/news
	 *	- or -
	 * 		http://localhost/index.php/news/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/ServerSide/Workshop9
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this->load->model('news_model', '', true);
		/**
		 * Read post data from the view
		 * and save it to the database
		 */
		$headline = $this->input->post('title' ,true);
		$article = $this->input->post('details', true);
		if(isset($_POST['title']) && isset($_POST['details'])) {
// 			echo "<br>title set<br>";
			if(!empty($_POST['title']) && !empty($_POST['details'])) {
				$this->news_model->insert_news($headline, $article);
			}
		}/*  else {
			echo "<br>title <strong>not</strong> set<br>";
		} */

		$data['theNews'] = array();
		$data['arrayNews'] = array();
		$data['articleNews'] = array();

		/*
		 * Retrieve model data
		 */

		foreach($this->news_model->get_new_news() as $story) {
			/* array_push($data['headlines'], $story->title);
			array_push($data['articles'], $story->details); */
			array_push($data['theNews'], new NewsArticle($story->title, $story->details));
			$news = array('title' => $story->title, 'article' =>$story->details);
			array_push($data['arrayNews'], $news);
// 			$article = array('article' => new NewsArticle($story->title, $story->details));
// 			array_push($data['articleNews'], $article);
		}

		$this->load->library('table');

		$data['tabular'] = array();
		$data['tabular2'] = array();
		$tabularData = $this->news_model->getNewNews();
// 		var_dump($tabularData);
		/*
		 * Set up the table display
		 */
		$this->table->set_heading("ID", "Headline", "Article");
		$template = array(
				'table_open' => '<table border="1" cellpadding="4" cellspacing="0">',
				'heading_row_start' => '<tr class="head">',
				'row_alt_start' => '<tr class="stripe">'
		);

		$this->table->set_template($template);

		$newsDesk = $this->table->generate($tabularData);  // I suppose this should be $newsTable
// 		var_dump($newsDesk);
		array_push($data['tabular'], $newsDesk);

		$this->load->library('parser');

		$this->load->view('templates/news_header');
		//$this->load->view('news_items', $data);
		$this->parser->parse('news_items', $data);
		$this->load->view('templates/news_footer');

		//$this->news_model->insert_news();

	}
}
