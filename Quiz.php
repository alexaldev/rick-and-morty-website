<?php

$page_title = "Quiz";
$nav_curr = "Quiz";

// number of questions to be appeared ni site
$n_questions = 2;

// number of total questions in db

// Return N unique random numbers in range min-max
function getNrandomNumbers($N, $min, $max) {

	// Optimized solution for picking few numbers from a big pool
	if (($max-$min) - $N > 200) {
		$random_arr = [];
		while (count($random_arr) < $N) {
			$random = mt_rand($min, $max);
			$random_arr[$random] = $random;
		}
		return array_values($random_arr);
	}
	// Solution for smaller scale
	else {
		$random_arr = range($min, $max);
		shuffle($random_arr);
		$random_arr = array_slice($random_arr, 0, $N);
		return $random_arr;
	}
}

function initializeQuiz($n_questions) {

	require("resources/connection.php");

	$count_ans = mysqli_query($link, "SELECT COUNT(questionID) AS num_rows FROM quiz");
	$total_num_questions = mysqli_fetch_row($count_ans)[0];
	
	$random_arr = getNrandomNumbers($n_questions, 1, $total_num_questions);

	session_start();
	$_SESSION['test'] = $random_arr[0];

	echo "<html><body><div class=quiz_question>";
	echo "<p>Random numbers: </p>";
	foreach ($random_arr as $num) {
		echo "$num; ";
	}
	echo '<p>We have a session ' . session_id() . '</p>';
	echo '<p>I give you this random number -> ' . $_SESSION['test'] . '.</p>';
	echo "</div></body></html>";
}

function check_and_reply_question() {

	session_start();
	echo "<html><body><div class=quiz_question>";
	echo '<p>Here is your random number -> ' . $_SESSION['test'] . '.</p>';
	echo "</div></body></html>";
}


function getHeadContent() {
	echo '<script type="text/javascript" src="js/quiz.js"></script>';
}

function getPageContent() {
	//echo '<p>Quiz page! (Under construction)</p>';
	//global $n_questions;

?>
		<div class='quiz_container'>
			<button type='button' id='quiz_start_button'>Start Quiz</button>
		</div>
<?php
		//initializeQuiz($n_questions);

}

if (!isset($_POST['startQuiz']) && !isset($_COOKIE['PHPSESSID']))
	include('resources/template.php');
else if (isset($_POST['startQuiz']) && $_POST['startQuiz'] == 1)
	initializeQuiz($n_questions);
else
	check_and_reply_question();

?>
