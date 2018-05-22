window.onload = function(){ // runs when the window gets loaded, allows the buttons to work //
	var submitButton = document.getElementById("submit");
	var backToMainButton = document.getElementById("backtomain");
	var previousButton = document.getElementById("previous");
	var nextButton = document.getElementById("next");
	submitButton.onclick = submitQuizFunction;
	backToMainButton.onclick = backToMainFunction;
	
	buildQuiz();
	

	showSlide(0);
	
	function showSlide(n) {
	
		var slides = document.querySelectorAll(".slide");
		var previousButton = document.getElementById("previous");
		var skipButton = document.getElementById("skip");
		var nextButton = document.getElementById("next");
		var backToFirstButton = document.getElementById("first");
		var goToLastButton = document.getElementById("last");
		skipButton.onclick = showNextSlide;
		previousButton.onclick = showPreviousSlide;
		nextButton.onclick = showNextSlide;
		backToFirstButton.onclick = backToFirst;
		goToLastButton.onclick = goToLast;
	
		slides[currentSlide].classList.remove("active-slide");
		slides[n].classList.add("active-slide");
		currentSlide = n;
    
		if (currentSlide === 0) {
			previousButton.style.display = "none";
			backToFirstButton.style.display = "none";
		} 
		else {
			previousButton.style.display = "inline-block";
			backToFirstButton.style.display = "inline-block";
		}
    
		if (currentSlide === slides.length - 1) {
			nextButton.style.display = "none";
			skipButton.style.display = "none";
			goToLastButton.style.display = "none";
			submitButton.style.display = "inline-block";
		} 
		else {
			nextButton.style.display = "inline-block";
			skipButton.style.display = "inline-block";
			goToLastButton.style.display = "inline-block";
			submitButton.style.display = "none";
		}
	}

	function showNextSlide() {
		showSlide(currentSlide + 1);
	}

	function showPreviousSlide() {
		showSlide(currentSlide - 1);
	}

	function backToFirst() {
		showSlide(0);
		currentSlide = 0;
	}
	function goToLast() {
		var slides = document.querySelectorAll(".slide");
		showSlide(slides.length - 1);
		currentSlide = slides.length - 1;
	}
}

var currentSlide = 0;

var questionList = [ //variable containing the list of questions
    {
      question: "What is my name?",
      answers: {
        a: "Ken",
        b: "Alex",
        c: "Izze"
      },
      correctAnswer: "a"
    },
    {
      question: "What is my favorite color?",
      answers: {
        a: "Blue",
        b: "Green",
        c: "Red"
      },
      correctAnswer: "c"
    },
    {
      question: "What is my favorite number?",
      answers: {
        a: "3",
        b: "12",
        c: "19",
        d: "25"
      },
      correctAnswer: "d"
    }
];

localStorage.setItem("questionList",JSON.stringify(questionList));
  
function buildQuiz(){
	var showQuestionAnswer = document.getElementById("questionandanswer");
	var output = [];
	//var answers = [];
	var newQuestionList = localStorage.getItem("newQuestionList");
	newQuestionList = JSON.parse(newQuestionList);
	
	
	for(var i = 0; i < newQuestionList.length; i++){
		var answers = [];
		console.log("in for");
		//console.log(questionList[i].answers);
		
		for (letter in  newQuestionList[i].answers){
			/*												This is for normal buttons, not radio buttons
			answers.push(
			`<button type="button" name="question${i}" class="quizContents" value="${letter}">
            ${questionList[i].answers[letter]}
			</button>`
			);
			*/
			answers.push(
				`<label class="quizContents">
					<input type="radio" name="question${i}" value="${letter}">
					${newQuestionList[i].answers[letter]}
					<span class="checkmark"></span>
				</label>`
			);
		}
		output.push(
        `<div class="slide">
           <div class="question"> ${newQuestionList[i].question} </div>
           <div class="answers"> ${answers.join("")} </div>
         </div>`
      );
	}
	showQuestionAnswer.innerHTML = output.join("");
}

function submitQuizFunction(){
	var showQuestionAnswer = document.getElementById("questionandanswer");
	var answerContainers = showQuestionAnswer.querySelectorAll(".answers");
	var numCorrect = 0;
	var newQuestionList = localStorage.getItem("newQuestionList");
	newQuestionList = JSON.parse(newQuestionList);
	
	for(var i = 0; i < newQuestionList.length; i++){
		const answerContainer = answerContainers[i];
		const selector = `input[name=question${i}]:checked`;
		const userAnswer = (answerContainer.querySelector(selector) || {}).value;
		console.log("user answer was " + userAnswer + " correct answer was " + newQuestionList[i].correctAnswer);
		if (userAnswer === newQuestionList[i].correctAnswer) {
			numCorrect++;
		}
	}
	localStorage.setItem("correctAnswerCount",numCorrect);
	localStorage.setItem("totalNumber",(newQuestionList.length));
	window.location.href = "results.html";
}

function backToMainFunction(){
	window.location.href = "index.html";
}