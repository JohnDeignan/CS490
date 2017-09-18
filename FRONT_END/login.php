<!--

https://web.njit.edu/~ase28/frontend/login.php

simple login page.

instructor log info: user - instructor, pwd - instructor
student log info: user - student, pwd - student

-->

<html>
        <head>
                <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href='style.css' rel='stylesheet'>
        </head>
        <body>
        <section class="container" style="width:20%;">
    		  <h1>
          		CodeQuiz
        	</h1>
    <table>
		<form action="login.php" method=POST>
    				<b>Email:</b>
      					<input type="text" class="form-control" id="inputEmail3" placeholder="Username" name="user" /><br/>
   				  <b>Password:</b>
      					<input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pass" /><br/>
      					<div class="checkbox">
        					<label>
          						<input type="checkbox"> Remember me
        					</label>
      					</div><br/>
      					<button type="submit" class="btn btn-default">Sign in</button>
		</form>

                <?php
                function logInfo(){
                        $user = $_POST['user'];
                        $data->user = $_POST['user'];
                        $data->pass = $_POST['pass'];
                        
                        $json = json_encode($data);

                        $ch = curl_init();                        
                        
                        curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/backend/login_db.php');
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($ch, CURLOPT_HEADER, false);
                        $contents = curl_exec($ch);
                        curl_close();

                        $array = json_decode($contents);


                        if($array->studSuccess == true){
                            header("Location: https://web.njit.edu/~ase28/frontend/studhp.php?user=$user");
                        } elseif ($array->instSuccess == true) {
                            header("Location: https://web.njit.edu/~ase28/frontend/insthp.php?user=$user");
                        } else {
                            echo "Username/password incorrect.";
                        }
                }
                if(isset($_POST['user']) && isset($_POST['pass'])){
                        logInfo();
                        exit();
                }
                ?>
          </table>
          </section>
        </body>
</html>
