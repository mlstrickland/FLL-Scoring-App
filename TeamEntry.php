<!DOCTYPE HTML> 
<html>
<head>
<!--color for error messages--> 
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php


//error flag
$error = 0;

//variables for database connection
$hostname = 'localhost';
$username = 'root';
$password = 'password';

// define variables and set to empty values
$nameErr = $numberErr = $genderErr = $websiteErr = "";
//values initialized here will show up in the textboxes when the page first loads
$name = $number = "";

//if ADD button is pressed
if (isset($_POST["ADD"])) {
	if (empty($_POST["name"])) {
     $nameErr = "Name is required";
	 $error = 1;
   }
   else {
	   $name = test_input($_POST["name"]);
   }
	//if textbox is empty display error message
   if (empty($_POST["number"])) {
     $numberErr = "Number is required";
	 $error = 1;
	//if textbox does not only contains numbers display error message
   } else if (is_numeric($_POST["number"]) != 1){
	 $numberErr = "Team number can only contain numbers";
	 $error = 1;
	}
	//if no error set the variable to the value in the box and add the data to the database
	else{ 
	$number = test_input($_POST["number"]);
	//if ($error != 1){
		try{ 
			$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
			$dbh->query("INSERT INTO `teams`(`TeamNumber`, `Score1`, `score2`, `score3`, `score4`, `score5`, `highscore`, `TeamName`) VALUES ('$number',0,0,0,0,0,0,'$name')");	
			}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
//if REMOVE button is pressed
if (isset($_POST["REMOVE"])) {
	//get team name from dropdown
	$Team = $_POST['Team'];
	//remove team from database
	try{
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		$dbh->query("DELETE FROM `teams` WHERE `TeamNumber` = $Team");	
		
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}	
}
	

//remove spaces and slashes and convert to html entities
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Team Entry</h2>
<form method="post" action=""> 
	<!-- team name field for user input-->
	Team Name <input type="text" name="name" value="<?php echo $name;?>">
	<span class="error"> <?php echo $nameErr;?></span>
	<br><br>
	<!-- team number field for user input-->
	Team Number: <input type="text" name="number" value="<?php echo $number;?>">
	<span class="error"> <?php echo $numberErr;?></span>
	<br><br>
	<input type="submit" name="ADD" value="ADD">
	<br>
	<br> 

	<?php
	//get current team data from database
	try{ 
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		//print if connection was successful
		//echo "<P> Connected to Database<br />";
		$sql = "SELECT * FROM teams ORDER BY TeamNumber";
		
		//place team data in dropdown		
		echo '<select name="Team">';
		echo "<option value=\"Team\">" . 'Select Team to Remove' . "</option>";
		foreach($dbh->query($sql) as $row){
			echo "<option value=\"" . $row['TeamNumber'] . "\">" . $row['TeamNumber'] . " - " . $row['TeamName'] . "</option>";
		}
		
		echo '</select>';
	}
	catch(PDOException $e){
		echo "Failed to connect <br>";
		echo $e->getMessage();
	}
	
	echo "<br><br>";
	//remove button for user input
	echo "<input type='submit' name='REMOVE' value='REMOVE'>";
	//close the connection
	$dbh = null;
	?>
</form>

</body>
</html>