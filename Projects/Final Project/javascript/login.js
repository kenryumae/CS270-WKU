function processUser(username,pass) {
	alert("!!!");
	var xhttp;    
	if (username == "" || pass == "") {
		alert("Please Fill All Fields");
		return;
	}
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		if(this.responseText == "failed"){
			alert("Incorrect User/Pass");
		} else {
			$userId = this.responseText;
			alert("Working!");
			//window.location.href = "mainpage.php?id=" + $userId;
		}
		}
	};
	xhttp.open("GET", "validateUser.php?username="+ username + "&password=" + password, true);
	xhttp.send();
}