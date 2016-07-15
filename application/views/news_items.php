<?php
include_once 'application/models/NewsArticle.php';

/* foreach($theNews as $newsItem) {
	echo "<div id='container'>";
	//$title = $newsItem->getHeadline();
	//$detail = $newsItem->getArticle();
	echo "<h1>".$newsItem->getHeadline()."</h1>";
	echo "<p>".$newsItem->getArticle()."</p>";
	echo "</div>";
} */

?>
<!-- <br />
<hr> -->
<h1>Not the 6 o'clock News</h1>
{arrayNews}
<div id="container">
	<h3>{title}</h3>
	<p>{article}</p>
</div>
{/arrayNews}
<br />
<hr>
<!-- <h1>Object Parsed News</h1>
{articleNews}
<div id="container">
<?php //var_dump({article});?>
	<h3>{article}</h3>
	<p>{article}</p>
</div>
{/articleNews}
 -->

 <?php
 $this->load->helper('form');

 echo form_fieldset('Add News');
 echo form_open('');
 echo "Title :".form_input('title');
 echo "Details :".form_input('details');
 echo form_submit('mysubmit', 'Submit Post!');
 echo form_reset('myreset', 'Clear Form fields!');
 echo form_fieldset_close();

 ?>