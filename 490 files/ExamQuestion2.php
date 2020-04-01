<head>
</head>
<body onload="loadQuestions()">
<link rel="stylesheet" type="text/css" href="ExamQuestion2.css" />
<div class="container">

  <div class="flex-item">
  <input type="text" id="myinput" onkeyup="filter()" placeholder="Search Question Bank" value=''>

  <!-- use as parameters for filter1
  this.value, document.getElementByName('topic').value, document.getElementByName('difficulty').value, document.getElementByName('constraint').value -->


  <select id="topiclist" onchange= "filter()" name="topic">
          <option value="Filter By Topic">Filter by Topic</option>
          <option value="String">String<br></option>
          <option value="Conditional">Conditional<br></option>
          <option value="Arithmetic">Arithmetic<br></option>
          <option value="Operations">Operations<br></option>
  </select>


  <select id="difficultylist" onchange="filter()" name="difficulty">
          <option value="Filter By Difficulty">Filter by Difficulty</option>
          <option value="Easy">Easy<br></option>
          <option value="Medium">Medium<br></option>
          <option value="Hard">Hard<br></option>
  </select>

  <select id="constraintlist" onchange="filter()" name="constraint">
          <option value="Filter By Constraint">Filter by Constraint</option>
          <option value="None">None<br></option>
          <option value="For">For<br></option>
          <option value="While">While<br></option>
          <option value="Print">Print<br></option>
  </select>
<!------------------------------------------------------------>

<!-- <label>Filter Difficulty
  <select name="Difficulty" id="Difficulty" onchange="filterQuestions();">

  <option value="All">All<br></option>
  <option value="Easy">Easy<br></option>
  <option value="Medium">Medium<br></option>
  <option value="Hard">Hard<br></option>

  </select>
</label> -->

<!------------------------------------------------------------>
    <div class="flex-item">
        <table id="myTable">
            <form id="myform">
                <tr class="header">
                    <th style="width:20%;">QID</th>
                    <th style="width:20%;">Question</th>
                    <th style="width:20%;">Difficulty</th>
                    <th style="width:20%;">Topic</th>
                    <th style="width:20%;">Function Name</th>
                    <th style="width:20%;">Points</th>
                    <th style="width:20%;">Select Question</th>
                </tr>
        </table>
        <table id="myTable">
        </table>
        <button type="submit" id="submit" onclick="return confirm('Do you want to submit this exam?')">Submit</button>
        </form>
    </div>
</div>

<div id="response"></div>
<script>

    var i=0;
    document.getElementById('submit').addEventListener('click', makeExam);


    function loadQuestions(){

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://afsaccess1.njit.edu/~kp486/TestView.php', true);

        xhr.onload = function(){
            if(this.status == 200){
                var questions = JSON.parse(this.responseText);

                var arrayLength = questions.length;

                var t='';
                for (i = 0; i < arrayLength; i++) {
                    var tr = "<tr>";
                    tr += "<td id='QID'>" +questions[i].QID+"</td>";
                    tr += "<td id='Question'>" +questions[i].Question+"</td>";
                    tr += "<td id='Difficulty'>" +questions[i].Difficulty+"</td>";
                    tr += "<td id='Topic'>" +questions[i].Topic+"</td>";
                    tr += "<td id='FunctionName'>" +questions[i].FunctionName+"</td>";
                    tr += "<td id='Points'><input type = 'textarea' class='points' name='points[]' id='points'></textarea>";
                    tr += "<td><input type = 'checkbox' name='check[]' value='checkbox' id='Checkbox'></checkbox>";
                    t += tr;

                }
                document.getElementById("myTable").innerHTML+= t;
            }
            if(this.status == 404){
                console.log("404 error");
            }
        }

        xhr.send();
    }

    function makeExam(){
        var table = document.getElementById('myTable');
        var rowCells;
        var checkbox;
        var input;
        var test = [];

        console.log('button pressed');

        var rowCount = document.getElementById('myTable').rows.length;
        for (var z = 1; z < rowCount; z++) {
            rowCells = table.rows[z].cells;
            checkbox = table.rows[z].querySelectorAll('input[type="checkbox"]');
            input = table.rows[z].querySelectorAll('input[type="textarea"');

            if (checkbox[0].checked == true) {

                test.push({
                    QID: rowCells[0].innerHTML,
                    // functionname: rowCells[4].innerHTML,
                    Points: input[0].value
                });
            }
        }

        $payload = JSON.stringify(test);

        console.log($payload);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://afsaccess1.njit.edu/~kp486/TestAdd.php', true);
        xhr.setRequestHeader('Content-Type','application/json');
        xhr.send($payload);
        // xhr.open('POST', 'http://afsaccess1.njit.edu/~ntb6/invalid.html', true);
        // xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        // xhr.open("POST","http://afsaccess1.njit.edu/~ntb6/invalid.html",true);
        // window.location.href = "http://afsaccess1.njit.edu/~ntb6/invalid.html";

          // {
          // }
          {
          document.write("Created Exam...");
          // setTimeout('Redirect()', 5000);
      }
    }
    function filter(){

        var keyword, topic, difficulty, constraint;

        keyword = document.getElementById("myinput").value;
        topic = document.getElementById("topiclist").value;
        difficulty = document.getElementById("difficultylist").value;
        constraint = document.getElementById("constraintlist").value;
        // if (keyword == "") {
        //     document.getElementById("keyword").innerText = "";
        //     return;
        // }

        if (topic == "Filter By Topic") {
            topic = "";
        }
        if (difficulty == "Filter By Difficulty") {
            difficulty = "";
        }
        if (constraint == "Filter By Constraint") {
            constraint = "";
        }
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("myTable").innerHTML= this.responseText;
            }
        };

        xmlhttp.open("POST","http://afsaccess1.njit.edu/~kp486/Filter.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");


        xmlhttp.send("keyword=" +encodeURIComponent(keyword)
  + "&topic=" +encodeURIComponent(topic)
  + "&difficulty=" +encodeURIComponent(difficulty)
  + "&constraint=" +encodeURIComponent(constraint));

    // var newquestions = JSON.parse(this.responseText);
    // document.getElementByID("myTable") = newquestions;

  }
//
// function Redirect()
// {
// window.location="WelcomeInst.php";
// }
</script>
</body>
