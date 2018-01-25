<?php

$page_title = "Quiz";
$nav_curr = "Quiz";

// number of questions to be appeared ni site
$n_questions = 5;

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

	unset($_SESSION['quiz_terminated']);
	$_SESSION['rand_nums'] = $random_arr;
	$_SESSION['right_answers'] = array();

	echo "<html><body>";
	generate_question();
	echo "</body></html>";
/*
	echo "<html><body><div class=quiz_question>";

	echo "<p>Random numbers: </p>";
	foreach ($random_arr as $num) {
		echo "$num; ";
	}

	echo "</div></body></html>";
*/
}

function generate_question() {

	require("resources/connection.php");

//	session_start();

	if (count($_SESSION['rand_nums']) == 0) {
		// Quiz finished

		$_SESSION['quiz_terminated'] = 1;

		$score = array_sum($_SESSION['right_answers']) / count($_SESSION['right_answers']);
		$score *= 100;
		

		echo "<div class=\"current quiz_results\">
				<p>You terminated it!</p>
			  	<p>Your score is $score%!</p>
			  </div>";

		return;
	}
		

	$rand_num =  array_pop($_SESSION['rand_nums']);
	$question_ans = mysqli_query($link, "SELECT question, possible_answers, right_answer_index FROM quiz WHERE questionID = $rand_num");
	$row = mysqli_fetch_assoc($question_ans);

	$question = $row['question'];
	$answers = explode(';', $row['possible_answers']);
	$right_answer_index = $row['right_answer_index']-1;

	$_SESSION['right_answer_index'] = $right_answer_index;
?>
	<form class="current quiz_question">
		<?php echo "<p> $question </p>";
			echo "<div class=\"answers\">";
			foreach($answers as $i=>$ans)
				echo "<div class=\"answer_choice\"><input type=\"radio\" name=\"answer\" value=\"$i\"><p>" . chr($i+97) . ") $ans</p></div>";
			echo "</div>";
		?>
	</form>
<?php
}

function check_and_reply_question() {

	array_push($_SESSION['right_answers'], $_POST['answer'] == $_SESSION['right_answer_index']);


	echo "<html><body>";
	echo "<span id=\"right_answer_index\">" . $_SESSION['right_answer_index'] . "</span>";
	generate_question();
	echo "</body></html>";
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

session_start();

if (isset($_POST['startQuiz']) && $_POST['startQuiz'] == 1)
	initializeQuiz($n_questions);
else if (isset($_COOKIE['PHPSESSID']) && isset($_POST['answer']) && !isset($_SESSION['quiz_terminated']))
	check_and_reply_question();
else
	include('resources/template.php');

?>
