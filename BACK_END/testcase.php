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
		<form action ='testcase.php' method = POST>
			<input type = "hidden" name = "data">
		</form>
		<?php
			function logInfo(){
				mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
				mysql_select_db('ase28');   
				$datastring = $_POST['data'];
				$data = json_decode($datastring);
				$id = mysql_query("SELECT QUESTID AS ID FROM QUESTIONBANK WHERE QUESTID ='$data->questid'");
				$quest_id = mysql_fetch_array($id);
				$id = $quest_id['ID'];
				$sql = "INSERT INTO QUESTPARAMS(QUESTID, PARAM1, PARAM2, PARAM3, PARAM4) VALUES('$id','$data->param1','$data->param2', '$data->param3', '$data->param4')";
				$result = mysql_query($sql);
			}
		?>

	</body>
</html>
