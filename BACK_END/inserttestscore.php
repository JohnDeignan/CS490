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
        <form action ='inserttestscore.php' method = POST>
            		<input type = "hidden" name = "data">
     	  </form>
        <?php
          function insert(){
            mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            mysql_select_db('ase28');
            $json = $_POST['data'];
            $data = json_decode($json);
            $res2 = mysql_query("INSERT INTO STUDTEST(STUDUSER,TESTID,SCORE, COMMENT, ACTIVE) VALUES('$data->user','$data->testid','$data->score','','false')");
          }
          ?>
    </body>
</html>
