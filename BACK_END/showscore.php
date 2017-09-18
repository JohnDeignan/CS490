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
        <form action ='showscore.php' method = POST>
      		  <input type = "hidden" name = "data">
     	  </form>
    		<?php
    			function logInfo(){
            			mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            			mysql_select_db('ase28');
    			        $datastring = $_POST['data'];
			            $data = json_decode($datastring);
                  $result = mysql_query ("SELECT * FROM STUDTEST WHERE STUDUSER = '$data->user'");               
			            $array = array();
		 	            if($row = mysql_fetch_array($result)) {
					          do{
						          $array[] = $row;															     
					          } while($row= mysql_fetch_array($result));
			            }
				          echo json_encode($array);
           }
		   ?>
     </body>
</html>

