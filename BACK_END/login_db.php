<?php
	header('Context-type: application/json');
	if(isset($_POST['data'])){
        	logInfo();
        	exit(); 
	}
?>
<html>
	<head>
		<title>Adam Elshoubri</title>
	</head>
	<body>
           <form action ='login_db.php' method = POST>
            	<input type = "hidden" name = "data">
           </form>
           <?php
        	function logInfo(){
                	mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            		mysql_select_db('ase28');
            		$datastring = $_POST['data'];
            		$data = json_decode($datastring);

            		$instruct = mysql_query ("SELECT * FROM Instructor WHERE INSTUSER='$data->user' AND PASSWORD='$data->pass'");
	    		if ($res1 = mysql_fetch_array($instruct)) {
             			$data->instSuccess = TRUE;
            		} 
           	 	$stud = mysql_query("SELECT * FROM STUDENTS WHERE STUDUSER='$data->user' AND PASSWORD='$data->pass'");    
	    		if($res2 = mysql_fetch_array($stud)){
                		$data->studSuccess =TRUE;
            		}
            		echo json_encode($data);
        	}
           ?>
	</body>
</html>
