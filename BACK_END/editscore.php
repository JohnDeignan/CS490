<?php
header('Context-type: application/json');
if(isset($_POST['data'])){
  logInfo();
  exit();
}
?>
<html>
	<head>
		<title>Adam Elshoubri</title>
	</head>
	<body>
		<form action ='editscore.php' method = POST>
			<input type = "hidden" name = "data">
		</form>
		<?php
			function logInfo(){
				mysql_connect('server', 'username', 'password');
				mysql_select_db('dbname');
				$datastring = $_POST['data'];
				$data = json_decode($datastring);
				$sql = "UPDATE STUDTEST SET SCORE ='$data->score',COMMENT = '$data->comment' WHERE STUDUSER = '$data->user' AND TESTID ='$data->testid'";
				$result = mysql_query ($sql);
				if($result){
					echo 1;exit;
				}else {
					echo 2;exit;																			
				}
																											              }
																									
		?>																							
	</body>
</html>
