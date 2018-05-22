<?php
	include "top.html";
?>
		
		<!-- your HTML output follows -->

	 
	 <div>
		<h1>Thank you!</h1><br>
		<p>Welcome to NerdLuv, <?php echo $_POST["name"]; ?>!</p>
		<p>Now <a href="matches.php">log in to see your matches!</a></p>
		
		<?php
			$f = fopen("dataresource/singles.txt", "a");
			fwrite($f, ucwords(strtolower($_POST['name'])).','.$_POST['gender'].','.$_POST['age'].','.strtoupper($_POST['personality_type']).','.$_POST['favOS'].','.$_POST['minAge'].','.$_POST['maxAge']."\r\n");
			fclose($f);
		?>
		<!-- code to upload picture -->
		
		<?php
			$target_dir = "dataresource/usersimages/";
			$target_file = $_POST["fileToUpload"];
			$image_name = "The image has been uploaded!";
			move_uploaded_file($target_file, "$target_dir/" . $target_file);
		?>
		<?= $image_name ?>
	 </div>



<?php
	include "bottom.html";
?>