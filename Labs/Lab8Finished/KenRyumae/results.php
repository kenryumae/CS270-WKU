<?php
	include "top.html";
?>

	<div>
		<form action="matches.php" method="get">
			<?php
				$userName = ucwords(strtolower($_GET["username"]));
				$users = array();
				$matchedUsers = array();
				$fixedArray = array();
				$finalArray = array();
				$currentUserIndex;
				
				//$f = fopen("dataresource/singles.txt", "r");
				$f = file_get_contents("dataresource/singles.txt");
				//print_r(explode(",",$f));
				$nameArr = preg_split('/\r\n|\r|\n/', $f);
				
				for ($x = 0; $x < count($nameArr) - 1; $x++) {  // check to see if you are in system
					$currentUser = explode(",", $nameArr[$x]);
					if($currentUser[0] == $userName){
						$currentUserIndex = $x;
						break;
					}
				} 
				
				$currentUserAcc = explode(",", $nameArr[$currentUserIndex]);
				
				// cu = current user
				$cuUsername = $currentUserAcc[0];
				$cuGender = $currentUserAcc[1];
				$cuAge = $currentUserAcc[2];
				$cuPersonality = $currentUserAcc[3];
				$cuOS = $currentUserAcc[4];
				$cuMin = $currentUserAcc[5];
				$cuMax = $currentUserAcc[6];
				
				// splits the array into the part that we want (the data) and the part we dont (the empty spots at every odd interval)
				for($x = 0; $x < count($nameArr) - 1; $x++) {
					array_push($matchedUsers, $nameArr[$x]);
				}
				// loop through the new array to see if any of the above are not good
				for($x = 0; $x < count($matchedUsers); $x++){
					// check everything is not within parameters (if not in param, take out of array)
					$fixedArray = explode(",", $matchedUsers[$x]);
					if($cuGender != $fixedArray[1]){  // if not the same gender, put in new array
						//echo "Different genders! <br>";
					}
					else{
						continue;
					}
					// for personality type
					$arr1 = str_split($cuPersonality);
					$arr2 = str_split($fixedArray[3]);
					
					if(($arr1[0] == $arr2[0]) || ($arr1[1] == $arr2[1]) || ($arr1[2] == $arr2[2]) || ($arr1[3] == $arr2[3])){// this means there is at least one match
						//echo "Has at least one same letter! <br>";
					}
					else{
						continue;
					}
					// for os
					if($cuOS == $fixedArray[4]){  // if not the same os, put in new array
						//echo "Likes the same OS! <br>";
					}
					else{
						continue;
					}
					// for ages
					if((($cuAge >= $fixedArray[5] && $cuAge <= $fixedArray[6]) && ($fixedArray[2] >= $cuMin && $fixedArray[2] <= $cuMax))){
						//echo "Within age ranges! <br>";
					}
					else{
						continue;
					}
					//by this point the new array should append the item. (passes all tests)
					array_push($finalArray, $matchedUsers[$x]);
				}
				// at this point in time the array matchedUsers should only contain people who are compatible.
				
				$matchedUsersHTML = "";
				// making a nested for loop to display the users
				for($i = 0; $i < count($finalArray); $i++){
					$users = explode(",", $finalArray[$i]);
					$imageName = str_replace(" ", "_", strtolower($users[0])) . '.jpg';
					$tempVar = '
					<div class="match">
						<p>' . $users[0] . '</p>
						<img src="dataresource/usersimages/' . $imageName . '" alt="User Image"> <br>
						<ul>
							<li>
								<strong>gender:</strong>' . $users[1] . '
							</li>
							<li>
								<strong>age:</strong>' . $users[2] . '
							</li>
							<li>
								<strong>type:</strong>' . $users[3] . '
							</li>
							<li>
								<strong>OS:</strong>' . $users[4] . '
							</li>
						</ul>
					</div>
					';
					$matchedUsersHTML .= $tempVar;
				}
				
			?>
			
			<?="Matches for " . $userName . "\r\n";?>
			<?= $matchedUsersHTML ?>
		</form>
	</div>
		
<?php
	include "bottom.html";
?>