<?php

$page_title = "Comments";
$nav_curr = "Comments";
$num_comments_in_page = 10;

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
	if (mysqli_errno() != 0)
		error_log('MYSQL ANSWER ERROR:' . mysqli_error($mysql_link));
//	@mysql_close($link);
}

function print_comments_from_db($mysql_link, $comments_in_page) {

	$count_ans = mysqli_query($mysql_link, "SELECT COUNT(commentID) AS num_rows FROM comments");
	$num_comments = mysqli_fetch_object($count_ans)->num_rows;
	$num_of_pages = ceil($num_comments / $comments_in_page);

	if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0)
		$page = ($_GET['page'] < $num_of_pages) ? (int) $_GET['page'] : $num_of_pages;
	else
		$page = 1;

	$n = (($page-1) * $comments_in_page);

	$query = "SELECT nickname, comment_text, datetime_created 
				FROM comments 
				ORDER BY datetime_created DESC
				LIMIT $n,$comments_in_page;";

	$results = mysqli_query($mysql_link, $query);

	printPageNavigator($page, $num_of_pages, 'up');

	while ($row = mysqli_fetch_array($results)) {
		$nickname = ($row['nickname']) ? htmlspecialchars($row['nickname']) : "Unknown";
		$datime = $row['datetime_created'];
		$comment_text = htmlspecialchars(stripslashes($row['comment_text']));

?>
		<div class="comment">
			<div class="comment_header">
				<p><?php echo "$nickname said on $datime:" ?></p>
			</div>
			<div class=\"comment_body\">
				<pre> <?php echo "$comment_text" ?> </pre>
			</div>
		</div>
<?php
	}
	printPageNavigator($page, $num_of_pages, 'bottom');
}

function printPageNavigator($page, $num_of_pages, $extra_class) {
	echo '<div class="pages ' . $extra_class . '">';
	echo '<span>Pages:&nbsp;</span>';
	for ($i = 1; $i <= $num_of_pages; $i++)
		if ($page == $i)
			echo "<span>$i&nbsp;</span>";
		else
			echo "<a class=\"page_num\" href ='?page=$i'>$i</a>&nbsp;";
	echo '</div>';
}

function getHeadContent() {	
	echo '<script type="text/javascript" src="js/comments_ajax_go_to_page.js"></script>';
}

function getPageContent() {

	require("resources/connection.php");

	global $num_comments_in_page;

	if (isset($_POST['comment_text'])) {
		store_comment_in_db($link);
	}

	echo '<div id="comments_view">
		<h2>Comments for this site</h2>';

	print_comments_from_db($link, $num_comments_in_page);

	mysqli_close($link);
?>
	</div>

	<div id="comment_form">
		<h3>Submit a comment</h3>
		<form method="post" action="">
		<label for="nickname">Nickname:</label>
		<input id="nickname" type="text" name="nickname" placeholder="(optional)">
		
		<label for="email">Email:</label>
		<input id="email" type="email" name="email" placeholder="(optional)"><br>
		
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
