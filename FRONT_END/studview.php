<!--

allows student to view selected test which has been already released.

display(s):
-question text
-student's answer
-correct answer
-student's score
-comment(s) made on answer

action(s):
-banner option to logout or go to homepage

-->

<html>
        <head>
             <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href='style.css' rel='stylesheet'>
                <style>
                #navbar ul {
      list-style-type: none;
      margin: 0;
      padding:0;
      overflow: hidden;
      background-color: #333;
    }
    #navbar ul li {
      float: left;
      border-right: none;
      border-left: none;
    }
    #navbar ul li a{
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    #navbar ul li a:hover:not(.active){
      background-color: #111;
    }

    .active {
      background-color: #1E90FF;
    }
                </style>
        </head>
        <body>
        <div id="navbar">
            <ul>
                <?php
                $user = $_POST['user'];
                echo "<li><a href='studhp.php?user=".$user."'><b>CODEQUIZ</b></a></li>";
                echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
                ?>
            </ul>
        </div>
   <section class="container">
                 <?php

                    $data->user = $user;
                    $data->testid = $_POST['testid'];
                    $json = json_encode($data);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/backend/studentanswers.php');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    $contents = curl_exec($ch);
                    curl_close();
                    $array = json_decode($contents);
                                      $arrsize = sizeof($array)-1;
                     ?>
                                    <br/><table class="table">
                                    <tr>

                                        <?php
                                                echo "<th>Question:</th>";
                                                echo "<th>Your Answer:</th>";
                                                echo "<th>Correct Answer:</th>";
                                                echo "<th>Score:</th>";
                                                echo "<th>Comments:</th>";
                                        ?>

                                    </tr>

                                        <?php
                                            $qtext = 6;
                                            $corranswer = 7;
                                            $sanswer = 3;
                                            $score = 4;
                                            $comment = 5;
                                            for($i = 0; $i<$arrsize; $i++){
                                                echo "<tr>";
                                                echo "<td>".$array[$i]->$qtext."</td>";
                                                echo "<td>".$array[$i]->$sanswer."</td>";
                                                echo "<td>".$array[$i]->$corranswer."</td>";
                                                echo "<td>".$array[$i]->$score."</td>";
                                                echo "<td>".$array[$i]->$comment."</td>";
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                            echo "<h4>Final score: ".$array[(sizeof($array)-1)]."</h4>";
                                        ?>
                  </form>
        </section>
        </body>
</html>
