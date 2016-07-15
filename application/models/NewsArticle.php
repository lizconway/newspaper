<?php
class NewsArticle {

	private $headline;
	private $article;

	public function NewsArticle($head, $article) {
		$this->headline = $head;
		$this->article = $article;
	}

	public function getHeadline() {
		return $this->headline;
	}

	public function getArticle() {
		return $this->article;
	}
}
?>