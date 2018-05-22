<?php
	include "top.html";
?>
		<!-- your HTML output follows -->

	<div>
		<form action="results.php" method="get">
			<fieldset>
				<legend>Returning User:</legend>
				Name:	<input type="text" name="username"><br>
				<input type="submit" value="View My Matches">
			</fieldset>
		</form>
	</div>

		
<?php
	include "bottom.html";
?>