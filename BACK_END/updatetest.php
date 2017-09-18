                <?php
                    $testid = $_POST['testid'];
                    $user = $_POST['user'];
                    $instuser = $_POST['instuser'];
                    $scores = $_POST['scores'];
                    $questid = $_POST['questid'];
                    $comment = $_POST['comment'];
                    mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
            		  	mysql_select_db('ase28');
                    $size = count((array)$scores);
                    $total = 0;
                    echo "INSTUSER: ".$instuser;echo "<br/>";
                    echo "TESTID : ".$testid;echo "<br/>";
                    echo "USERNAME: ".$user;echo "<br/>";
                    echo "SCORES: "; print_r($scores);echo "<br/>";
                    echo "QUESTIDS: "; print_r($questid); echo "<br/>";
                    echo "COMMENT: ".$comment;
                    for($i=0;$i<$size;$i++){
                      $result = mysql_query ("UPDATE STUDANSWERS SET SCORE='$scores[$i]' WHERE TESTID='$testid' AND STUDUSER='$user' AND QUESTID='$questid[$i]'");
                      $total += $scores[$i];
                   }
                   $result = mysql_query ("UPDATE STUDTEST SET SCORE='$total', COMMENT='$comment' WHERE TESTID='$testid' AND STUDUSER='$user'");
                   header("Location: https://web.njit.edu/~ase28/frontend/insthp.php?user=".$instuser."");
                ?>
