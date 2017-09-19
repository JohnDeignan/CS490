       		<?php

                        			mysql_connect('server', 'username', 'password');
                        			mysql_select_db('dbname');
        			        $datastring = $_POST['data'];
                        			$data = json_decode($datastring);
                                    $user = $_POST['user'];
                                    $testid = $_POST['testid'];

                                    $result = mysql_query ("UPDATE INSTTEST SET ACTIVE='false' WHERE TESTID='$testid'");
                                    header("Location: https://web.njit.edu/~as23/frontend/insthp.php?user=$user");


        		?>
