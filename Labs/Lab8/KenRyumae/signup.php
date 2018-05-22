<!DOCTYPE html>
<html>
	<!-- Homework 4 (NerdLuv) -->
	<!-- shared page top HTML -->
	
	<head>
		<title>NerdLuv</title>
		
		<meta charset="utf-8" />
		
		<!-- instructor-provided CSS and JavaScript links; do not modify -->
		<link href="images/heart.gif" type="image/gif" rel="shortcut icon" />
		<link href="cssfiles/nerdluv.css" type="text/css" rel="stylesheet" />
		
		<script src="http://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js" type="text/javascript"></script>
		<script src="javascript/provided.js" type="text/javascript"></script>
	</head>

	<body>
		<div id="bannerarea">
			<img src="images/nerdluv.png" alt="banner logo" /> <br />
			where meek geeks meet
		</div>
		
		<!-- your HTML output follows -->

	<div>
		<form>
			<fieldset class="column">
				<legend>New User Signup:</legend>
				<ul>
					<li>
						<label for="name">Name:</label>
						<input type="text" name="name">
					</li>
					<li>
						Gender: 
						<input type="radio" name="gender" value="male" id="male"> 
						<label for="male">Male</label>
						<input type="radio" name="gender" value="female" id="female"> 
						<label for="female">Female</label>
					</li>
					<li>	
						<label for="age">Age</label>
						<input type="text" name="age" id="age">
					</li>
					<li>
						Personality Type:	
						<input type="text" name="personality_type">
						(<a href="https://www.16personalities.com/free-personality-test">Don't know your type?</a>)
					</li>
					<li>
					Favorite OS: 	
					<select>
						<option value="windows">Windows</option>
						<option value="mac">Mac</option>
						<option value="linux">Linux</option>
					</select>
					</li>
					<li>
						Seeking age:	
						<input type="number" name="min" title="Min" min="18" style="width: 7em"> 
						to 
						<input type="number" name="max" title="Max" style="width: 7em">
					</li>
				</ul>
				<input type="submit" value="Sign Up">
			</fieldset>
		</form>
	</div>

		
		<!-- shared page bottom HTML -->
		<div>
			<p>
				This page is for single nerds to meet and date each other!  Type in your personal information and wait for the nerdly luv to begin!  Thank you for using our site.
			</p>
			
			<p>
				Results and page (C) Copyright NerdLuv Inc.
			</p>
			
			<ul>
				<li>
					<a href="index.php">
						<img src="images/back.gif" alt="icon" />
						Back to front page
					</a>
				</li>
			</ul>
		</div>

		<div id="w3c">
			<a href="https://validator.w3.org/">
				<img src="images/w3c-xhtml.png" alt="Valid HTML" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/">
				<img src="images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
