<?php
header('Context-type: application/json');
if(isset($_POST['data'])){
    insert();
    exit();
}
?>
<html>
    <head>
        <title>Adam Elshoubri</title>
    </head>
    <body>
        <form action ='inserttestquestions.php' method = POST>
            		<input type = "hidden" name = "data">
     	  </form>
        <?php
          function insert(){
            mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            mysql_select_db('ase28');
            $json = $_POST['data'];
            $data = json_decode($json);
            $t_id = mysql_query("SELECT MAX(TESTID) AS MAX_ID FROM INSTTEST");
            $tid = mysql_fetch_array($t_id);
            $testid = $tid['MAX_ID'];
            $size = (count((array)$data))/2;
            $x=0;
            $y=1;
            for($i=0;$i<$size;$i++){
              $id = $data[$x];
              $amount = $data[$y];
              $x += 2;
              $y += 2;
              $res2 = mysql_query("INSERT INTO QUEST_TEST(QUESTID,TESTID,AMOUNT) VALUES('$id','$testid','$amount')");
            }
          }
          ?>
    </body>
</html>
