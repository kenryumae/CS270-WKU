window.onload = function() {
	var multipleChoiceButton = document.getElementById("multipleChoice");
	var goToQuizButton = document.getElementById("goToQuiz");
	multipleChoiceButton.onclick = multipleChoiceFunction;
	goToQuizButton.onclick = goToQuizFunction;
}

var testbool = true;

function multipleChoiceFunction(){
	
	var userq = prompt("You have chosen to make a new multiple choice question! (4 answer choices) What is the question?");
	var answer1 = prompt("What is answer 1?");
	var answer2 = prompt("What is answer 2?");
	var answer3 = prompt("What is answer 3?");
	var answer4 = prompt("What is answer 4?");
	var correct = prompt("Which was the correct answer? (a, b, c, d)");
	
	var newQuestion = {
		question: userq,
		answers: {
        a: answer1,
        b: answer2,
        c: answer3,
		d: answer4
		},
		correctAnswer: correct
	};
	var newItems = [];
	var newQuestionList;
	if(testbool){
		newQuestionList = localStorage.getItem("questionList");
		testbool = false;
	}
	else{
		newQuestionList = localStorage.getItem("newQuestionList");
	}
	
	console.log("newQuestionList is ");
	console.log(typeof newQuestionList);
	console.log(newQuestionList);
	
	var test = JSON.parse(newQuestionList);
	
	console.log(typeof newQuestionList);
	console.log(typeof test);
	console.log(test);
	console.log("newQuestion is ");
	console.log(newQuestion);
	
	//newItems.push(test);
	test.push(newQuestion);
	console.log("The typeof test is");
	console.log(typeof test);
	console.log(test);
	console.log(typeof JSON.stringify(test));
	
	localStorage.setItem("newQuestionList", JSON.stringify(test));
}

function goToQuizFunction(){
	window.location.href = "quiz.html";
}