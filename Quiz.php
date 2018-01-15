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
		return array_slice($random_arr, 0, $N);
	}
}

function showQuiz() {

	require("resources/connection.php");

	$count_ans = mysqli_query($mysql_link, "SELECT COUNT(questionID) AS num_rows FROM quiz");
	$total_num_questions = mysqli_fetch_object($count_ans)->num_rows;

	$random_arr = getNrandomNumbers($n_questions, 0, $total_num_questions);

	session_start();
	echo '<p>We have a session</p>';


}

function getPageContent() {
	echo '<p>Quiz page! (Under construction)</p>';
	showQuiz();
}

include('resources/template.php');

?>
