<?php
	include "top.html";
?>
		
		<!-- your HTML output follows -->

	<div>
		<form action="confirm.php" method="post">
			<fieldset>
				<legend>New User Signup:</legend>
				<ul>
					<li>
						<strong>Name:</strong>
						<input type="text" name="name" maxlength="16">
					</li>
					<li>
						<strong>Gender:</strong>
						<input type="radio" name="gender" value="M" id="male"> 
						Male
						<input type="radio" name="gender" value="F" id="female" checked="checked"> 
						Female
					</li>
					<li>	
						<strong>Age</strong>
						<input type="text" name="age" id="age" maxlength="2" size="6">
					</li>
					<li>
						<strong>Personality Type:</strong>
						<input type="text" name="personality_type" maxlength="4" size="6">
						(<a href="http://www.humanmetrics.com/cgi-win/jtypes2.asp">Don't know your type?</a>)
					</li>
					<li>
					<strong>Favorite OS:</strong>	
					<select name="favOS">
						<option value="Windows" selected>Windows</option>
						<option value="Mac OS X">Mac OS X</option>
						<option value="Linux">Linux</option>
					</select>
					</li>
					<li>
						<strong>Seeking age:</strong>
						<input type="text" name="minAge" title="Minimum Age" placeholder="min" size="6" maxlength="2"> 
						to 
						<input type="text" name="maxAge" title="Maximum Age" placeholder="max" size="6" maxlength="2">
					</li>
					<li>
						<strong>Upload a profile picture:</strong>
						<input type="hidden" name="MAX_FILE_SIZE" value="400000" />
						<input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg">
					</li>
				</ul>
				<div>
					<input type="submit" value="Sign Up">
				</div>
			</fieldset>
		</form>
	</div>

<?php
	include "bottom.html";
?>