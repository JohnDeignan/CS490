<!--

allow instructor to view submitted test(s).

display(s):
-student(s) which have submitted
-student(s) score

action(s):
-view desired student's test

-->

<html>
        <head>
                <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name "description" content="CodeQuiz">
        <meta name="author" content="John Deignan/Adam Elshoubri">
                <title>Instructor-Edit Results</title>
                <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link href='style.css' rel='stylesheet'>
                <style>
                body {
                  font-family: Trebuchet MS;
                  }
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
                $user = $_GET['user'];
                echo "<li><a href='insthp.php?user=".$user."'><b>CODEQUIZ</b></a></li>";
                echo "<li><a href='bank.php?user=".$user."'><b>Make Questions</b></a></li>";
                echo "<li><a href='create.php?user=".$user."'><b>Create Tests</b></a></li>";
                echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
                ?>
            </ul>
            </div>
        <section class="containter" style="width:40%;margin:auto;">
        <div id="centered">
                 <?php
                    $data->testid = $_GET['testid'];
                    $testid = $data->testid;
                    $data->user = $user;

                    $json = json_encode($data);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/backend/studenttests.php');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    $contents = curl_exec($ch);
                    curl_close();
                    $array = json_decode($contents);
                    $username = 0;
                    $studscore = 2;
                    $totalidx = 5;
                    $arrsize = sizeof($array);
                    echo "<form name='releasescore' id='releasescore' action='release.php?user=".$user." method=GET >";
                    echo "<input type='hidden' name='user' value='$user' />";
                    echo "<input type='hidden' name='testid' value='$testid' />";
                    echo "<br/><br/><input class='form-control' type='submit' name='release' style='width:60%;margin:auto;' value='Release All Scores' />";
                    echo "</form>";
                    echo "<br/><br/>";
                     ?>
                                    <table class="table" >
                                    <tr>

                                        <?php
                                                echo "<th>Student's Username:</th>";
                                                echo "<th>Score:</th>";
                                                echo "<th></th>";
                                        ?>

                                    </tr>

                                        <?php
                                            $idx = 0;
                                            for($i = 0; $i<$arrsize; $i++){
                                                echo "<tr>";
                                                echo "<td>".$array[$i]->$username."</td>";
                                                echo "<td>".$array[$i]->$studscore."/".$array[$i]->$totalidx."</td>";
                                                echo "<td>";
                                                echo "<form name='reviewtest' id='reviewtest' action='instedit.php' method=POST >";
                                                echo "<input type='submit' class='form-control' name='review' value='Review Test' />";
                                                echo "<input type='hidden' name='stuser' value=".$array[$i]->$username." />";
                                                echo "<input type='hidden' name='user' value=".$user." />";
                                                echo "<input type='hidden' name='testid' value='$testid' />";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                    </table>
        </body>
        </div>
        </section>
</html>
