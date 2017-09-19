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
        <form action ='makequestion.php' method = POST>
            		<input type = "hidden" name = "data">
        	</form>

    		<?php
    			  function logInfo(){
            			mysql_connect('server', 'username', 'password');
            			mysql_select_db('dbname');
    		        	$datastring = $_POST['data'];
            			$data = json_decode($datastring);
                  $size = count((array)$data);     
                  for($i=0;$i<$size;$i++){
                      $set = mysql_query("DELETE FROM QUEST_TEST WHERE QUESTID='$data[$i]'");
                      $results = mysql_fetch_array($set);
                      $set1 = mysql_query("DELETE FROM QUESTIONBANK WHERE QUESTID='$data[$i]'");
                      $result1 = mysql_fetch_array($set1);
                  }
             }

    		  ?>

    </body>
</html>

