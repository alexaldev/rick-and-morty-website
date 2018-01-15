<?php

$page_title = "Comments";
$nav_curr = "Comments";

function clean_string($mysql_link, $s) {
	global $link;

	$s = trim($s);
	$s = addslashes($s);
	$s = mysqli_real_escape_string($mysql_link, $s);
	return $s;
}

function store_comment_in_db($mysql_link) {
	if (isset($_POST['comment_text']))
		$input_comment_text = clean_string($mysql_link, $_POST['comment_text']);

	$input_nickname = (isset($_POST['nickname'])) ? clean_string($mysql_link, $_POST['nickname']) : "NULL";

	$input_email = (isset($_POST['email'])) ? clean_string($mysql_link, $_POST['email']) : "NULL";

	$query = "INSERT INTO comments (nickname, email, comment_text) VALUES ('$input_nickname', '$input_email', '$input_comment_text');";

	mysqli_query($mysql_link, $query);
	error_log('MYSQL ANSWER' . mysqli_error($mysql_link));
//	@mysql_close($link);
}

function print_comments_from_db($mysql_link) {
	$query = "SELECT nickname, comment_text, datetime_created FROM comments ORDER BY datetime_created DESC;";

	$results = mysqli_query($mysql_link, $query);

	while ($row = mysqli_fetch_array($results)) {
		$nickname = ($row['nickname']) ? htmlspecialchars($row['nickname']) : "Unknown";
		$datime = $row['datetime_created'];
		$comment_text = htmlspecialchars($row['comment_text']);

?>
		<div class="comment">
			<div class="comment_header">
				<p><?php echo "$nickname said on $datime:" ?></p>
			</div>
			<div class=\"comment_body\">
				<p> <?php echo "$comment_text" ?> </p>
			</div>
		</div>
<?php
	}

}

function getPageContent() {

	require("resources/connection.php");

	if (isset($_POST['comment_text'])) {
		store_comment_in_db($link);
	}

	echo '<div id="comments_view">
		<h2>Comments for this site</h2>';

	print_comments_from_db($link);

	mysqli_close($link);
?>
	</div>

	<div id="comment_form">
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
	</div>
<?php
}

include('resources/template.php');

?>
