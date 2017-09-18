<!--

instructor homepage.

-access question bank
-create test
-view results of submitted tests

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
                $user = $_GET['user'];
                echo "<li><a class='active' href='insthp.php?user=".$user."'><b>CODEQUIZ</b></a></li>";
                echo "<li><a href='bank.php?user=".$user."'><b>Make Questions</b></a></li>";
                echo "<li><a href='create.php?user=".$user."'><b>Create Tests</b></a></li>";
                echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
                ?>
            </ul>
        </div>
                <?php

                    $data->user = $_GET['user'];
                    $user = $data->user;
                    $json = json_encode($data);
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/backend/gettest.php');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    $contents = curl_exec($ch);
                    curl_close();
                    $array = json_decode($contents);

                    $tags = array("2", "0", "6");
                    $arrsize = sizeof($array);
                    $tagsize = sizeof($tags);
                     ?>
                                 <section class="container">
                                 <div id="centered">
                                    <br/><p style="font-size:2rem;margin:auto;"><b>Active Tests:</b></p>
                                    <table class="table" id="insttable" style="width:100%;margin:auto;"> <br/>
                                    <tr>

                                        <?php
                                                echo "<th>Test ID:</th>";
                                                echo "<th>Test Name:</th>";
                                                echo "<th>Submitted Tests:</th>";
                                                echo "<th></th>";
                                        ?>

                                    </tr>

                                        <?php
                                            $testid = 2;
                                            $tname = 0;
                                            $numsubmitted = 6;
                                            for($i = 0; $i<$arrsize; $i++){
                                                echo "<tr>";
                                                echo "<td>".$array[$i]->$testid."</td>";
                                                echo "<td>".$array[$i]->$tname."</td>";
                                                echo "<td>".$array[$i]->$numsubmitted."</td>";
                                                echo "<td>";
                                                $currid = $array[$i]->$testid;
                                                echo "<form id='instform' action='instview.php' method=GET>";
                                                echo "<input class='form-control' type='submit' value='View Results' />";
                                                echo "<input type='hidden' name='user' value=".$user." />";
                                                echo "<input type='hidden' name='testid' value=".$currid." />";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                        </div>
                                </section>
        </body>
</html>
