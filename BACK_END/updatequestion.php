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
        <form action ='updatequestion.php' method = POST>
            		<input type = "hidden" name = "data">
        	</form>

    		<?php
    			  function logInfo(){
            			mysql_connect('server', 'username', 'password');
            			mysql_select_db('dbname');
    		        	$datastring = $_POST['data'];
            			$data = json_decode($datastring);
                  $size = count((array)$data);
                  $set1 = mysql_query("UPDATE QUESTIONBANK SET QUESTION='$data->question', TYPE='$data->type', DIFFICULTY='$data->difficulty', ANSWER='$data->answer' WHERE QUESTID='$data->questid'");
             }

    		  ?>

    </body>
</html>

