<!--

allow instructor to add/remove/edit question(s) in question bank.

display(s):
-form to fill details of question to be added on left half of screen
-all question(s) currently in question bank and all information associated with them

action(s):
-add question text, type of question, difficulty, answer, and a maximum of 4 test cases
  -selecting 'add question' submits the question into the question bank and allows it to appear in the question bank
-selecting 'Edit' next to a question already in the question bank fills the left hand with all information about quesiton selected
  -the instructor can then edit any part of the question and 're-submit' it to the question bank
-selecting button(s) under 'Remove' and clicking 'Remove Selected Question(s)' allows selected questions to be deleted from the question bank
-dynamically filter questions in question bank by type, difficulty, or both
-->

<?php
   if(isset($_POST['add'])){
       logInfo();
       die();
   }
   if(isset($_POST['submit'])){
       remove();
       die();
   }
   if(isset($_POST['submitEdit'])){
       edit();
       die();
   }
   ?>
<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href='style.css' rel='stylesheet'>
      <title>Question Bank</title>
      <script>
               function filter() {
                 // Declare variables  
                 var input, filter, table, tr, td, i;
                 var input1, filter1, table1, td1;
                 input = document.getElementById("filtType");
                 filter = input.value.toUpperCase();
                 table = document.getElementById("questions");
                 input1 = document.getElementById("diff");
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
               var i = 0;
               function add() {
               if(i < 3){
                   var table = document.getElementById("param");
                   var row = table.insertRow(i);
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   var cell4 = row.insertCell(3);
                   cell1.innerHTML = "<input type='text' name='param1[]' placeholder='Parameter 1...'>";
                   cell2.innerHTML = "<input type='text' name='param2[]' placeholder='Parameter 2...'>";
                   cell3.innerHTML = "<input type='text' name='param3[]' placeholder='Parameter 3...'>";
                   cell4.innerHTML = "<input type='text' name='param4[]' placeholder='Parameter 4...'>";
                   i++;
                 } else {
                 alert("Cannot have more than 4 test cases.");
                 }
                 return false;
               }
               function remove() {
               if(i > 0){
                   var table = document.getElementById("param");
                   var row = table.deleteRow(i);
                   i--;
                 } else {
                 alert("Cannot remove all test cases.");
                 }
                 return false;
               }
      function editQuestion(button){
        var table = document.getElementById("questions");
        var tr = table.getElementsByTagName("tr");
        var td0 = tr[button.parentNode.parentNode.rowIndex].getElementsByTagName("td")[0];
        var td1 = tr[button.parentNode.parentNode.rowIndex].getElementsByTagName("td")[1];
        var td2 = tr[button.parentNode.parentNode.rowIndex].getElementsByTagName("td")[2];
        var td3 = tr[button.parentNode.parentNode.rowIndex].getElementsByTagName("td")[3];
        var td4 = tr[button.parentNode.parentNode.rowIndex].getElementsByTagName("td")[4];
        if(td2.innerText == "(1) Very Easy"){
          document.getElementById('difficulty').value = "veasy";
        } else if(td2.innerText == "(2) Easy"){
          document.getElementById('difficulty').value = "easy";
        } else if(td2.innerText == "(3) Medium"){
          document.getElementById('difficulty').value = "medium";
        } else if(td2.innerText == "(4) Hard"){
          document.getElementById('difficulty').value = "hard";
        } else if(td2.innerText == "(5) Very Hard"){
          document.getElementById('difficulty').value = "vhard";
        }
        document.getElementById('questid').value = td0.innerText;
        document.getElementById('type').value = td1.innerText;
        document.getElementById('question').value = td3.innerText;
        document.getElementById('answer').value = td4.innerText;

        var submit = document.getElementById('add');
        submit.innerHTML = "Submit Edit";
        submit.setAttribute("id", "submitEdit");
        submit.setAttribute("name", "submitEdit");
        var paramTable = document.getElementById('param');
        paramTable.style.display = 'none';
        var paramText = document.getElementById('testCase');
        paramText.style.display = 'none';
        var addB = document.getElementById('addButton');
        addB.style.display = 'none';
        var removeB = document.getElementById('removeButton');
        removeB.style.display = 'none';
      }
      </script>
      <style>
         * {
         box-sizing: border-box;
         }
         body {
         font-size: 1.4rem;
         font-family: Trebuchet MS;
         line-height: 150%;
         }
         section {
         text-align: center;
         }
         div {
         height: 100%;
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
         font-size: 1.4rem;
         padding-right: 100px;
         padding-left: 100px;
         position: fixed;
         left: 0px;
	 top:70px;
         width: 50%;
         }
         .right {
         font-size: 1.4rem;
         padding-right: 100px;
         padding-left: 100px;
         position: absolute;
         right: 0px;
	 top:55px;
         width: 50%;
         }
	 .shrink{
	 -webkit-transform:scale(0.85);
	 -moz-transform:scale(0.85);
	 -ms-transform:scale(0.85);
	 transform:scale(0.85);
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
				echo "<li><a class='active' href='bank.php?user=".$user."'><b>Make Questions</b></a></li>";
				echo "<li><a href='create.php?user=".$user."'><b>Create Tests</b></a></li>";
				echo "<li style='float:right'><a href='login.php'><b>Log Out</b></a></li>";
				?>
			</ul>
		</div> 
	<section class="container">
         <div class="left">	    
            <form id="submit" method=POST> 
               <label for="quest">Question text:</label>	       
               <input class="form-control" type="text" id="question" name="question" style="width:75%;margin:auto;" placeholder="Type Question Here..." /><br/>
               <label for="type">Type of Question:</label>
               <select class="form-control" id="type" name="type" style="width:35%;margin:auto;">
                  <option value="" disabled selected>Select a Type</option>
                  <optgroup label="General">
                     <option value="General">General</option>
                     <option value="Arrays">Arrays</option>
                     <option value="Recursion">Recursion</option>
                  </optgroup>
                  <optgroup label="Statements">
                     <option value="If Statement">If statement</option>
                     <option value="If-Else Statement">If-Else statement</option>
                     <option value="If-Else If Statement">If-Else-If statement</option>
                     <option value="Switch Statement">Switch statement</option>
                  </optgroup>
                  <optgroup label="Loops">
                     <option value="For Loop">For Loop</option>
                     <option value="While Loop">While Loop</option>
                     <option value="Do-While Loop">Do-While Loop</option>
                  </optgroup>
               </select>
               <label for="difficulty">Difficulty of Question:</label>
               <select class="form-control" name="difficulty" id="difficulty" style="width:35%;margin:auto;">
                  <option value="" disabled selected>Select a Difficulty</option>
                  <option value="veasy">1. Very Easy</option>
                  <option value="easy">2. Easy</option>
                  <option value="medium">3. Medium</option>
                  <option value="hard">4. Hard</option>
                  <option value="vhard">5. Very Hard</option>
               </select>
               <br/>
               <label for="answer">Answer: </label> <br/>
               <textarea class="form-control" id="answer" name="answer" style="width:300; height:300; margin:auto;" placeholder="Type Answer Here..."></textarea>
               <br/>
               <label for="param" id='testCase'>Test Cases:</label>
               <table class="table" id="param" cellspacing="0" cellpadding="0">
                  <tr>
                     <td>
                        <input type="text" name="param1[]" placeholder="Parameter 1...">
                     </td>
                     <td>
                        <input type="text" name="param2[]" placeholder="Parameter 2...">
                     </td>
                     <td>
                        <input type="text" name="param3[]" placeholder="Parameter 3...">
                     </td>
                     <td>
                        <input type="text" name="param4[]" placeholder="Parameter 4...">
                     </td>
                  </tr>
               </table>
               <input id="questid" type="hidden" name="questid" />
               <input type="hidden" name="user" value="<?php echo $_GET['user']; ?>" />
            </form>
            <button class="form-control" style="width:25%;display:inline;" id="addButton" onclick="add()">New Test Case</button>
            <button id="removeButton" class="form-control" style="width:25%;display:inline;" onclick="remove()">Remove Test Case</button><br/>
            <br/>
            <button class="form-control" type="submit" id="add" form="submit" name="add" style="width:35%;margin:auto;" >Add Question</button>
         </div>
         <div class="right">
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
               $tags = array("QUESTID", "TYPE", "DIFFICULTY", "QUESTION", "ANSWER");
               $arrsize = sizeof($array);
               $tagsize = sizeof($tags);
            ?>
            <form method=POST>
               <br/><label for="type">Filter By Type:</label>
	       <input class="form-control" type="text" id="filtType" onkeyup="filter()" placeholder="Search Type.." style="width:35%;margin:auto"><br/>
               <br/><label for="diff">Filter By Difficulty:</label>
               <select class="form-control" id="diff" onChange="filter()" style="width:35%;margin:auto;">
               <option value="0">Select a Difficulty</option>
               <option value="1">1. Very Easy</option>
               <option value="2">2. Easy</option>
               <option value="3">3. Medium</option>
               <option value="4">4. Hard</option>
               <option value="5">5. Very Hard</option>
            </select>
               <br/><br/>
               <table class="table" id="questions" style="font-size: 1.3rem;">
                  <thead>
                     <th>Question ID:</th>
                     <th>Type:</th>
                     <th style="width:13%;">Difficulty:</th>
                     <th>Question:</th>
                     <th>Answer:</th>
                     <th>Edit Question:</th>
                     <th><b>Remove:</b></th>
                  </thead>
                  <tbody>
                  <?php
                     for($i = 0; $i<$arrsize; $i++){
                             echo "<tr class='content' >";
                             echo "<td>".$array[$i]->QUESTID."</td>";
                             echo "<td>".$array[$i]->TYPE."</td>";
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
                             echo "<td>".$array[$i]->QUESTION."</td>";
                             echo "<td>".$array[$i]->ANSWER."</td>";
                             echo "<td><button class='form-control' onclick='editQuestion(this); return false;' style='width:65px'>Edit</button></td>";
                             echo "<td><input type='checkbox' name='checkbox[]' value=".$array[$i]->QUESTID." /></td>";
                             echo "</tr>";
                     }
                  ?>
                  </tbody>
               </table>
               <br/><br/>
               <input class='form-control' style='width:50%;margin:auto;' type='submit' action="bank.php" name='submit' value="Remove Selected Question(s)" />
               <input type="hidden" name="user" value="<?php echo $_GET['user']; ?>" />
            </form>
         </div>
      </section>
   </body>
</html>
<?php
   function logInfo(){
     $user = $_POST['user'];
     $array->question=$_POST['question'];
     $array->type=$_POST['type'];
     if($_POST['difficulty']== "veasy"){
       $array->difficulty=1;
     } elseif($_POST['difficulty']== "easy"){
       $array->difficulty=2;
     } elseif($_POST['difficulty']== "medium"){
       $array->difficulty=3;
     } elseif($_POST['difficulty']== "hard"){
       $array->difficulty=4;
     } elseif($_POST['difficulty']== "vhard"){
       $array->difficulty=5;
     }
     $array->answer=$_POST['answer'];
     $array->user=$user;
     $param1 = $_POST['param1'];
     $param2 = $_POST['param2'];
     $param3 = $_POST['param3'];
     $param4 = $_POST['param4'];
     $array->param1=$param1;
     $array->param2=$param2;
     $array->param3=$param3;
     $array->param4=$param4;

     $json = json_encode($array);
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/makequestion.php');
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     curl_setopt($ch, CURLOPT_HEADER, false);
     $contents = curl_exec($ch);
     curl_close($ch);

     header("Location: https://web.njit.edu/~ase28/frontend/bank.php?user=$user");
   }
   function remove(){
    $questid = $_POST['checkbox'];
    $user = $_POST['user'];
    $json = json_encode($questid);
     	$ch = curl_init();
     	curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/removequestion.php');
     	curl_setopt($ch, CURLOPT_POST, 1);
     	curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     	curl_setopt($ch, CURLOPT_HEADER, false);
     	$contents = curl_exec($ch);
     	curl_close($ch);
      header("Location: https://web.njit.edu/~ase28/frontend/bank.php?user=$user");
   }
   function edit(){
     $user = $_POST['user'];
     $questid = $_POST['questid'];
     $array->question=$_POST['question'];
     $array->type=$_POST['type'];
     if($_POST['difficulty']== "veasy"){
       $array->difficulty=1;
     } elseif($_POST['difficulty']== "easy"){
       $array->difficulty=2;
     } elseif($_POST['difficulty']== "medium"){
       $array->difficulty=3;
     } elseif($_POST['difficulty']== "hard"){
       $array->difficulty=4;
     } elseif($_POST['difficulty']== "vhard"){
       $array->difficulty=5;
     }
     $array->answer=$_POST['answer'];
     $array->user=$user;
     $param1 = $_POST['param1'];
     $param2 = $_POST['param2'];
     $param3 = $_POST['param3'];
     $param4 = $_POST['param4'];
     $array->param1=$param1;
     $array->param2=$param2;
     $array->param3=$param3;
     $array->param4=$param4;
     $array->questid = $questid;
     $json = json_encode($array);

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, 'https://web.njit.edu/~ase28/updatequestion.php');
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, array("data"=>$json));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
     curl_setopt($ch, CURLOPT_HEADER, false);
     $contents = curl_exec($ch);
     curl_close($ch);
     header("Location: https://web.njit.edu/~ase28/frontend/bank.php?user=$user");
   }
?>
