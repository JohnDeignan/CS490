<!--

allows instructor to create test from questions in question bank.

display(s):
-all question(s) in question bank on left half of screen
  -question type
  -question difficulty
  -question text
-all currently selected test questions on right half of screen [test bank]
-left/right arrows in middle of screen for selections
-running total of all point values in test bank

action(s):
-click question in question bank
  -question is then highlighted green
  -select right arrow in middle of screen to add to test bank
    -question selected now has opacity lowered and table row is locked
-click question in test bank
  -question is then highlighted gray
  -select left arrow to remove question from test bank
    -question is no longer highlighted green and is no longer locked in question bank
-once question is in test bank, option to add specific point value [default: 5]
-add name of test in test bank on right half of screen


-->

<html>
        <head>
                <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name "description" content="CodeQuiz">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Instructor- Create Test</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
        <link href='style.css' rel='stylesheet'>
                <script>
         function initfilter() {
         // Declare variables
         var input, filter, table, tr, td, i;
         var input1, filter1, table1, td1;
         input = document.getElementById("inittype");
         filter = input.value.toUpperCase();
         table = document.getElementById("init");
         input1 = document.getElementById("initdiff");
         filter1 = input1.value.toUpperCase();
         tr = table.getElementsByTagName("tr");

         // Loop through all table rows, and hide those who don't match the search query
         for (i = 0; i < tr.length; i++) {
             td = tr[i].getElementsByTagName("td")[1];
             td1 = tr[i].getElementsByTagName("td")[2];
             if (td && td1) {
                 if(filter1=="0"){
                   if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                     tr[i].style.display = "";
                   } else {
                        tr[i].style.display = "none";
                   }
                 } else {
                   if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) && (td1.innerHTML.toUpperCase().indexOf(filter1) > -1)) {
                       tr[i].style.display = "";
                   } else {
                          tr[i].style.display = "none";
                   }
                 }
             }

         }
         }

         function finalfilter() {
         // Declare variables
         var input, filter, table, tr, td, i;
         var input1, filter1, table1, td1;
         input = document.getElementById("finaltype");
         filter = input.value.toUpperCase();
         table = document.getElementById("final");
         input1 = document.getElementById("finaldiff");
         filter1 = input1.value.toUpperCase();
         tr = table.getElementsByTagName("tr");

         // Loop through all table rows, and hide those who don't match the search query
         for (i = 0; i < tr.length; i++) {
             td = tr[i].getElementsByTagName("td")[1];
             td1 = tr[i].getElementsByTagName("td")[2];
             if (td && td1) {
                 if(filter1=="0"){
                   if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                     tr[i].style.display = "";
                   } else {
                        tr[i].style.display = "none";
                   }
                 } else {
                   if ((td.innerHTML.toUpperCase().indexOf(filter) > -1) && (td1.innerHTML.toUpperCase().indexOf(filter1) > -1)) {
                       tr[i].style.display = "";
                   } else {
                          tr[i].style.display = "none";
                   }
                 }
             }

         }
         }

         var initRowChosen = [];
         function initChosen(tr){
           var bg = tr.style.backgroundColor;
           var op = tr.style.opacity;
           var bbg = document.body.style.backgroundColor;
           if(inTable.indexOf(tr.rowIndex) == -1){
             if(bg == "lightgreen"){
               tr.style.backgroundColor=bbg;
               var idx = tr.rowIndex
               var index = initRowChosen.indexOf(idx);
               if(index > -1) {
                 initRowChosen.splice(index, 1);
               }
             } else{
                 initRowChosen.push(tr.rowIndex);
                 tr.style.backgroundColor="lightgreen";
             }
           }
         }

         var finalRowChosen = [];
         function finalChosen(tr){
           var bg = tr.style.backgroundColor;
           var bbg = document.body.style.backgroundColor;
           if(bg == "gray"){
             tr.style.backgroundColor=bbg;
             var idx = tr.rowIndex
             var index = finalRowChosen.indexOf(idx);
             if(index > -1) {
               finalRowChosen.splice(index, 1);
             }
           } else {
             finalRowChosen.push(tr.rowIndex);
             tr.style.backgroundColor="gray";
           }
         }

         var inTable = [];
         var arr = document.getElementsByName('amount[]');
         var tot = 0;

         function move(){
         var table, tr, td, i;
         var td1,td2,td3;
         table = document.getElementById("init");
         tr = table.getElementsByTagName("tr");
         initRowChosen.sort(compareNumbers);

         var table1 = document.getElementById("final");
         // Loop through all table rows, and hide those who don't match the search query
         for (i = 0; i < initRowChosen.length; i++) {
             if(inTable.indexOf(initRowChosen[i]) == -1){
             inTable.push(initRowChosen[i]);
             var count = table1.rows.length;
             var row = table1.insertRow(count);
             row.setAttribute("onclick", "finalChosen(this);");
             td = tr[initRowChosen[i]].getElementsByTagName("td")[0];
             td1 = tr[initRowChosen[i]].getElementsByTagName("td")[1];
             td2 = tr[initRowChosen[i]].getElementsByTagName("td")[2];
             td3 = tr[initRowChosen[i]].getElementsByTagName("td")[3];
             tr[initRowChosen[i]].style.opacity = "0.5";
             tr[initRowChosen[i]].style.backgroundColor = "lightgreen";

             var textbox = document.createElement('input');
             var hidden = document.createElement('input');
             hidden.setAttribute("type", "hidden");
             hidden.setAttribute("name", "id[]");
             hidden.setAttribute("value", td.innerText);
             textbox.setAttribute("type", "text");
             textbox.setAttribute("style", "width:27px;");
             textbox.setAttribute("name", "amount[]");
             textbox.setAttribute("onblur", "getTotal()");
             var cell1 = row.insertCell(0);
             var cell2 = row.insertCell(1);
             var cell3 = row.insertCell(2);
             var cell4 = row.insertCell(3);
             var cell5 = row.insertCell(4);
             cell1.innerHTML = td.innerHTML;
             cell1.setAttribute("name", "questid[]");
             cell2.innerHTML = td1.innerHTML;
             cell3.innerHTML = td2.innerHTML;
             cell4.innerHTML = td3.innerHTML;
             cell5.appendChild(textbox);
             cell1.appendChild(hidden);
         tot += 5;
             }
           }
           while(initRowChosen.length != 0){
               initRowChosen.pop();
           }
           initRowChosen.splice(0, initRowChosen.length);
       document.getElementById('total').value = tot;
         }

         function remove(){
         var table = document.getElementById("final");
         var table1 = document.getElementById("init");
         finalRowChosen.sort(compareNumbers);
         // Loop through all table rows, and hide those who don't match the search query
         if(finalRowChosen.length != 0){
           for (var i = (finalRowChosen.length-1); i >= 0; i--) {
                 var tr = table1.getElementsByTagName("tr")[inTable[finalRowChosen[i]-1]];
                 var bbg = document.body.style.backgroundColor;
                 tr.style.opacity="1";
                 tr.style.backgroundColor=bbg;
                 table.deleteRow(finalRowChosen[i]);
                 inTable.splice((finalRowChosen[i]-1), 1);
         tot -= 5;
           }
         }
         while(finalRowChosen.length != 0){
           finalRowChosen.pop();
         }
         finalRowChosen.splice(0,finalRowChosen.length);
     document.getElementById('total').value = tot;
         }

         function getTotal(){
             tot = 0;
             for(var i = 0; i < arr.length; i++){
                 if(parseInt(arr[i].value) > 0){
                     tot += parseInt(arr[i].value);
                 } else {
             tot += 5;
         }
             }
         if(tot == 0){
        tot = 5 * inTable.length;
         }
             document.getElementById('total').value = tot;
         }

         function compareNumbers(a, b){
           return a-b;
         }
      </script>
                <style style="text/css">
         * {
         box-sizing: border-box;
         }
         body {
         backgroun-color="white";
         font-size:1.4rem; 
         font-family: Trebuchet MS;
         line-height: 150%;
         }
         section {
         text-align: center;
         }
         article {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         width: 100%;
         padding: 20px;
         }
         h1 {
         font-size: 5.0rem;
         text-align: center;
         }
         /* Pattern styles */
         .container {
         display: table;
         width: 100%;
         }
         .left {
         border: 2px solid black;
         border-radius: 5px;
         text-align: center;
         border-width: 70%;
         padding-right: 100px;
         padding-left: 100px;
         position: absolute;
         left: 2%;
         top: 65px;
         width: 45%;
         }
         .right {
         border: 2px solid black;
         border-radius: 5px;
         border-width: 70%;
         text-align: center;
         padding-right: 100px;
         padding-left: 100px;
         position: absolute;
         right: 2%;
         top: 65px;
         width: 45%;
         }
         .wrapper {
         position: fixed;
         top: 50%;
         left: 49%;
         z-index:1;
         }
         .b1{
         background: url(http://i.imgur.com/ol7759h.png) 0 0 transparent;
         border: none;
         width: 40px;
         height: 40px;
         color: transparent;
         background-size: 100%;
         background-size: 40px auto;
         margin-bottom:0;
         }
         .b1:hover{
         background: url(http://i.imgur.com/ol7759h.png) 0 0 transparent;
         opacity: 0.5;
         border: none;
         width: 40px;
         height: 40px;
         color: transparent;
         background-size: 100%;
         background-size: 40px auto;
         margin-bottom:0;
         }
         .b2{
         background: url(http://i.imgur.com/yDQYb62.png) 0 0 transparent;
         border: none;
         width: 40px;
         height: 40px;
         color: transparent;
         background-size: 100%;
         background-size: 40px auto;
         margin-bottom:0;
         }
         .b2:hover{
         background: url(http://i.imgur.com/yDQYb62.png) 0 0 transparent;
         opacity: 0.5;
         border: none;
         width: 40px;
         height: 40px;
         color: transparent;
         background-size: 100%;
         background-size: 40px auto;
         margin-bottom:0;
         }
         .table td {
         cursor: pointer;
         }
         .table td {
         cursor: pointer;
         }
         #total{
         border: 0px none;
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
                echo "<li><a class='active' href='create.php?user=".$user."'><b>Create Tests</b></a></li>";
                echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
                ?>
            </ul>
        </div>
   <body>
      <?php
         $datastring = $_GET['user'];
         $data->user = $datastring;
         $json = json_encode($data);

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/maketest.php');
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, array("select"=>$json));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($ch, CURLOPT_HEADER, false);
         $contents = curl_exec($ch);
         curl_close($ch);

         $array = json_decode($contents);
         $tags = array("QUESTID", "TYPE", "DIFFICULTY", "QUESTION");
         $arrsize = sizeof($array);
         $tagsize = sizeof($tags);
         ?>
      <section class="container">
         <div class="left">
            <h2>Question Bank</h2>
            <br/><label for="inittype">Filter By Type:</label>
        <input type="text" class="form-control" id="inittype" onkeyup="initfilter()" placeholder="Search Type..." style="width:35%;margin:auto;"><br/>
        <label for="initdiff">Filter By Difficulty:</label>
            <select class="form-control" id="initdiff" onChange="initfilter()" style="width:35%;margin:auto;">
               <option value="0">Select a Difficulty</option>
               <option value="1">1. Very Easy</option>
               <option value="2">2. Easy</option>
               <option value="3">3. Medium</option>
               <option value="4">4. Hard</option>
               <option value="5">5. Very Hard</option>
            </select>
            <br/><br/>
            <table class="table" id="init" style="font-size:1.2rem;">
               <thead >
                  <th>Question ID:</th>
                  <th>Question Type:</th>
                  <th style="width:100px;">Question Difficulty:</th>
                  <th>Question Text:</th>
               </thead>
               <tbody>
                  <?php
                     for($i = 0; $i<$arrsize; $i++){
                             echo "<tr onclick='initChosen(this);'>";
                             echo "<td id='questid'>".$array[$i]->QUESTID."</td>";
                             echo "<td id='questtype'>".$array[$i]->TYPE."</td>";
                             if($array[$i]->DIFFICULTY == "1"){
                             	echo "<td>(1) Very Easy</td>";
                 } else if($array[$i]->DIFFICULTY == "2"){
                             	echo "<td>(2) Easy</td>";
                 } else if($array[$i]->DIFFICULTY == "3"){
                             	echo "<td>(3) Medium</td>";
                 } else if($array[$i]->DIFFICULTY == "4"){
                             	echo "<td>(4) Hard</td>";
                 } else if($array[$i]->DIFFICULTY == "5"){
                             	echo "<td>(5) Very Hard</td>";
                 }
                             echo "<td id='question'>".$array[$i]->QUESTION."</td>";
                             echo "</tr>";
                     }
                     ?>
               </tbody>
            </table>
         </div>
         <div class="wrapper">
            <button class="b1" id="b1" onclick="move()" ></button><br/><br/>
            <button class="b2" id="b2" onclick="remove()" ></button>
         </div>
         <div class="right">
            <h2>Test Bank</h2>
            <br/><label for="finaltype">Filter By Type:</label>
        <input class="form-control" type="text" id="finaltype" onkeyup="finalfilter()" placeholder="Search Type..." style="width:35%;margin:auto;"><br/>
            <label for="finaldiff">Filter By Difficulty:</label>
            <select class="form-control" id="finaldiff" onChange="finalfilter()" style="width:35%;margin:auto;">
               <option value="0">Select a Difficulty</option>
               <option value="1">1. Very Easy</option>
               <option value="2">2. Easy</option>
               <option value="3">3. Medium</option>
               <option value="4">4. Hard</option>
               <option value="5">5. Very Hard</option>
            </select>
            <br/><br/>
            <form action="submittest.php" method=POST>
               <table class="table" id="final" style="font-size:1.2rem;">
                  <thead>
                     <th>Question ID:</th>
                     <th>Question Type:</th>
                     <th style="width:100px;">Question Difficulty:</th>
                     <th>Question Text:</th>
                     <th>Point Value:</th>
                  </thead>
               </table>
               <input type="hidden" name="user" value="<?php echo $datastring; ?>" />
               <b>Total Points: </b><input type="text" name="total" id="total" style="width:35px;background-color:white;" disabled/>
        <p style="font-size: .9rem;color:red">Default Point Value: 5</p><br/>
               <label for="testname"><b>Test Name: </b></label><input type="text" class="form-control" name="testname" placeholder="Enter Test Name..." style="width:35%;margin:auto;" /><br/><br/>
               <div class="control-group">
                  <input class="form-control" style="width:25%;margin:auto;" type="submit" value="Create Test" name="submit">
               </div>
               <br/>
            </form>
         </div>
      </section>
   </body>
</html>
