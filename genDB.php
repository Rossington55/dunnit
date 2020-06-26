<?php
   /*
    filename: genDB.php
    author: Harrison Feldman
    created: 20/06/20
    last modified: 20/06/2020
    description: a generic function to pass any query to the registration table
   */

    function db($query, $isInsert){
        $createQuery = "CREATE TABLE registration (
                    ID INT AUTO_INCREMENT PRIMARY KEY,
                    reference_no VARCHAR(6),
                    username VARCHAR(20),
                    qualification VARCHAR(15),
                    email VARCHAR(100),
                    phone_no VARCHAR(10),
                    role VARCHAR(15)
                    )";

        require("settings.php");
        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);

        //Connect to DB
        if($conn){

            //Check if the table exists
            $exists = mysqli_query($conn,"SELECT 1 FROM registration");
            if(!$exists){
                echo "<p>Table doesn't exist, creating table</p>";
                mysqli_query($conn,$createQuery);//Create the table
			}

            //Send the requested query
            $result = mysqli_query($conn, $query);

            if($result){//Check for success
                if($isInsert){//Return the newly created id
                    $result2 = mysqli_insert_id($conn);
                    return $result2;
				}else{//Return the data
                    $data = [];
                    while($record = mysqli_fetch_array($result)){
                        array_push($data,$record);            
					}
                    return $data;        
				}
			}else{
                echo "<p>Error in query</p>";
			}

            mysqli_close($conn);
		}else{
            die('Connection error: ' .mysqli_connect_error());    
		}
	}
?>
