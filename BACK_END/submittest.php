<?php
if(isset($_POST['submit'])){
                    $send2 = array();
                    $user = $_POST['user'];
                    $send1->user=$user;
                    $questid = $_POST['id'];
                    $testname = $_POST['testname'];
                    $send1->testname = $testname;
                    $amount = $_POST['amount'];
                    $size = sizeof($questid);
                    for($i=0;$i<$size;$i++){
                        array_push($send2, $questid[$i]);
                        if(empty($amount[$i])){
                          array_push($send2, 5);
                        } else {
                          array_push($send2, $amount[$i]);
                        }
                    }

                    $json1 = json_encode($send1);
                    $json2 = json_encode($send2);

                    $ch = curl_init();
                   	curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/maketest.php');
                   	curl_setopt($ch, CURLOPT_POST, 1);
                   	curl_setopt($ch, CURLOPT_POSTFIELDS, array("insert"=>$json1));
                   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                   	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                   	$contents = curl_exec($ch);
                    curl_close($ch);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/inserttestquestions.php');
                    curl_setopt($ch, CURLOPT_POST, 1);
                   	curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json2));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    $contents = curl_exec($ch);
                    curl_close($ch);

                    header("Location: https://web.njit.edu/~ase28/frontend/insthp.php?user=$user");
}
?>
