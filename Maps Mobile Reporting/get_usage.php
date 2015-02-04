<?php

$app   = htmlspecialchars($_GET["app"]);
$s = htmlspecialchars($_GET["start"]);
$e = htmlspecialchars($_GET["end"]);
$flag = TRUE;
if(IsNullOrEmptyString($s)) {
 	$flag=FALSE;
} else {
	$start = date("y.m.d", strtotime($s));
}
if(IsNullOrEmptyString($e)) {
	$end = date("y.m.d");
	$end = date("y.m.d", strtotime($end . "+1 days"));
} else {
	$end   = date("y.m.d", strtotime($e));
}

$servername = "";
$username   = "";
$password   = "";
$dbname     = "";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (IsNullOrEmptyString($app)) {
    echo "<!DOCTYPE html>
<html>

  <head>
    <link rel='stylesheet' href='style.css'>
    <script src='script.js'></script>
  </head>

  <body>
	  <h2>Mobile Usage Checker</h2>
      <div>
        <label>App/Channel: </label>
        <select id='app'>";
    //create options
    $sql    = "SELECT App FROM Applications";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["App"] . "'>" . $row["App"] . "</option>";
        }
    }
    
    
    echo "</select>
        <br>
	<br>

        <label>Date Range (Optional):</label>
        <br>
        
        <label class='startLabel'>Start Date: </Label>
        <input type='text' name='start' id='start'>
		<label> (YYYY/MM/DD)</label>
        <br>
        <label class='startLabel'>End Date: </label>
        <input type='text' name='end' id='end'>
		<label> (YYYY/MM/DD)</label>
        
        <br>
		<br>
        <input type='button' value='Get Usage' onclick='getUsage()'>
      </div>
  </body>

</html>";
} else {

	echo "<!DOCTYPE html>
	<html>

  	<head>
    	<link rel='stylesheet' href='style.css'>
    	<script src='script.js'></script>
  	</head>

  	<body>
		<h3>".$app." Usage:</h3>
		<table>";
    $sql = "SELECT * FROM ".$app;
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		echo "<tr><td>Date</td><td class='result'>Map Loads</td></tr>";
		while ($row = $result->fetch_assoc()) {
			$date = date("y.m.d", strtotime($row["day"]));
			if($flag){
				if($date < $end && $date > $start){
					echo "<tr><td class='date'>".$row["day"]."</td><td class='result'>".$row["map_loads"]."</td></tr>";
				}
			} else {
				if($date < $end){
					echo "<tr><td class='date'>".$row["day"]."</td><td class='result'>".$row["map_loads"]."</td></tr>";
				}
			}
		}
	} else {
		echo "App ".$app." not found";
	}

	echo "</table>
	</body>

	</html>";
}

       // Function for basic field validation (present and neither empty nor only white space
       function IsNullOrEmptyString($question){
          return (!isset($question) || trim($question)==='');
       }
?>		
