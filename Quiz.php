<?php

$page_title = "Quiz";
$nav_curr = "Quiz";

// number of questions to be appeared ni site
$n_questions = 2;

// number of total questions in db

// Return N unique random numbers in range min-max
function getNrandomNumbers($N, $min, $max) { //EDW XREIAZETAI MALLON -1 AMA BUGGAREI TO KANOYME -1

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

function showQuiz() {

	require("resources/connection.php");

	$count_ans = mysqli_query($link, "SELECT COUNT(questionID) AS num_rows FROM quiz");
	$total_num_questions = mysqli_fetch_row($count_ans)[0];
	
	$random_arr = getNrandomNumbers($n_questions, 1, $total_num_questions);

	echo "<p>Random numbers: </p>";
	foreach ($random_arr as $num) {
		echo "$num; ";
	}

	session_start();
	$_SESSION['test'] = $random_arr[0];
	echo '<p>We have a session</p>';
	echo '<p>Here is your random number -> ' . $_SESSION['test'] . '.</p>';

}

function getPageContent() {
	echo '<p>Quiz page! (Under construction)</p>';
	showQuiz();
}

include('resources/template.php');

?>
