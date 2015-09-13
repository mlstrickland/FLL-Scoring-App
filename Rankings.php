<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 

<?php
	
	
	
	$hostname = 'localhost';
	
	$username = 'root';
	
	$password = 'password';
	
	$i = 1;
	//update all HighScores
try{ 
	$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
	//echo "<P> Connected to Database<br />";
	$sql = "SELECT * FROM teams";
	//for($i = 0; $i < 1; $i++){
	foreach($dbh->query($sql) as $data){
	
		$HighScore = max($data["Score1"], $data['Score2'], $data['Score3'], $data['Score4'], $data['Score5']);
			if ($data["Score1"] == $HighScore){
				$data["Score1"] = 0;
			}
			if ($data["Score2"] == $HighScore){
				$data["Score2"] = 0;
			}
			if ($data["Score3"] == $HighScore){
				$data["Score3"] = 0;
			}
			if ($data["Score4"] == $HighScore){
				$data["Score4"] = 0;
			}
			if ($data["Score5"] == $HighScore){
				$data["Score5"] = 0;
			}
		$TieBreak1 = max($data["Score1"], $data['Score2'], $data['Score3'], $data['Score4'], $data['Score5']);
			if ($data["Score1"] == $TieBreak1){
				$data["Score1"] = 0;
			}
			if ($data["Score2"] == $TieBreak1){
				$data["Score2"] = 0;
			}
			if ($data["Score3"] == $TieBreak1){
				$data["Score3"] = 0;
			}
			if ($data["Score4"] == $TieBreak1){
				$data["Score4"] = 0;
			}
			if ($data["Score5"] == $TieBreak1){
				$data["Score5"] = 0;
			}
			
		$TieBreak2 = max($data["Score1"], $data['Score2'], $data['Score3'], $data['Score4'], $data['Score5']);

		}
			
		$dbh->query("UPDATE `teams` SET `HighScore` = $HighScore, `TieBreak1` = $TieBreak1, `TieBreak2` = $TieBreak2 WHERE `teamNumber` = " . $data['TeamNumber']);
		
	}

catch(PDOException $e){
	echo $e->getMessage();
}
$dbh = null;
	//update all HighScores
try{ 
	$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
	//echo "<P> Connected to Database<br />";
	//$sql = "SELECT * FROM teams ORDER BY HighScore DESC, TeamNumber DESC";
	
		
	echo "<Center>";
	//$dbh->query($sql);
	echo '<table width="700" border="0">';
	
		echo "<tr>";
			echo '<td width = 35% >' . "Team";
			echo '<td width = "65">' . "Round 1";
			echo '<td width = "65">' . "Round 2";
			echo '<td width = "65">' . "Round 3";
			echo '<td width = "65">' . "Round 4";
			echo '<td width = "65">' . "Round 5";
			echo '<td width = "100">' . "High Score";
			echo '<td width = "65">' . "Rank";

		  echo '</tr>';
		echo '</table>';
		
		
		echo '<marquee behavior="scroll" direction="up"';
		echo 'scrollamount="1"';
		echo 'scrolldelay="0">';
		echo '<Center>';
		echo '<table width="700" border="0">';
		
		
		foreach($dbh->query("SELECT * FROM teams ORDER BY HighScore DESC, TieBreak1 DESC, TieBreak2 DESC ") as $data)
		{	  
		  
		  echo "<tr>";
			echo '<td width = 35% >' . $data["TeamNumber"] . " - " . $data["TeamName"];
			echo '<td width = "65">' . $data["Score1"];
			echo '<td width = "65">' . $data["Score2"];
			echo '<td width = "65">' . $data["Score3"];
			echo '<td width = "65">' . $data["Score4"];
			echo '<td width = "65">' . $data["Score5"];
			echo '<td width = "100">' . $data["HighScore"];
			echo '<td width = "65">' . $i;
		  echo '</tr>';
			$i++;
		
			}
			
	echo "</table>";
	echo '</marquee>';	
			
}
catch(PDOException $e){
	echo $e->getMessage();
}
$dbh = null;
	
	

?>

</body>
</html>