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
        <form action ='results.php' method = POST>
      		  <input type = "hidden" name = "data">
     	  </form>
    		<?php
    			    function logInfo(){
            			mysql_connect('server', 'username', 'password');
            			mysql_select_db('dbname');
    			        $datastring = $_POST['data'];
          			  $data = json_decode($datastring);

                  $result = mysql_query ("UPDATE INSTTEST SET ACTIVE= 'false' WHERE CODE = '$data->testcode'");

                }

    		?>

    </body>
</html>
