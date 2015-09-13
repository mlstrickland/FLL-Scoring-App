<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
$name = "";
$number = 0;

$error = 0;

$hostname = 'localhost';
	
$username = 'root';
	
$password = 'password';

function printStuff(){
 print "stuff";
}

// define variables and set to empty values
$nameErr = $numberErr = $genderErr = $websiteErr = "";
$name = $number = "";

if (isset($_POST["ADD"])) {
	
	if (empty($_POST["name"])) {
     $nameErr = "Name is required";
	 $error = 1;

   }
   else {
	   $name = test_input($_POST["name"]);
   }

   if (empty($_POST["number"])) {
     $numberErr = "Number is required";
	 $error = 1;
   } else if (is_numeric($_POST["number"]) != 1){
	 $numberErr = "Team number can only contain numbers";
	 $error = 1;
	 
	 
	}
     // check if name only contains letters and whitespace
   //else if (!is_numeric($number)) {
	//	$numberErr = "Only numbers allowed"; 
   //}
	else{
		 $number = test_input($_POST["number"]);
	 }
	if ($error != 1){
		try{ 
			$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
			
			//$dbh->query("INSERT INTO `schedule` ('Round', 'Table1', 'Table2`, `Table3`, `Table4`) VALUES ('$MacthNum','$Team1','$Team2','$Team3','$Team4');");	
			$dbh->query("INSERT INTO `teams`(`TeamNumber`, `Score1`, `score2`, `score3`, `score4`, `score5`, `highscore`, `TeamName`) VALUES ('$number',0,0,0,0,0,0,'$name')");	
			
			}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
if (isset($_POST["REMOVE"])) {
	$Team = $_POST['Team'];
	try{
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		$dbh->query("DELETE FROM `teams` WHERE `TeamNumber` = $Team");	
		//$dbh->query("DELETE FROM `schedule` WHERE `Round` = $MacthNum AND `Table1` = $Team1 AND `Table2` = $Team2 AND `Table3` = $Team3 AND `Table4` = $Team4;");	
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
		//$query = "INSERT INTO `teamlist` (`TeamNumber`, `TeamName`) VALUES ('$number','$name')";	
		//$query = "INSERT INTO `teamlist` (`TeamNumber`,`Score1`, `score2`,`score3`,`score4`,`score5`,`highscore`, `rank`, `TeamName`) VALUES ('$number',0,0,0,0,0,0,'$name')";	
		//$query = "INSERT INTO `teams`(`TeamNumber`, `Score1`, `score2`, `score3`, `score4`, `score5`, `highscore`, `TeamName`) VALUES ('$number',0,0,0,0,0,0,'$name')";	
}
	


function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Team Entry</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action=""> 
   Team Name <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   Team Number: <input type="text" name="number" value="<?php echo $number;?>">
   <span class="error">* <?php echo $numberErr;?></span>
   <br><br>
   <input type="submit" name="ADD" value="ADD">
   <br>
	<!--<input type="radio" name="MODE" id="INSERT" value="INSERT" <label for="INSERT">INSERT</label>!-->
	<!--<input type="radio" name="MODE" id="UPDATE" value="UPDATE" <label for="UPDATE">UPDATE</label>!--> <br> 

 
<?php
	
	try{ 
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		//echo "<P> Connected to Database<br />";
		$sql = "SELECT * FROM teams ORDER BY TeamNumber";
		
				echo '<select name="Team">';
				//<?php 
				//$sql = mysql_query("SELECT TeamName AND TeamNumber FROM users");
					echo "<option value=\"Team\">" . 'Select Team' . "</option>";
				foreach($dbh->query($sql) as $row){
					echo "<option value=\"" . $row['TeamNumber'] . "\">" . $row['TeamNumber'] . " - " . $row['TeamName'] . "</option>";
				}
				
				echo '</select>';
				?>
				
				
				<?php
		//echo "</table>";
		//print $row['TeamNumber']. "-" . $row['TeamName'] . " " . $row['Score1'] . " " . $row['Score2'] . " " . $row['Score3'] . " " . $row['Score4'] . " " . $row['Score5'] . " " . $row['HighScore'] . " " . $row['Rank'] . " " . '<br />';

		
	}
	catch(PDOException $e){
		echo "Failed to connect <br>";
		echo $e->getMessage();
	}
	?>
	<br><br>
	<!--<input type="radio" name="MODE" id="REMOVE" value="REMOVE" <label for="REMOVE">REMOVE</label>!-->
	<input type="submit" name="REMOVE" value="REMOVE">
	<?php
	
	$dbh = null;
	

?>
	</P>
	
</p>
   
</form>

</body>
</html>