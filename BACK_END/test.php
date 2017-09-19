<?php
if(isset($_POST['select'])){
	select();
 exit();
}
if(isset($_POST['insert'])){
        insert();
        exit(); 
}
?>
<html>
	<head>
		<title>Adam Elshoubri</title>
	</head>
	<body>
		<form action ='test.php' method = POST>
            		<input type = "hidden" name = "select">
			<input type = "hidden" name = "insert">
        	</form>
 	</body>
</html>
<?php
     function insert(){
				  mysql_connect('server', 'username', 'password');
       			  mysql_select_db('dbname');	
	   			    $insertstring = $_POST['insert'];
        			$insert = json_decode($insertstring);
			}

			function select(){
            			mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            			mysql_select_db('ase28');	
	   			        $selectstring = $_POST['select'];
            			$select = json_decode($selectstring);

            			$result = mysql_query ("SELECT * FROM QUESTIONBANK WHERE INSTUSER = '$select->user'");
				
				         $array = array();
               if($row = mysql_fetch_array($result)) {
					               do{
						                $array[] = $row;
				                  } while($row= mysql_fetch_array($result));
                }

	    		    	echo json_encode($array);
			}
?>
