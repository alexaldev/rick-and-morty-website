

function requestQuizStart(event) {

	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (request.readyState == 4 )
			if (request.status == 200) {
				var parser = new DOMParser();
				var doc = parser.parseFromString(request.responseText, "text/html");
				var firstQuestion = doc.getElementsByClassName('quiz_question')[0];

				var quizContainer = document.getElementsByClassName('quiz_container')[0];
				quizContainer.replaceChild(firstQuestion, event.target);
			}
	}
	request.open('POST', 'Quiz.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("startQuiz=1");

	

}

function addListeners() {
	var quizButton = document.getElementById('quiz_start_button');
	
	quizButton.addEventListener('click', requestQuizStart);
}

window.onload = addListeners;