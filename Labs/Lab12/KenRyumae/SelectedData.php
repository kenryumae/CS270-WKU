<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SalesDB";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
	
	//Show the result on the webpage as a table (you can change it the way it is required)
	
	if ($_GET["SelectedData"] == "LondonCustomers"){  //										-=London Customers=-
		$SQL ="SELECT cname, rating FROM customers WHERE city LIKE '%London%'";
		
		$stmt = $conn->prepare($SQL); 
		$stmt->execute();
		
		$result = $stmt->fetchAll(); 
		
		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>Customers from London </th><th>Ratings</th></tr>";
	
	
	
		foreach($result as $row){
			echo "<tr><th>$row[0] </th> <th>$row[1]</th></tr>";
		}
	}
	
	if ($_GET["SelectedData"] == "SalesPeople"){  //										-=Show All Sales People=-
		$SQL ="SELECT * FROM salespeople";
		
		$stmt = $conn->prepare($SQL); 
		$stmt->execute();
		
		$result = $stmt->fetchAll(); 
		
		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>Employee Number </th><th>Name</th><th>City</th><th>Commission on Orders</th></tr>";
	
	
	
		foreach($result as $row){
			echo "<tr><th>$row[0] </th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th></tr>";
		}
	}
	
	if ($_GET["SelectedData"] == "HighestCommission"){  //										-=Show Best Salesperson=-
		$SQL ="SELECT sname, comm FROM salespeople WHERE comm=(SELECT MAX(comm) FROM salespeople)";
		
		$stmt = $conn->prepare($SQL); 
		$stmt->execute();
		
		$result = $stmt->fetchAll(); 
		
		foreach($result as $row){	
			echo "<p> $row[0]</p>";
		}
		
	}
	
	if ($_GET["SelectedData"] == "CustomersCity"){  //										-=Show Grouped Customers=-
		$SQL ="SELECT cnum, cname, city, rating, snum FROM customers ORDER BY city";
		
		$stmt = $conn->prepare($SQL); 
		$stmt->execute();
		
		$result = $stmt->fetchAll(); 
		
		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>Customer Number </th><th>Customer Name</th><th>City</th><th>Rating</th><th>Salesperson Number</th></tr>";
	
	
	
		foreach($result as $row){
			echo "<tr><th>$row[0] </th><th>$row[1]</th><th>$row[2]</th><th>$row[3]</th><th>$row[4]</th></tr>";
		}
	}
	
	if ($_GET["SelectedData"] == "CustomersNoRating"){  //										-=Customers With No Rating=-
		$SQL ="SELECT cname FROM customers WHERE rating LIKE '0'";
		
		$stmt = $conn->prepare($SQL); 
		$stmt->execute();
		
		$result = $stmt->fetchAll(); 
		
		echo "<table style='border: solid 1px black;'>";
		echo "<p>Customers with no rating:</p><br>";
	
	
	
		foreach($result as $row){
			echo "<p>$row[0]</p><br>";
		}
	}
	
	if ($_GET["SelectedData"] == "CustomerWhoPlaceOrder"){  //										-=Customers Who Haven't Ordered Yet=-
		$SQL1 ="SELECT cnum, cname FROM customers";
		$SQL2 ="SELECT cnum FROM orders";
		
		$stmt1 = $conn->prepare($SQL1); 
		$stmt2 = $conn->prepare($SQL2); 
		$stmt1->execute();
		$stmt2->execute();
		
		$result1 = $stmt1->fetchAll(); 
		$result2 = $stmt2->fetchAll(); 
		$final = array();
		$finalIndex = array();
		foreach($result1 as $row){
			array_push($final, $row[0]);
		}
		for($x = 0; $x < count($final); $x++){
			foreach($result2 as $row2){
				if($final[$x] == $row2[0]){
					$final[$x] = -1;
				}
			}
		}
		
		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>Customers Who Haven't Ordered Yet</th></tr>";
	
	
	
		for($x = 0; $x < count($final); $x++){
			if($final[$x] != -1){
				array_push($finalIndex, $x);
			}
		}
		// at this point we have an array (finalIndex) with the index of the people who havent ordered
		for($x = 0; $x < count($finalIndex); $x++){
			echo "<tr><th>".$result1[$x][1]."</th></tr>";
		}
	}
	
	if ($_GET["SelectedData"] == "CustomerWithE"){  //<- ?should this not be SalespersonWithE?	-=Salesperson with an 'e' in the second position of their name=-
		$SQL1 ="SELECT sname, snum, comm FROM salespeople";
		$SQL2 ="SELECT snum, amt FROM orders";
		
		$stmt1 = $conn->prepare($SQL1); 
		$stmt2 = $conn->prepare($SQL2); 
		$stmt1->execute();
		$stmt2->execute();
		
		$result1 = $stmt1->fetchAll(); 
		$result2 = $stmt2->fetchAll(); 
		
		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>Salesperson Name</th><th>Total Amount</th></tr>";
		
		$idandcomm = array();  // will contain the key being the snum (id) and the value being the comm
		$names = array();  // will contain the names matching the snum
		$finalamount = array();
		foreach($result1 as $row){
			if($row[0][1] == 'e'){
				echo "pushing key $row[1] with value $row[2]<br>";
				array_push($names, $row[0]);
				array_push($idandcomm, $row[1]);
				$idandcomm[count($idandcomm)-1] = $row[2];
			}
		}
		
		// will loop through the array $idandcomm to append a value to the final amount
		for($x = 0; $x < count($idandcomm); $x++){  // cycles through the id's
			array_push($finalamount, $idandcomm[0]);  // adds the id to the final amount
			$finalamount[count($finalamount)-1] = 0;
			foreach($result2 as $row){  // cycles through the order id's
				if($idandcomm[$x] == $row[0]){
					array_push($finalamount[$idandcomm[0]], $finalamount[$idandcomm[0]] + $idandcomm[1] * $row[1]);  // adds the amount to the final amount@the id
				}
			}
		}
		
		// will loop through the names, ids to print out
		for($x = 0; $x < count($names); $x++){
			echo "<tr><th>".$names[$x]."</th><th>".$finalamount[$x]."</th></tr>";
		}
	
	}
	
	if ($_GET["SelectedData"] == "CustomerDescending"){  //										-=Customers From Descending Rating=-
		$SQL ="SELECT cname, city, rating FROM customers ORDER BY rating DESC";
		
		$stmt = $conn->prepare($SQL); 
		$stmt->execute();
		
		$result = $stmt->fetchAll(); 
		
		echo "<table style='border: solid 1px black;'>";
		echo "<tr><th>Customer Name</th><th>City</th><th>Rating</th></tr>";
	
	
	
		foreach($result as $row){
			echo "<tr><th>$row[0] </th><th>$row[1]</th><th>$row[2]</th></tr>";
		}
	}

    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "</table>";
$conn = null;

?>