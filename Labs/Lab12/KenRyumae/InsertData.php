<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SalesDB";

try {
	
	
	//														--==This section is for the Customers==--
	if ($_GET["InsertIntoTable"] == "Customers") {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO customers (cnum, cname ,city , rating, snum) 
    VALUES (:CustomerNumber, :CustomerName, :CustomerCity, :CustomerRating, :SalespersonNumber)");
    $stmt->bindParam(':CustomerNumber', $CustomerNumber);
    $stmt->bindParam(':CustomerName', $CustomerName);
    $stmt->bindParam(':CustomerCity', $CustomerCity);
	$stmt->bindParam(':CustomerRating', $CustomerRating);
	$stmt->bindParam(':SalespersonNumber', $SalespersonNumber);

	$counter=0;
	
	// Open a file that contains the data
	$myfile = fopen("CustomersFile.txt", "r") or die("Unable to open file customers!");
	$linecount = 0;
	while(!feof($myfile)){
		$line = fgets($myfile);
		$linecount++;
	}
	fclose($myfile);
	$myfile = fopen("CustomersFile.txt", "r") or die("Unable to open file customers!");
	
	
	// read the file contents one line after another 
	while($counter < $linecount - 1) {
		//read from the file
		$OneLineFromFile = fgets($myfile) ;
		
		//split the line of data into different pieces
		$pieces = explode("\t", $OneLineFromFile);
		
		if ($counter != 0){ 
		// associate each piece with the proper varaible
		$CustomerNumber = intval($pieces[0]);
		$CustomerName = $pieces[1];
		$CustomerCity = $pieces[2];
		$CustomerRating = intval($pieces[3]);
		echo "customerrating ".$pieces[3]."<br>";
		$SalespersonNumber = intval($pieces[4]);
		echo "salespersonnumber ".$pieces[4]."<br>";
		}
		//execute the statement
		if ($counter != 0){
			$stmt->execute();
		}
		
		//increase number of executed lines.
		$counter++;
	}
	//close the file
	fclose($myfile);
	
	//show how many file you inserted into the DB
	echo "You have inserted ".($counter - 1)." rows into the table ";
	}
	
	//														--==This section is for the Salespeople==--
	
	if ($_GET["InsertIntoTable"] == "Salespeople") {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO salespeople (snum, sname ,city , comm) 
    VALUES (:SalespersonNumber, :SalespersonName, :SalespersonCity, :SalespersonCommission)");
    $stmt->bindParam(':SalespersonNumber', $SalespersonNumber);
    $stmt->bindParam(':SalespersonName', $SalespersonName);
    $stmt->bindParam(':SalespersonCity', $SalespersonCity);
	$stmt->bindParam(':SalespersonCommission', $SalespersonCommission);

	$counter=0;
	
	// Open a file that contains the data
	$myfile = fopen("SalespeopleFile.txt", "r") or die("Unable to open file customers!");
	
	$linecount = 0;
	while(!feof($myfile)){
		$line = fgets($myfile);
		$linecount++;
	}
	fclose($myfile);
	$myfile = fopen("SalespeopleFile.txt", "r") or die("Unable to open file customers!");
	
	// read the file contents one line after another 
	while($counter < $linecount - 1) {
		//read from the file
		$OneLineFromFile = fgets($myfile) ;
		
		//split the line of data into different pieces
		$pieces = explode("\t", $OneLineFromFile);
		
		if ($counter != 0){ 
		// associate each piece with the proper varaible
		$SalespersonNumber = intval($pieces[0]);
		$SalespersonName = $pieces[1];
		$SalespersonCity = $pieces[2];
		$SalespersonCommission = floatval($pieces[3]);
		}
		//execute the statement
		if ($counter != 0){
			$stmt->execute();
		}
		
		//increase number of executed lines.
		$counter++;
	}
	//close the file
	fclose($myfile);
	
	//show how many file you inserted into the DB
	echo "You have inserted ".($counter - 1)." rows into the table ";
	}
	
	//														--==This section is for the Orders==--
	
	if ($_GET["InsertIntoTable"] == "Orders") {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO orders (onum, amt ,odate , cnum, snum) 
    VALUES (:OrderNumber, :OrderAmount, :OrderDate, :CustomerNumber, :SalespersonNumber)");
    $stmt->bindParam(':OrderNumber', $OrderNumber);
    $stmt->bindParam(':OrderAmount', $OrderAmount);
    $stmt->bindParam(':OrderDate', $OrderDate);
	$stmt->bindParam(':CustomerNumber', $CustomerNumber);
	$stmt->bindParam(':SalespersonNumber', $SalespersonNumber);

	$counter=0;
	
	// Open a file that contains the data
	$myfile = fopen("OrdersFile.txt", "r") or die("Unable to open file customers!");
	
	$linecount = 0;
	while(!feof($myfile)){
		$line = fgets($myfile);
		$linecount++;
	}
	fclose($myfile);
	$myfile = fopen("OrdersFile.txt", "r") or die("Unable to open file customers!");
	
	// read the file contents one line after another 
	while($counter < $linecount - 1) {
		//read from the file
		$OneLineFromFile = fgets($myfile) ;
		
		//split the line of data into different pieces
		$pieces = explode("\t", $OneLineFromFile);
		
		if ($counter != 0){ 
		// associate each piece with the proper varaible
		$OrderNumber = intval($pieces[0]);
		$OrderAmount = $pieces[1];
		
		// split the date up into 3 sections (day, month, year)
		$OldDate = explode('-', $pieces[2]);
		$OrderDate = $OldDate[2] . "-" . $OldDate[1] . "-" . $OldDate[0];
		$CustomerNumber = intval($pieces[3]);
		$SalespersonNumber = intval($pieces[4]);
		}
		//execute the statement
		if ($counter != 0){
			$stmt->execute();
		}
		
		//increase number of executed lines.
		$counter++;
	}
	//close the file
	fclose($myfile);
	
	//show how many file you inserted into the DB
	echo "You have inserted ".($counter - 1)." rows into the table ";
	}
    
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>