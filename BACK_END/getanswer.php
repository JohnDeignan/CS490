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
                        <form action ='getanswer.php' method = POST>
                                                        <input type = "hidden" name = "data">
                </form>

                        <?php
                            function select(){
                                                            mysql_connect('server', 'username', 'password');
                                                            mysql_select_db('dbname');
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
                                                                            $answers->$i->AMOUNT=$array[$i][AMOUNT];
                                                                        }
                                                                        $arrsize=sizeof($arr);
                                                                        for($i=0;$i<$arrsize;$i++){
                                                                            $result = mysql_query("SELECT ANSWER FROM QUESTIONBANK WHERE QUESTID='$arr[$i]'");
                                                                            $ans= mysql_fetch_array($result);
                                                                            $answer[$i] = $ans['ANSWER'];
                                                                        }
                                                                        $questsize=sizeof($answer);
                                                                        for($i=0;$i<$questsize;$i++){
                                                                            $answers->$i->ANSWER=$answer[$i];
                                                                        }                                                                    
  
                                                                        echo json_encode($answers);
                            }

                        ?>

        </body>
</html>
