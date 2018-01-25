

function checkAnswer(event) {

	var currAnsName = event.target.name;
	var currAnsValue = event.target.value;
	var currAnsDiv = event.target.parentNode;
	var allAnswers = currAnsDiv.parentNode;
	var currQuizQuestion = allAnswers.parentNode;
	var quizContainer = currQuizQuestion.parentNode;
	
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (request.readyState == 4 )
			if (request.status == 200) {
				var parser = new DOMParser();
				var doc = parser.parseFromString(request.responseText, "text/html");

				var right_ans = doc.getElementById('right_answer_index').textContent;
				
				var nextQuestion = doc.getElementsByClassName('current')[0];

				if (currAnsValue == right_ans)
					currAnsDiv.style.backgroundColor = "green";
				else
					currAnsDiv.style.backgroundColor = "red";

				currQuizQuestion.classList.remove('current');
				quizContainer.appendChild(nextQuestion);

				if (nextQuestion.classList.contains('quiz_question')) 
					addRadioListeners();
			}
	}
	request.open('POST', 'Quiz.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send(currAnsName + "=" + currAnsValue);

	// Tide up
	var currButtonDivs = allAnswers.getElementsByClassName('answer_choice');
	for (var i=0; i<currButtonDivs.length; i++) {
		currButtonDivs[i].getElementsByTagName('input')[0].disabled = true;
		currButtonDivs[i].getElementsByTagName('input')[0].removeEventListener('click', checkAnswer);
		currButtonDivs[i].removeEventListener('click', clickInput);
	}	
}

function clickInput(event) {
	event.currentTarget.getElementsByTagName('input')[0].click();
}

function addRadioListeners() {
	var currButtonDivs = document
		.querySelector('.current.quiz_question .answers')
		.getElementsByClassName('answer_choice');

	for (var i=0; i<currButtonDivs.length; i++) {
		currButtonDivs[i]
			.getElementsByTagName('input')[0]
			.addEventListener('click', checkAnswer);
		
		currButtonDivs[i].addEventListener('click', clickInput)
	}

}

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
				addRadioListeners();
			}
	}
	request.open('POST', 'Quiz.php', true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("startQuiz=1");
}

window.onload = function() {
	document
	.getElementById('quiz_start_button')
	.addEventListener('click', requestQuizStart);
};
