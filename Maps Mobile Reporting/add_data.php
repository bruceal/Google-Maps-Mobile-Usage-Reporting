        <?php
        $app = htmlspecialchars($_GET["app"]);
		//echo $app;

        if(IsNullOrEmptyString($app)) {
			echo "No App name provided";
        } else {
        

			//Needs to be filled in with SQL database values
        	$servername = "";
        	$username = "";
        	$password = "";
        	$dbname = "";

        	// Create connection
        	$conn = new mysqli($servername, $username, $password, $dbname);
        	// Check connection
        	if ($conn->connect_error) {
           		die("Connection failed: " . $conn->connect_error);
        	}

			$sql="SELECT * from Applications WHERE App ='".$app."'";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				//update existing table
				$sql = "SELECT page_views FROM ".$app." WHERE day='".date("y.m.d") . "'";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					$row = $result->fetch_assoc();
					$count = intval($row["page_views"]) + 1;

					//Do the actual update
					$sql = "UPDATE ".$app." SET page_views =" . $count . " WHERE day='".date("y.m.d") . "'";
					if ($conn->query($sql) === TRUE) {
    					echo "Record updated successfully";
					} else {
    					echo "Error updating record: " . $conn->error;
					}
				} else {
					//Add Usage
					$sql = "INSERT INTO ".$app." (day, page_views) VALUES ('".date("y.m.d") . "',1)";
        			if($conn->query($sql)===TRUE){
						echo "Record updated successfully";
					} else {
						echo "Error updating Table: " . $conn->error;
					}
				}
			} else {
				//create table
				$sql="CREATE TABLE ".$app." (day DATE, page_views int(11))";
				if ($conn->query($sql) === TRUE) {
           			$sql = "INSERT INTO Applications (App) VALUES ('".$app."')";
					if($conn->query($sql)===TRUE){
           				echo "Application Added";
					} else {
						echo "Error updating Applications list: " . $conn->error;
					}
        		} else {
           			echo "Error creating table: " . $sql . $conn->error;
        		}
				
				//Add Usage
				$sql = "INSERT INTO ".$app." (day, page_views) VALUES ('".date("y.m.d") . "',1)";

        		if ($conn->query($sql) === TRUE) {
           			echo "New record created successfully ";
        		} else {
           			echo "Error: " . $sql . $conn->error;
        		}
			}

           $conn->close();
        }


       // Function for basic field validation (present and neither empty nor only white space
       function IsNullOrEmptyString($question){
          return (!isset($question) || trim($question)==='');
       }

      ?>
