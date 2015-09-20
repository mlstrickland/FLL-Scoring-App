<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 

<?php
//values initialized here will show up in the textboxes when the page first loads
$MacthNum = 0;
$Team1 = 0;
$Team2 = 0;
$Team3 = 0;
$Team4 = 0;

//variables for database connection

$hostname = 'localhost';
	
$username = 'root';
	
$password = 'password';
	
//if ADD button is pressed
if (isset($_POST["ADD"])) {
	$MacthNum = $_POST['RoundNum'];
	$Team1 = $_POST['Team1'];
	$Team2 = $_POST['Team2'];
	$Team3 = $_POST['Team3'];
	$Team4 = $_POST['Team4'];
	
	//open database connection and add the entry
	try{
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		$dbh->query("INSERT INTO `schedule` (`Round`, `Table1`, `Table2`, `Table3`, `Table4`) VALUES ('$MacthNum','$Team1','$Team2','$Team3','$Team4')");	
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}
//if REMOVE button is pressed
if (isset($_POST["REMOVE"])) {
	$MacthNum = $_POST['RoundNum'];
	$Team1 = $_POST['Team1'];
	$Team2 = $_POST['Team2'];
	$Team3 = $_POST['Team3'];
	$Team4 = $_POST['Team4'];
	
	//open database connection and remove the entry
	try{
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		$dbh->query("DELETE FROM `schedule` WHERE `Round` = $MacthNum AND `Table1` = $Team1 AND `Table2` = $Team2 AND `Table3` = $Team3 AND `Table4` = $Team4;");	
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}
//if UPDATE button is pressed
if (isset($_POST["UPDATE"])) {
	
	$MacthNum = $_POST['RoundNum'];
	$Team1 = $_POST['Team1'];
	$Team2 = $_POST['Team2'];
	$Team3 = $_POST['Team3'];
	$Team4 = $_POST['Team4'];
	
	//open database connection and update the entry with the same match number
	try{
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		$dbh->query("UPDATE `schedule` SET `Round` = $MacthNum, `Table1` = $Team1, `Table2 = $Team2, `Table3` = Team3, `Table4` = $Team4) WHERE `Round` = $MacthNum;");		
		
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}
	
?>	
<FORM name ="form1" method = "post" action = ""> 
<?php
//get current macth data from database
try{ 
	$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
	//print if connection was successful
	//echo "<P> Connected to Database<br />";
	$sql = "SELECT * FROM schedule";
	//display data in table
	echo "<center>";
	echo '<table cellpadding="4" border="0">';
	
		echo "<tr>";
			echo '<td>' . "Round";
			echo '<td>' . "Table 1A";
			echo '<td>' . "Table 1B";
			echo '<td>' . "Table 2A";
			echo '<td>' . "Table 2B";

		  echo '</tr>';
		  
		foreach($dbh->query($sql) as $row)
		{	  
		  
		  echo "<tr>";
			echo '<td>' . $row["Round"];
			echo '<td>' . $row["Table1"];
			echo '<td>' . $row["Table2"];
			echo '<td>' . $row["Table3"];
			echo '<td>' . $row["Table4"];
		  echo '</tr>';
		}
			
	echo "</table>";
	echo "</center>";
	echo "<br>;";
	
}
catch(PDOException $e){
	echo $e->getMessage();
}
//close the connection
$dbh = null;
?>
<!-- Textboxes for user entry-->
<center>
<input type="text" name="RoundNum" value="<?php echo $MacthNum;?>" style="width:100px;">
<input type="text" name="Team1" value="<?php echo $Team1;?>" style="width:100px;">
<input type="text" name="Team2" value="<?php echo $Team2;?>" style="width:100px;">
<input type="text" name="Team3" value="<?php echo $Team3;?>" style="width:100px;">
<input type="text" name="Team4" value="<?php echo $Team4;?>" style="width:100px;">
<br>
<br>
<!-- submit buttons for user entry-->
<Input type = "Submit" Name = "ADD" VALUE = "ADD">
<Input type = "Submit" Name = "REMOVE" VALUE = "REMOVE">
<Input type = "Submit" Name = "UPDATE" VALUE = "UPDATE">
</center>
</form>	
	
	
</body> 
</html>