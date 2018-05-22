window.onload = function() {
	var addQuestionButton = document.getElementById("addQuestion");
	var editQuestionButton = document.getElementById("editQuestion");
	var deleteQuestionButton = document.getElementById("deleteQuestion");
	addQuestionButton.onclick = addQuestionFunction;
	editQuestionButton.onclick = editQuestionFunction;
	deleteQuestionButton.onclick = deleteQuestionFunction;
}

function addQuestionFunction(){
	window.location.href = "newquestion.html";
}

function editQuestionFunction(){
	window.location.href = "editquestion.html";
}

function deleteQuestionFunction(){
	window.location.href = "deletequestion.html";
}