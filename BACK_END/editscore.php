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
				mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
				mysql_select_db('ase28');
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
