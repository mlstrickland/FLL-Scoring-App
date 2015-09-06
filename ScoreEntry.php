<!DOCTYPE HTML> 
<html>
<head>
</head>
<body> 
	
	
	
	
	
	<?php 
	$M01_Score = 0;
	$M02_Score = 0;
	$M03_Score = 0;
	$M04_Score = 0;
	$M05_Score = 0;
	$M06_Score = 0;
	$M07_Score = 0;
	$M08_Score = 0;
	$M09_Score = 0;
	$M10_Score = 0;
	$M11_Score = 0;
	$M12_Score = 0;
	$Score = 0;
	$Round = 1;
	$hostname = 'localhost';
	
	$username = 'root';
	
	$password = 'password';
	
	$Team = NULL;
	$MacthNum = NULL;
	
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function macthToPlay($Team, $MatchNum, $hostname, $username){
		try{ 
		$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
		$sql = "SELECT * FROM MatchRelation WHERE `Team` = '$Team'";
		foreach($dbh->query($sql) as $data){
			if ($data[$MatchNum] != 0){
				//echo "<center>";
				//echo "Match " . $MatchNum . " is Play " . $data[$MatchNum] . " for Team ". $Team;
				//echo "</center><br>";
				return $data[$MatchNum];
			}
			else{
				//echo "<center>";
				//echo "Team " . $Team . " Does not appear in Match " . $MatchNum;
				//echo "</center><br>";
				echo "ERROR";
				return "";
			}
		}
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  //echo "Working";
	  //* M01 *\\
	  $M01_Score = $_POST["A_GreenBins"] * 60 ;
	  //* M02 *\\
	  if (!empty($_POST['A_MethTruck']) &&  $_POST['A_MethTruck'] == "Yes"){
		$M02_Score = $M02_Score + 40;
		 
	  }
	  if (!empty($_POST['A_MethPower']) &&  $_POST['A_MethPower'] == "Yes"){
		$M02_Score = $M02_Score + 40;
		 
	 }
	  //* M03 *\\
	  if (!empty($_POST['A_BinTruck']) &&  $_POST['A_BinTruck'] == "Yes"){
		$M03_Score = $M03_Score + 50;
		 
	  }
	  if (!empty($_POST['A_BinEast']) &&  $_POST['A_BinEast'] == "Yes"){
		$M03_Score = $M03_Score + 60;
		 
	 }
	  //* M04 *\\
	  $M04_Score = $M04_Score + $_POST["A_BarsTranfer"] * 7 ;
	  $M04_Score = $M04_Score + $_POST["A_BarsBins"] * 6 ;
	  $M04_Score = $M04_Score + $_POST["A_BlackFlower"] * 8 ;
	  $M04_Score = $M04_Score + $_POST["A_BlackBin"] * 3 ;
	  $M04_Score = $M04_Score + $_POST["A_BlackElse"] * -8 ;
	  
	  //* M05 *\\
	  if (!empty($_POST['A_Career']) &&  $_POST['A_Career'] == "Yes"){
		$M05_Score = 60;
		 
	 }	  
	  //* M06 *\\
	  if (!empty($_POST['A_CarEngine']) &&  $_POST['A_CarEngine'] == "Yes"){
		$M06_Score = 65;
		 
	  }
	  if (!empty($_POST['A_CarFolded']) &&  $_POST['A_CarFolded'] == "Yes"){
		$M06_Score = 50;
		 
	 }
	 if (!empty($_POST['A_CarSafety']) &&  $_POST['A_CarSafety'] == "Yes"){
		$M06_Score = $M06_Score * 0;
		 
	 }
	  //* M07 *\\
	 $M07_Score = $M07_Score + ($_POST['A_PlasticBags']) * 30;
	 $M07_Score = $M07_Score + ($_POST['A_Animals']) * 20;
	 if (!empty($_POST['A_Chicken']) &&  $_POST['A_Chicken'] == "Yes"){
		$M07_Score = $M07_Score + 35;
	 }
	 //* M08 *\\
	 if (!empty($_POST['A_CompostEject']) &&  $_POST['A_CompostEject'] == "Yes"){
		$M08_Score = $M08_Score + 60;
		 
	  }
	  if (!empty($_POST['A_CompostSafety']) &&  $_POST['A_CompostSafety'] == "Yes"){
		$M08_Score = $M08_Score + 80;
	  }
	 //* M09 *\\ 
	 if (!empty($_POST['A_Valuables']) &&  $_POST['A_Valuables'] == "Yes"){
		$M09_Score = 60;
	 }
	 //* M10 *\\ 
	  	 if (!empty($_POST['A_Beams']) &&  $_POST['A_Beams'] == "Yes"){
		$M10_Score = 85;
	 }
	 //* M11 *\\ 
	 $M11_Score =  $_POST["A_Planes"] * 40 ; 
	 //* M12 *\\ 
	   	 if (!empty($_POST['A_Beams']) &&  $_POST['A_Beams'] == "Yes"){
		$M11_Score = 40;
	 }
	  
	  $Score = $M01_Score + $M02_Score + $M03_Score + $M04_Score + $M05_Score + $M06_Score + $M07_Score + $M08_Score + $M09_Score + $M10_Score + $M11_Score + $M12_Score;
	  $Round = test_input($_POST['RoundNum']);
	  
	  $Team = $_POST['Team'];

	  
	  try{
			$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
			$query = "UPDATE `teams` SET `Score" . macthToPlay($Team, $Round, $hostname, $username) . "` = $Score WHERE `TeamNumber` = $Team";
			//echo macthToPlay($Team, $Round, $hostname, $username);
			$dbh->query($query);	
			
			$dbh = null;
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
  }
?> 

<FORM name ="form1" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<center>
	<?php
	$dbh = new PDO("mysql:host=$hostname;dbname=teamlist", $username);
	echo "<P> Connected to Database<br />";
	?>
	<table>
		<tr>
			<td>
				<?php
				try{ 
					$sql = "SELECT * FROM teams";
					echo '<label>Team Number: </label><select name="Team">';
					echo "<option value=\"Team\">" . 'Select Team' . "</option>";
					foreach($dbh->query($sql) as $row){
					//echo "<option value=\"Team\">" . $row['TeamNumber'] . " - " . $row['TeamName'] . "</option>";
					echo "<option value=\"". $row['TeamNumber'] . "\">" . $row['TeamNumber'] . " - " . $row['TeamName'] . "</option>";
				}
					echo '</select>';
				}
					catch(PDOException $e)
				{
					echo $e->getMessage();
				}
	
	$dbh = null;

	?></td>
			<td><label>Round Number: </label><input type ="text" name ="RoundNum" value="<?php echo $Round;?>" style="width:50px;"></td>
		</tr>
	</table>
	</center>
	<br><br>
	<table cellspacing="2" cellpadding="0" border="0" align="center">
  <tr>
    <td valign="top" width="50%">
      <table class="Grid" width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
          <td bgcolor="#ccffcc">M01 Using Recycled Material</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Opponent's Green Bins with matching bars in Safety?</QuestDesc></td>
          <td><select name="A_GreenBins" id="A_GreenBins" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option></select><br><span class="Note">0-4</span></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M02 Methane</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Methane installed in the Truck's Engine?</QuestDesc></td>
          <td><input type="radio" name="A_MethTruck" id="A_MethTruckYes" value="Yes" <label for="MethTruckYes">Yes</label><br><input type="radio" name="A_MethTruck" id="A_MethTruckNo" value="No" <label for="MethTruckNo">No</label><br></td>
        </tr>
        <tr>
          <td><QuestDesc>Methane installed in the Factory's Power Station?</QuestDesc></td>
          <td><input type="radio" name="A_MethPower" id="A_MethPowerYes" value="Yes" <label for="MethPowerYes">Yes</label><br><input type="radio" name="A_MethPower" id="A_MethPowerNo" value="No" <label for="MethPowerNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M03 Transport</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Truck supports all of the Yellow Bin's weight?</QuestDesc></td>
          <td><input type="radio" name="A_BinTruck" id="A_BinTruckYes" value="Yes" <label for="BinTruckYes">Yes</label><br><input type="radio" name="A_BinTruck" id="A_BinTruckNo" value="No" <label for="BinTruckNo">No</label><br></td>
        </tr>
        <tr>
          <td><QuestDesc>Yellow Bin completely East of Truck's Guide?</QuestDesc></td>
          <td><input type="radio" name="A_BinEast" id="A_BinEastYes" value="Yes" <label for="BinEastYes">Yes</label><br><input type="radio" name="A_BinEast" id="A_BinEastNo" value="No" <label for="BinEastNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M04 Sorting</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Yellow/Blue Bars in matching Bin in/on East Tranfer?</QuestDesc></td>
          <td><select name="A_BarsTranfer" id="A_BarsTranfer" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option></select><br><span class="Note">0-15</span></td>
        </tr>
        <tr>
          <td><QuestDesc>Yellow/Blue Bars in matching Bin never in East Tranfer?</QuestDesc></td>
          <td><select name="A_BarsBins" id="A_BarsBins" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option></select><br><span class="Note">0-15</span></td>
        </tr>
        <tr>
          <td><QuestDesc>Black Bars in original position/scoring Flower Box ?</QuestDesc></td>
          <td><select name="A_BlackFlower" id="A_BlackFlower" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option></select><br><span class="Note">0-12</span></td>
        </tr>
        <tr>
          <td><QuestDesc>Black Bars in matching Green Bin or Landfill Bin?</QuestDesc></td>
          <td><select name="A_BlackBin" id="A_BlackBin" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option></select><br><span class="Note">0-12</span></td>
        </tr>
        <tr>
          <td><QuestDesc>Black Bars elsewhere in play?</QuestDesc></td>
          <td><select name="A_BlackElse" id="A_BlackElse" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option></select><br><span class="Note">0-12</span></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M05 Careers</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>At least one Person is in Sorter Area?</QuestDesc></td>
          <td><input type="radio" name="A_Career" id="A_CareerYes" value="Yes" <label for="CareerYes">Yes</label><br><input type="radio" name="A_Career" id="A_CareerNo" value="No" <label for="CareerNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M06 Scrap Cars</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Engine/Windshield installed in Car?</QuestDesc></td>
          <td><input type="radio" name="A_CarEngine" id="A_CarEngineYes" value="Yes" <label for="CarEngineYes">Yes</label><br><input type="radio" name="A_CarEngine" id="A_CarEngineNo" value="No" <label for="CarEngineNo">No</label><br></td>
        </tr>
        <tr>
          <td><QuestDesc>Car completely folded and in East Transfer Area?</QuestDesc></td>
          <td><input type="radio" name="A_CarFolded" id="A_CarFoldedYes" value="Yes" <label for="CarFoldedYes">Yes</label><br><input type="radio" name="A_CarFolded" id="A_CarFoldedNo" value="No" <label for="CarFoldedNo">No</label><br></td>
        </tr>
        <tr>
          <td><QuestDesc>Car NEVER partly in Safety Area?</QuestDesc></td>
          <td><input type="radio" name="A_CarSafety" id="A_CarSafetyYes" value="Yes" <label for="CarSafetyYes">Yes</label><br><input type="radio" name="A_CarSafety" id="A_CarSafetyNo" value="No" <label for="CarSafetyNo">No</label><br></td>
        </tr>
      </table>
    </td>
    <td valign="top" width="50%">
      <table class="Grid" width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
          <td bgcolor="#ccffcc">M07 Cleanup</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Plastic Bags in Safety Area?</QuestDesc></td>
          <td><select name="A_PlasticBags" id="A_PlasticBags" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option></select><br><span class="Note">0-2</span></td>
        </tr>
        <tr>
          <td><QuestDesc>Animals completely in any Circle w/o Bags?</QuestDesc></td>
          <td><select name="A_Animals" id="A_Animals" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option></select><br><span class="Note">0-3</span></td>
        </tr>
        <tr>
          <td><QuestDesc>Chicken completely in Small Circle?</QuestDesc></td>
          <td><input type="radio" name="A_Chicken" id="A_ChickenYes" value="Yes" <label for="ChickenYes">Yes</label><br><input type="radio" name="A_Chicken" id="A_ChickenNo" value="No" <label for="ChickenNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M08 Composting</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Compost ejected?</QuestDesc></td>
          <td><input type="radio" name="A_CompostEject" id="A_CompostEjectYes" value="Yes" <label for="CompostEjectYes">Yes</label><br><input type="radio" name="A_CompostEject" id="A_CompostEjectNo" value="No" <label for="CompostEjectNo">No</label><br></td>
        </tr>
        <tr>
          <td><QuestDesc>Compost completely is Safety Area?</QuestDesc></td>
          <td><input type="radio" name="A_CompostSafety" id="A_CompostSafetyYes" value="Yes" <label for="CompostSafetyYes">Yes</label><br><input type="radio" name="A_CompostSafety" id="A_CompostSafetyNo" value="No" <label for="CompostSafetyNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M09 Salvage</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Valuables compeltely in Safety Area?</QuestDesc></td>
          <td><input type="radio" name="A_Valuables" id="A_ValuablesYes" value="Yes" <label for="ValuablesYes">Yes</label><br><input type="radio" name="A_Valuables" id="A_ValuablesNo" value="No" <label for="ValuablesNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M10 Demolition</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>No building's beams left in setup position?</QuestDesc></td>
          <td><input type="radio" name="A_Beams" id="A_BeamsYes" value="Yes" <label for="BeamsYes">Yes</label><br><input type="radio" name="A_Beams" id="A_BeamsNo" value="No" <label for="BeamsNo">No</label><br></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M11 Purchasing Decisions</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Toy Planes completely in Safety Area?</QuestDesc></td>
          <td><select name="A_Planes" id="A_Planes" style="width:50px;"><option value=""></option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option></select><br><span class="Note">0-2</span></td>
        </tr>
        <tr>
          <td bgcolor="#ccffcc">M12 Repurposing</td>
          <td bgcolor="#ccffcc"></td>
        </tr>
        <tr>
          <td><QuestDesc>Compost in either Toy Package (Flower Box)?</QuestDesc></td>
          <td><input type="radio" name="A_Package" id="A_PackageYes" value="Yes" <label for="PackageYes">Yes</label><br><input type="radio" name="A_Package" id="A_PackageNo" value="No" <label for="PackageNo">No</label><br></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<center><Input type = "Submit" Name = "Submit1" VALUE = "Sumbit"></center>
</form>
</body> 
</html>