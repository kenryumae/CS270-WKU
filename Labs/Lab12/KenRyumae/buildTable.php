<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SalesDB";
$conn = null;
		
if ($_GET["buildTable"] == "Salespeople"){
	$sql = "DROP TABLE IF EXISTS salespeople;
			CREATE TABLE salespeople(
				snum INTEGER,
				sname CHAR(15),
				city CHAR(15),
				comm NUMERIC(3,2)
			)
	";
}
		
if ($_GET["buildTable"] == "Customers") {
	$sql = "DROP TABLE IF EXISTS customers;
			CREATE TABLE customers(
				cnum INTEGER,
				cname CHAR(15),
				city CHAR(15),
				rating INTEGER,
				snum INTEGER
			)
	";
}
		
if ($_GET["buildTable"] == "Orders") {
	$sql = "DROP TABLE IF EXISTS orders;
			CREATE TABLE orders(
				onum INTEGER,
				amt NUMERIC(8,2),
				odate DATE,
				cnum INTEGER,
				snum INTEGER
			)
	";
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    $conn->exec($sql);	
	
	$value = $_GET["buildTable"];
	
    echo "TABLE $value created successfully!";
    }
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}


?>


