<?php
  header('Context-type: application/json');
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
		      <form action ='gettest.php' method = POST>
            		<input type = "hidden" name = "data">
        	</form>

    		  <?php
    			  function select(){
            			mysql_connect('server', 'username', 'password');
            			mysql_select_db('dbname');	
	   			        $datastring = $_POST['data'];
            			$data = json_decode($datastring);          
            			
                  $result = mysql_query("SELECT CODE FROM STUDENTS WHERE STUDUSER='$data->user'");
                  $stduser = mysql_fetch_array($result);
                  $s_user = $stduser['CODE'];
                  
				          $res = mysql_query("SELECT INSTUSER FROM Instructor WHERE CODE='$s_user'");
                  $stdcode = mysql_fetch_array($res);
                  $s_code =$stdcode['INSTUSER'];
				
				          $res1 = mysql_query("SELECT * FROM INSTTEST WHERE CODE='$s_user'");
                  $array = array();
	    			      if($row = mysql_fetch_array($res1)) {
					          do{
						            $array[] = $row;
					          } while($row= mysql_fetch_array($res1));
	    			      } 
                  $test = 2;
                  $size=sizeof($array);
                  for($i=0;$i<$size;$i++){
                    $result = mysql_query("SELECT ACTIVE FROM STUDTEST WHERE STUDUSER='$data->user' AND TESTID='".$array[$i][$test]."'");
                    $act = mysql_fetch_array($result);
                    $active = $act['ACTIVE'];
                    $studt = mysql_query("SELECT STUDUSER FROM STUDTEST WHERE TESTID='".$array[$i][$test]."'");
                    $studtest = mysql_fetch_array($studt);
                    $stdtest = $studtest['STUDUSER'];
                    $count = sizeof($stdtest);
                    array_push($array[$i], $s_code);
                    array_push($array[$i], $active);
                    array_push($array[$i], $count);
                  }
                  echo json_encode($array);
			        }

    		    ?>

	</body>
</html>
