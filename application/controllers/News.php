<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/models/NewsArticle.php';

class News extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://localhost/index.php/news
	 *	- or -
	 * 		http://localhost/index.php/news/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://localhost/ServerSide/Workshop7
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
		$this->news_model->insert_news($headline, $article);

		$data['theNews'] = array();
		$data['arrayNews'] = array();
		$data['articleNews'] = array();

		foreach($this->news_model->get_new_news() as $story) {
			/* array_push($data['headlines'], $story->title);
			array_push($data['articles'], $story->details); */
			array_push($data['theNews'], new NewsArticle($story->title, $story->details));
			$news = array('title' => $story->title, 'article' =>$story->details);
			array_push($data['arrayNews'], $news);
// 			$article = array('article' => new NewsArticle($story->title, $story->details));
// 			array_push($data['articleNews'], $article);
		}

		$this->load->library('parser');

		$this->load->view('templates/news_header');
		//$this->load->view('news_items', $data);
		$this->parser->parse('news_items', $data);
		$this->load->view('templates/news_footer');

		//$this->news_model->insert_news();

	}
}
