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
        <form action ='studenttests.php' method = POST>
      		  <input type = "hidden" name = "data">
     	  </form>
    		<?php
    			function logInfo(){
            			mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            			mysql_select_db('ase28');
    			        $datastring = $_POST['data'];
            			$data = json_decode($datastring);

                  $result = mysql_query ("SELECT * FROM STUDTEST WHERE TESTID='$data->testid'");
                  $array = array();
        			      if($row = mysql_fetch_array($result)) {
                                do{
                                      $array[] = $row;
                                } while($row= mysql_fetch_array($result));
        			      }

                  $result = mysql_query ("SELECT AMOUNT FROM QUEST_TEST WHERE TESTID='$data->testid'");
                  $amount = array();
        			      if($row = mysql_fetch_array($result)) {
                                do{
                                      $amount[] = $row;
                                } while($row= mysql_fetch_array($result));
        			      }
                 $size = count((array)$amount);
                 $total = 0;
                 $idx = 0;
                 for($i=0;$i<$size;$i++){
                   $total += (int) preg_replace('/[^0-9]/', '', $amount[$i][$idx]);
                 }
                 $size = count((array)$array);
                 for($i=0;$i<$size;$i++){
                   array_push($array[$i], $total);
                 }
                  echo json_encode($array);

                }


    		?>

    </body>
</html>
