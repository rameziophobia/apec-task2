<?php
//include "top.php";
include "question.php";
function question_showcase($question, $answers, $number) {
    shuffle($answers);
    echo '<div class="container mt-4">';
    echo '<div class="form-group ">';
    echo '<div class="row">';
    echo '<h4 style="color: white;">'.'Q'.$number.'. '.$question.'</h4>';
    echo '</div>';
    echo '<div class="row d-flex justify-content-around mt-3">';
    for($i = 0; $i < 4; $i++) {
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="radioGroup'.$number.'"';
        echo ($i+1);
        echo '" id="exampleRadios2"';
        echo 'value="';
        echo $answers[i] , '">';
        echo '<label class="form-check-label" for="radioGroup'.$number.'"';
        echo ($i+1) , '">';
        echo $answers[$i],'</label>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apec2020";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM ExamQuestions";
$result = mysqli_query($conn, $sql);
$questionList = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($questionList , new question($row['question'], array($row['choice1'], $row['choice2'], $row['choice3'], $row['choice4'])));
    }
}

shuffle($questionList);
for($x = 0; $x < 10; $x++) {
    question_showcase($questionList[$x]->question, $questionList[$x]->choices, $x+1);
}
//include "bottom.php";
?>