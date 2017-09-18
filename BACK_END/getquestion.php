<?php
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
            <form action ='getquestion.php' method = POST>
                        		<input type = "hidden" name = "data">
 	      </form>

        		<?php
        			function select(){
                        			mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
                        			mysql_select_db('ase28');
       			                  $datastring = $_POST['data'];
                        			$data = json_decode($datastring);
                              $testid=$data->testid;
                        			$result = mysql_query("SELECT QUESTID, AMOUNT FROM QUEST_TEST WHERE TESTID='$testid'");
                                    $array = array();
                                    if($row = mysql_fetch_array($result)) {
                                        do{
                                                $array[] = $row;
                                        } while($row = mysql_fetch_array($result));
                                    }
                                    $size = sizeof($array);
                                    for($i=0;$i<$size;$i++){
                                      $arr[$i]=$array[$i][QUESTID];
                                    }
                                    $arrsize=sizeof($arr);
                                    for($i=0;$i<$arrsize;$i++){
                                      $result = mysql_query("SELECT QUESTION FROM QUESTIONBANK WHERE QUESTID='$arr[$i]'");
                                      $quest = mysql_fetch_array($result);
                                      $question[$i] = $quest['QUESTION'];
                                    }
                                    $questsize=sizeof($question);
                                    $x=0;
                                    for($i=0;$i<$questsize;$i++){
                                      $questions->$x=$question[$i];
                                      $x++;
                                      $questions->$x=$array[$i][QUESTID];
                                      $x++;
                                      $questions->$x=$array[$i][AMOUNT];
                                      $x++;
                                    }
                                    echo json_encode($questions);
            	}

        		?>

    </body>
</html>
