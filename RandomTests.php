<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
     
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       $websiteErr = "Invalid URL"; 
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
   } else {
     $gender = test_input($_POST["gender"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   Website: <input type="text" name="website" value="<?php echo $website;?>">
   <span class="error"><?php echo $websiteErr;?></span>
   <br><br>
   Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
   <br><br>
   Gender:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male
   <span class="error">* <?php echo $genderErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
   
   <p>
	What is your Gender?
	<select name="formGender">
	  <option value="">Select...</option>
	  <option value="M">Male</option>
	  <option value="F">Female</option>
	</select>
	
	<?php

	$hostname = 'localhost';
	
	$username = 'root';
	
	$password = 'password';
	
	try{ 
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		echo "<P> Connected to Database<br />";
		$sql = "SELECT * FROM teams";
		/*echo '<table>';
		
		
			echo "<tr>";
				echo '<td>' . "Rank";
				echo '<td>' . "Team";
				echo '<td>' . "Round 1";
				echo '<td>' . "Round 2";
				echo '<td>' . "Round 3";
				echo '<td>' . "Round 4";
				echo '<td>' . "Round 5";
				echo '<td>' . "HighScore";
			  echo '</tr>';
			  
			foreach($dbh->query($sql) as $row)
			{	  
			  
			  echo "<tr>";
				echo '<td>' . $row["Rank"];
				echo '<td>' . $row["TeamNumber"] . "-" . $row["TeamName"] .'</td>';
				echo '<td>' . $row["Score1"];
				echo '<td>' . $row["Score2"];
				echo '<td>' . $row["Score3"];
				echo '<td>' . $row["Score4"];
				echo '<td>' . $row["Score5"];
				echo '<td>' . $row["HighScore"];
			  echo '</tr>';
			
			
				}*/
				
				echo '<select name="Team">';
				//<?php 
				//$sql = mysql_query("SELECT TeamName AND TeamNumber FROM users");
					echo "<option value=\"Team\">" . 'Select Team' . "</option>";
				foreach($dbh->query($sql) as $row){
					echo "<option value=\"Team\">" . $row['TeamNumber'] . " - " . $row['TeamName'] . "</option>";
				}
				
				echo '</select>';
		//echo "</table>";
		//print $row['TeamNumber']. "-" . $row['TeamName'] . " " . $row['Score1'] . " " . $row['Score2'] . " " . $row['Score3'] . " " . $row['Score4'] . " " . $row['Score5'] . " " . $row['HighScore'] . " " . $row['Rank'] . " " . '<br />';

		
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	

	
	//mysql_connect('hostname', 'username', 'password');
	//mysql_select_db('database-name');

	//$sql = "SELECT PcID FROM PC";
	//$result = mysql_query($sql);

	//echo "<select name='PcID'>";
	//while ($row = mysql_fetch_array($result)) {
	//	echo "<option value='" . $row['TeamNumber'] . "-" . $row['TeamName'] . "</option>";
	//
	//echo "</select>";
	
	/*$statement = $dbh->prepare('SELECT teamNumber 
		FROM teams 
		WHERE teamNumber = :teamNumber');
	
	
	
	$statement->bindParam(':teamNumber', $teamNumber, PDO::PARAM_INT);
	$statement->execute();
	*/
	

	
	//$row = $statement->fetch(); // Use fetchAll() if you want all results, or just iterate over the statement, since it implements Iterator
	
	//print $statement;
	//echo $teamNumber;
	
	$dbh = null;
	

?>
	</P>
	
<select name="Team">
<?php 
//$sql = mysql_query("SELECT TeamName AND TeamNumber FROM users");
while ($row = mysql_fetch_array($sql)){
echo "<option value=\"Team\">" . $row['TeamNumber'] . "-" . $row['TeamName'] . "</option>";
}
?>
</select>
	
</p>
   
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>