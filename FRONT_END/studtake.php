<!--

allows student to take test.

-show all test question(s) 
---show question text
---show question worth (i.e. [x points])
---text area below question for students answer

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
                echo "<li><a class='active' href='studtake.php?user=".$user."'><b>Take Tests</b></a></li>";
                echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
                ?>
            </ul>
        </div>
   <section class="container">
                 <form action="studgrade.php" method=POST>
                     <?php
                    $user = $_POST['user'];
                    $testid = $_POST['testid'];
                    $data->testid=$testid;
                    $json = json_encode($data);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/backend/getquestion.php');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    $contents = curl_exec($ch);
                    curl_close($ch);
                    $array=json_decode($contents);
                    ?>
                    <form action="studgrade.php" method=POST>
                    <?php
                    $size=(count((array)$array))/3;

                    $x=0;
                    $y=1;
                    $z=2;
                    echo "<br/><br/>";
                    for($i=0;$i<$size;$i++){
                        echo ($i+1).". <label for='answertext'>(".$array->$z." points)</label> ".$array->$x;
                        echo "<textarea class='form-control' style='width:60%;height:300;margin:auto;' name='answer[]' id='answertext' placeholder='Type Answer Here...'></textarea><br/><br/>";
                        echo '<input type="hidden" name="id[]" value="'.$array->$y.'" >';
                        $x+=3;
                        $y+=3;
                        $z+=3;
                    }

                    ?>
                    <input type="hidden" name="user" value=<?php echo $user; ?> />
                    <input type="hidden" name="testid" value=<?php echo $testid; ?> />
                    <input class="form-control" style="width:35%;margin:auto;"type="submit" value="Submit Test" />
                </form>
        </body>
        </section>
</html>
