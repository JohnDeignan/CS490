<?php
if(isset($_POST['data'])){
   select();
   exit();
}
?>
<html>
    <head>
        <title>Adam Elshoubri</title>
    </head>
    <body>
      <form action ='getparam.php' method = POST>
            <input type = "hidden" name = "data">
      </form>

      <?php
      function select(){
      mysql_connect('sql1.njit.edu', 'ase28', 'aoFxdVBX3');
      mysql_select_db('ase28');
      $datastring = $_POST['data'];
      $data = json_decode($datastring);
      $result = mysql_query("SELECT * FROM QUESTPARAMS WHERE QUESTID='$data->questid'");
      $array = array();
      if($row = mysql_fetch_array($result)) {
      do{
      $array[] = $row;
      } while($row = mysql_fetch_array($result));
      }
      $size = count((array)$array);
      for($i=0;$i<$size;$i++){
      $info->$i = $array[$i];
      }
      echo json_encode($info);
      }
      ?>

  </body>
</html>
