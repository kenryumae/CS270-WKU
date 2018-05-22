window.onload = function(){ // runs when the window gets loaded, allows the buttons to work //
	var correctDisplay = document.getElementById("correct");
	var backToMainButton = document.getElementById("mainpage");
	var redoQuizButton = document.getElementById("redoquiz");
	//the idea here is to get the number correct from quizpageoperations and display them in results.html
	var correctAnswers = localStorage.getItem("correctAnswerCount");
	var totalQuestions = localStorage.getItem("totalNumber");
	console.log(totalQuestions);
	backToMainButton.onclick = backToMain;
	redoQuizButton.onclick = redoQuiz;
	
	correctDisplay.innerHTML = `<h1>${correctAnswers}/${totalQuestions}</h1>`;
}

function backToMain() {
	window.location.href = "index.html";
}

function redoQuiz() {
	window.location.href = "quiz.html";
}