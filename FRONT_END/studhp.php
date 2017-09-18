<!--

student homepage.

display(s):
-active tests [with option to take if not taken already]

action(s):
-active tests [with option to view results if already taken/released]

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
				echo "<li><a class='active' href='studhp.php?user=".$user."'><b>CODEQUIZ</b></a></li>";
				echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
				?>
			</ul>
		</div>
   <section class="container">
   <div id="centered">
            	<h2>
                	Current Tests:
            	</h2>
                     <?php

                    $data->user = $user;
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

                    $active = 5;
                    $tags = array("2", "4", "0");
                    $arrsize = sizeof($array);
                    $tagsize = sizeof($tags);
                     ?>
                                    <table class="table">
                                    <tr>

                                        <?php
                                                echo "<th>Test ID:</th>";
                                                echo "<th>Instructor Name:</th>";
                                                echo "<th>Test Name:</th>";
                                                echo "<th></th>";
                                                //MAKE NEW COLUMN FOR TOTAL POINTS OF TEST
                                        ?>

                                    </tr>

                                        <?php
                                            for($i = 0; $i<$arrsize; $i++){
                                              if($array[$i]->$active != "false"){
                                                echo "<tr>";
                                                for($x = 0; $x<$tagsize; $x++){
                                                      echo "<td>".$array[$i]->$tags[$x]."</td>";
                                                }
                                                echo "<td>";
                                                echo "<form action='studtake.php' method=POST>";
                                                echo "<input class='form-control' type='submit' value='TAKE TEST' />";
                                                echo "<input type='hidden' name='user' value='$data->user' />";
                                                echo "<input type='hidden' name='testid' value='".$array[$i]->TESTID."' />";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                              } else {
                                                echo "<tr>";
                                                for($x = 0; $x<$tagsize; $x++){
                                                      echo "<td>".$array[$i]->$tags[$x]."</td>";
                                                }
                                                echo "<td>";
                                                echo "<form  action='studview.php' method=POST>";
                                                echo "<input class='form-control' type='submit' value='VIEW RESULTS' />";
                                                echo "<input type='hidden' name='user' value='$data->user' />";
                                                echo "<input type='hidden' name='testid' value='".$array[$i]->TESTID."' />";
                                                echo "</form>";
                                                echo "</td>";
                                                echo "</tr>";
                                              }
                                            }
                                        ?>
                    </table>
       
        </div>
        </section>
	</body>
</html>
