<?php
/*
 * Author : Ashish
* Description  : This php page will gives data of selected from dropdown number table and it's data.
* Version : 1.0
*
*/
$outputHtml = "";

if (!empty($_POST['tableId']) && !empty($_POST['rowId'])) {
    /*
     * Database connection configuration
     */
	$username = "root";
	$password = "";
	$hostname = "localhost";
	$dbname = "ashish_db";

	//get post variables
	$tableId = $_POST['tableId'];
	$rowId = $_POST['rowId'];
	
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password)
	 or die("Unable to connect to MySQL");

	//select a database to work with
	$selected = mysql_select_db($dbname,$dbhandle)
	  or die("Could not select examples");

	//execute the SQL query and return records
	$result = mysql_query("SELECT * FROM table$tableId");
	
	$outputHtml .= "<table class='tftable'>";
	$outputHtml .= "<tr><td>Column1</td><td>Column2</td><td>Column3</td><td>Column4</td><tr>";

	if(!$result){
		$outputHtml .= "<tr><td colspan='4'> No record found in table$tableId.</td></tr>";
	}
	else{
		$rowIndex = 1;
		//fetch tha data from the database
		while ($row = mysql_fetch_array($result)) {
			$className = ($rowIndex == $rowId) ? "info_green" : "";
			
			$outputHtml .= "<tr class='$className'>";
			$outputHtml .= "<td>".$row{'Column1'}."</td>";
			$outputHtml .= "<td>".$row{'Column2'}."</td>";
			$outputHtml .= "<td>".$row{'Column3'}."</td>";
			$outputHtml .= "<td>".$row{'Column4'}."</td>";
			$outputHtml .= "</tr>";
			
			$className = "";
			$rowIndex++;
		}
	}	
	$outputHtml .= "</table>";
	
	echo $outputHtml;
	//close the connection
	mysql_close($dbhandle);
}
else {
	$outputHtml = "<div class='error_alert'>Data not available!!!</div>";
}
?>