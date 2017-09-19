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

             			$set = mysql_query("SELECT MAX(QUESTID) AS MAX_ID FROM QUESTIONBANK");
                      	$result = mysql_fetch_array($set);
                          $max = $result['MAX_ID'];
                          $max++;

                  $zero = 0;
                  var_dump($data->param1[$zero]);
                  $result = mysql_query ("INSERT INTO QUESTIONBANK(INSTUSER, QUESTID, TYPE, DIFFICULTY, QUESTION, ANSWER) VALUES('$data->user','$max'
       			             ,'$data->type','$data->difficulty','$data->question', '$data->answer')");
                  
                  $size = sizeof($data->param1);
                  for($i=0;$i<$size;$i++){
                    $param1=$data->param1[$i];
                    $param2=$data->param2[$i];
                    $param3=$data->param3[$i];
                    $param4=$data->param4[$i];
                    $sql = mysql_query("INSERT INTO QUESTPARAMS(QUESTID, PARAM1, PARAM2, PARAM3, PARAM4) VALUES('$max','$param1','$param2', '$param3', '$param4')");
                  }
                  
             }

    		  ?>

    </body>
</html>

