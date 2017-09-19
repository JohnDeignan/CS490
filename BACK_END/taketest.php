<?php
if(isset($_POST['data'])){
        select();
        exit(); 
}
?>
<html>
	<head>
		<title>Adam Elshoubri</title>
	</head>
	<body>
		    <form action ='taketest.php' method = POST>
            		<input type = "hidden" name = "data">
 	      </form>

    		<?php
    			function select(){
            			mysql_connect('server', 'username', 'password');
            			mysql_select_db('dbname');	
	   			        $datastring = $_POST['data'];
            			$data = json_decode($datastring);

            			$result = mysql_query("SELECT QUESTID FROM QUEST_TEST WHERE '$data->testid'");
                  $questid = mysql_fetch_array($result);
                  $q_id = $questid['QUESTID'];
                  $array = array();
                  if($row = mysql_fetch_array($result)) {
                    do{
                        $array[] = $row;
                    } while($row = mysql_fetch_array($result));
                  }
                  $size = sizeof($array);
                  $arr = array();
                  for($i=0;$i<$size;$i++){
                        $res = mysql_query("SELECT * FROM QUESTIONBANK WHERE CODE='$array[$i]->QUESTID'");
                        if($row1 = mysql_fetch_array($res)) {
                          do{
                              $arr[] = $row1;
                          } while($row1 = mysql_fetch_array($res));
                        }
                  }  				          
                  echo json_encode($array);
		    	}

    		?>

	</body>
</html>
