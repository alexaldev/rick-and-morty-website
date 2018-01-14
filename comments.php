<?php

$page_title = "Comments";
$nav_curr = "Comments";

function clean_string($s) {
	$s = trim($s);
	$s = addslashes($s);
	$s = mysql_real_escape_string($s);
	return $s;
}

function store_comment_in_db() {
	if (!$link)
		required("resources/connection.php");

	if (isset($_POST['comment_text']))
		$input_comment_text = clean_string($_POST['comment_text']);

	if (isset($_POST['nickname']))
		$input_nickname = clean_string($_POST['nickname']);

	if (isset($_POST['email']))
		$input_email = clean_string($_POST['email']);

	$query = "INSERT INTO customers (nickname, email, comment_text) VALUES ($input_nickname, $input_email, $input_comment_text);";

	@mysqli_query($link, $query);
//	@mysql_close($link);
}

function print_comments_from_db() {
	if (!$link)
		required("resources/connection.php");

	$query = "SELECT nickname, comment_text, datetime_created FROM comments;";

	$results = @mysqli_query($link, $query);

	while ($row = mysqli_fetch_array($results)) {
		$nickname = ($row['nickname']) ? $row['nickname'] : 'Unknown';
		echo "<div class=\"comment\">
			<div class=\"comment_header\">
				<p>$nickname said on $row['datetime_created']:</p>
			</div>
			<div class=\"comment_body\">
				<p>$row['comment_text']</p>
			</div>
		</div>";
	}

}

function getPageContent() {

	if (isset($_POST['comment_text'])) {
		store_comment_in_db();
	}

	echo '<div id="comments_view">
		<h2>Comments for this site</h2>';

	print_comments_from_db();

	echo '</div>';

	echo '<div id="comment_form">
		<h3>Submit a comment</h3>
		<form method="post" action="">
		<label for="nickname">Nickname:</label>
		<input id="nickname" type="text" name="nickname" placeholder="<your nickname> (optional)">
		
		<label for="email">Email:</label>
		<input id="email" type="email" name="email" placeholder="<your email> (optional)"><br>
		
		<label for="comment_text">Comment:</label><br>
		<textarea required id="comment_text" name="comment_text" rows="5" cols="80" placeholder="Your comment goes here..."></textarea><br>
		<input type="submit" value="Submit Comment">
		<!--<input type="reset" value="Reset values">-->
		</form>
		</div>';
}

include('resources/template.php');

?>
