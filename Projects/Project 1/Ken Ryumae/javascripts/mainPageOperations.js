window.onload = function(){ // runs when the window gets loaded, allows the buttons to work //
	var beginQuizButton = document.getElementById("beginQuiz");
	var editQuizButton = document.getElementById("editQuiz");
	beginQuizButton.onclick = beginQuiz;
	editQuizButton.onclick = editQuizFunction;
}

function beginQuiz(){
	window.location.href = "quiz.html";
}

function editQuizFunction(){
	window.location.href = "editquiz.html";
}