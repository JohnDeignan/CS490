<?php
  if(isset($_POST['select'])){
      select();
    exit();
  }
if(isset($_POST['insert'])){
        insert();
        exit();
}
?>
<html>
    <head>
        <title>Adam Elshoubri</title>
    </head>
    <body>
        <form action ='maketest.php' method = POST>
         	<input type = "hidden" name = "select">
                <input type = "hidden" name = "insert">
 	  </form>
 	</body>
</html>
<?php
    			function insert(){
                          mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            			mysql_select_db('ase28');
       			        $insertstring = $_POST['insert'];
            			$insert = json_decode($insertstring);

                  $code = mysql_query ("SELECT CODE AS ICODE FROM Instructor WHERE INSTUSER = '$insert->user'");
                        $cd = mysql_fetch_array($code);
                  $c = $cd['ICODE'];
                  $t_id = mysql_query ("SELECT MAX(TESTID) AS MAX_ID FROM INSTTEST ");
                  $tid = mysql_fetch_array($t_id);
                  $testid = (int)$tid['MAX_ID'];
                  $testid++;
                  $id=(string)$testid;
                  $res = mysql_query ("INSERT INTO INSTTEST(TNAME, CODE, TESTID, ACTIVE) VALUES('$insert->testname', '$c', '$id', 'true')");
                }

                function select(){
            			mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            			mysql_select_db('ase28');
       			        $selectstring = $_POST['select'];
            			$select = json_decode($selectstring);
            			$result = mysql_query ("SELECT * FROM QUESTIONBANK WHERE INSTUSER = '$select->user'");

                          $array = array();
        			      if($row = mysql_fetch_array($result)) {
                                do{
                                      $array[] = $row;
                                } while($row= mysql_fetch_array($result));
        			      }
        			      echo json_encode($array);
          }

?>
