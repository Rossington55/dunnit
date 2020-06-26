<?php
   /*
    filename: genDB.php
    author: Harrison Feldman
    created: 20/06/20
    last modified: 26/06/2020
    description: a generic function to pass any query to the registration table
   */

    function db($query, $isInsert){
        require("settings.php");
        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
        
        //Connect to DB
        if($conn){

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
