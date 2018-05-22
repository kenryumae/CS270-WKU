// Ken Ryumae //
// CS 270 //
// Lab 3 //


// ---GLOBAL VARIABLES--- //
var toggleSwitch = "OFF"; // used in the toggleShiftColumns() function for on/off testing //
var timer; // used in the toggleShiftColumns() function for the timer, made global because of various errors when running it as a local var //

window.onload = function(){ // runs when the window gets loaded, allows the buttons to work //
	var guessNumberButton = document.getElementById("guessNumber");
	var generatePlateButton = document.getElementById("generatePlate");
	var highestGrossButton = document.getElementById("HighestGroosButton");
	var eldestMovieButton = document.getElementById("EldestMovieButton");
	var italyCarButton = document.getElementById("ItalyCar");
	var tableColorButton = document.getElementById("TableColor");
	var getPictureButton = document.getElementById("getPictures");
	var shiftColumnsButton = document.getElementById("ShiftColumns");
	guessNumberButton.onclick = numberGuesser;
	generatePlateButton.onclick = generatePlate;
	highestGrossButton.onclick = findHighestGross;
	eldestMovieButton.onclick = findEldestMovie;
	italyCarButton.onclick = findItalyCars;
	tableColorButton.onclick = changeTableColor;
	getPictureButton.onclick = getPictureColumns;
	shiftColumnsButton.onclick = toggleShiftColumns;
}

function numberGuesser(){ // function to play a number guessing game, 1-50 //
	confirm("Do you want to play a game?"); // confirms if user wants to play the game //
	var randomNumber = (Math.floor(Math.random() * 50) + 1); // gets a random number from 0-49 (boundaries) so +1 to make it 1-50 //
	var tries = 5; // sets the maximum number of tries, default 5 //
	var userInput;
	
	for(i = 0; i < tries; i++){ // runs for a default of 5 tries //
		userInput = prompt("Please guess a number between 1 and 50!"); // user guesses a number, and checks to see if it is correct or not //
		if(userInput == randomNumber){
			alert("That is the correct answer!");
			break; // if it is correct, then we break out of the for loop immediately //
		}
		if(userInput > randomNumber){
			alert("That number was too high!");
			if(i == tries - 1){ // checks to see if they have any tries left, if not, then breaks //
				alert("You have run out of chances!");
				break; 
			}
		}
		if(userInput < randomNumber){ // same as above //
			alert("That number was too low!");
			if(i == tries - 1){
				alert("You have run out of chances!");
				break;
			}
		}
	}
}


function generatePlate(){
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // sets the possible letters to choose from, only capital letters //
	var plate = "";
	
	for(i = 0; i < 3; i++){ // for loop finds the first 3 letters //
		plate += possible.charAt(Math.floor(Math.random() * 26));
	}
	
	for(i = 0; i < 3; i++){ // for loop finds the last 3 numbers //
		plate += Math.floor(Math.random() * 10);
	}
	
	if(document.getElementById("platesList") == null){ // checks to see if there is already a div for the plates, if not, create one with a ul //
		var newDiv = document.createElement("div");
		newDiv.setAttribute("id", "platesList");
		var unorderedList = document.createElement("ul");
		unorderedList.setAttribute("id", "list");
		newDiv.appendChild(unorderedList);	
		content.insertBefore(newDiv, document.getElementById("rwd-table"));
	}
	
	var node = document.createElement("li"); // add the plate to the ul //
    var textnode = document.createTextNode(plate);
    node.appendChild(textnode);
    document.getElementById("list").appendChild(node);
}


function findHighestGross(){ // checks through the table to see what the highest gross is //
	var table = document.getElementById("rwd-table");
	var maxGross = Number.NEGATIVE_INFINITY; // set the max initially to negative infinity to compare the values (which will be greater) //
	var value;
	var maxLocation = 0;
	
	for(i = 1; i < table.rows.length; i++){ // runs through the table to see what the highest value is and if it is greater than the previous max, set the new max //
		value = table.rows[i].cells[3].innerHTML;
		if(maxGross < trimExtraDollar(value)){
			maxGross = trimExtraDollar(value);
			maxLocation = i;
		}
	}
	
	document.getElementById("HighestGrossText").setAttribute("value", table.rows[maxLocation].cells[3].innerHTML); // displays the highest value //
	
}


function trimExtraDollar(x){ // helper function to take out the dollar signs and commas when comparing the highest value //
	return x.replace('$','').replace(/,/g,'');
}


function findEldestMovie(){ // finds the oldest movie (which would have the smallest year) //
	var table = document.getElementById("rwd-table");
	var eldest = Infinity;
	var value;
	
	for(i = 1; i < table.rows.length; i++){
		value = table.rows[i].cells[2].innerHTML;
		
		if(eldest > value){
			eldest = value;
		}
	}
	
	document.getElementById("EldestMovieText").setAttribute("value", eldest); // displays the oldest movie //
}


function findItalyCars(){
	var table = document.getElementById("carTable");
	var origin;
	
	for(i = 1; i < table.rows.length; i++){ // checks all values in the table //
		origin = table.rows[i].cells[1].innerHTML;
		car = table.rows[i].cells[0].innerHTML;
		
		if(origin.includes("Italy")){ // checks to see if it includes "Italy" //

			if(document.getElementById("carOrigin") == null){ // checks to make a new div if one does not already exist for the list //
				var newDiv = document.createElement("div");
				newDiv.setAttribute("id", "carOrigin");
				content.insertBefore(newDiv, document.getElementById("carTable").nextSibling);
			}
			
			// adds the elements to the div //
			var node = document.createElement("p");
			var textnode = document.createTextNode(car);
			node.appendChild(textnode);
			document.getElementById("carOrigin").appendChild(node);
		}
	}
}


function changeTableColor(){ // changes the color of the borders (odd) or background (even) //
	var table = document.getElementById("carTable");
	
	for(i = 1; i < table.rows.length; i += 2){
		table.rows[i].style.color = "yellow";
	}
	
	for(i = 2; i < table.rows.length; i += 2){
		table.rows[i].setAttribute("style", "background-color: green");
	}
}


function getPictureColumns(){ // displays the images below the table //
	var table = document.getElementById("carTable");
	
	if(document.getElementById("carList") == null){ // creates the div is one does not exist yet, the check can be taken out as one should not exist yet //
		var newTable = document.createElement("table");
		newTable.setAttribute("id", "carList");
		content.insertBefore(newTable, document.getElementById("carTable").nextSibling);
	}
	
	for(i = 1; i < Math.round(table.rows.length/2); i++){ // goes by sets of 2, adds the images to the table below //
		var node = document.createElement("tr");
		var td1 = document.createElement("td");
		var td2 = document.createElement("td");
		
		if(!(table.rows[i * 2 - 1].cells[2].innerHTML == undefined)){
			var img = document.createElement("img"); // creates a new img element //
			// gets all of the attributes of the img (html) //
			// sets all of the image details (src, alt, border, height, width) as attributes of the img element //
			createNewImg(img, String(table.rows[i * 2 - 1].cells[2].innerHTML).split(" "));
			td1.appendChild(img);
			node.appendChild(td1);
		}
		
		if(!(table.rows[i * 2].cells[2].innerHTML == undefined)){ //same as above //
			var image2 = document.createElement("img");
			createNewImg(image2, String(table.rows[i * 2].cells[2].innerHTML).split(" "));
			td2.appendChild(image2);
			node.appendChild(td2);
		}
		
		document.getElementById("carList").appendChild(node);
	}
	
	if(table.rows.length % 2 == 0){ // checks to see if there is an even or odd number of images//
		// will run with an even number because we ignore the first row as it displays information about the cars, not the images //
		
		// same thing as above, just with one td element instead of two //
		var node = document.createElement("tr");
		var td1 = document.createElement("td");
		
		if(!(table.rows[table.rows.length - 1].cells[2].innerHTML == undefined)){
			var image1 = document.createElement("img");
			createNewImg(image1, String(table.rows[table.rows.length - 1].cells[2].innerHTML).split(" "));
			td1.appendChild(image1);
			node.appendChild(td1);
		}
		
		document.getElementById("carList").appendChild(node);
	}
}


function createNewImg(img, imgtext){ // helper function to set the attributes of the images //
	img.setAttribute("src", trimExtraImg('"' + imgtext[1] + '"'));
	img.setAttribute("alt", trimExtraImg('"' + imgtext[2] + '"'));
	img.setAttribute("border", trimExtraImg(imgtext[3]));
	img.setAttribute("height", trimExtraImg(imgtext[4]));
	img.setAttribute("width", trimExtraImg(imgtext[5]));
	return img;
}


function trimExtraImg(x){ // helper function to remove extraneous text and only get important info //
	return x.replace('src=','').replace('alt=','').replace('border=','').replace('width=','').replace('height=','').replace('>','').replace(/"/g,'');
}


function shiftColumns(){
	var table = document.getElementById("carTable");
	var carName = [];
	var carOrigin = [];
	var carPhoto = [];
	
	for(i = 0; i < table.rows.length; i++){
		carName.push(table.rows[i].cells[0].innerHTML);
		carOrigin.push(table.rows[i].cells[1].innerHTML);
		carPhoto.push(table.rows[i].cells[2].innerHTML);
	}
	
	for(i = 0; i < table.rows.length; i++){
		table.rows[i].cells[1].innerHTML = carName[i];
		table.rows[i].cells[2].innerHTML = carOrigin[i];
		table.rows[i].cells[0].innerHTML = carPhoto[i];
	}
}


function toggleShiftColumns(){ // function to toggle the on/off value of shiftColumns() //
	
	if(toggleSwitch=="OFF"){
		toggleSwitch="ON";
		timer = setInterval(shiftColumns, 4000); // when on, will run shiftColumns() every 4 seconds (4000 milliseconds) //
	}
	
	else if(toggleSwitch=="ON"){
		toggleSwitch="OFF";
		clearInterval(timer); // when off, will stop the timer //
	}
}