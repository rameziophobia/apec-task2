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
        echo $answers[$i] , '">';
        echo '<label class="form-check-label" for="radioGroup'.$number.'"';
        echo ($i+1) , '">';
        echo $answers[$i],'</label>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function connectToDB() {
    $servername = "localhost";
    $username = "root";
$password = "";
    $dbname = "apec2020";
    define("QUESTIONS_COUNT", 3);

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

$answerList = array();
function getQuestions() {
    $conn = connectToDB();
    $sql = "SELECT * FROM ExamQuestions";
    $result = mysqli_query($conn, $sql);
    $questionList = array();
    global $answerList;
    $answerList = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($questionList , new question($row['question'], array($row['choice1'], $row['choice2'], $row['choice3'], $row['choice4'])));
        }
    }

    shuffle($questionList);
    // array_slice($questionList, 0, 10);
    for($x = 0; $x < QUESTIONS_COUNT; $x++) {
        question_showcase($questionList[$x]->question, $questionList[$x]->choices, $x+1);
        array_push($answerList, $questionList[$x]->choices[0]);
        echo "<br>";
        echo "pushed to ans";
        echo $questionList[$x]->choices[0];
        echo $answerList[$x];
    }
}

function checkAnswers($userAnswers) : int {
    global $answerList;
    $score = 0;
    for($x = 0; $x < QUESTIONS_COUNT; $x++) {
        if($userAnswers[$x] === $answerList[$x]) {
            $score += 1;
            echo "<br>";
            echo "true";
            echo $userAnswers[$x];
            echo $answerList[$x];
        }else{
            echo "<br>";
            echo "false";
            echo $userAnswers[$x];
            echo $answerList[$x];
        }
    }
    return $score;
}

function updateStudentExamEntryStatus($email) {
    $sql = 'UPDATE StudentScores SET hasEnteredExam=true WHERE student_email="'.$email.'"';

    if ($conn->query($sql) === TRUE) {
        echo '<script>'."console.log('student Record updated successfully')" . '</script>';
    } else {
        echo '<script>'."console.log('"."Error updating record: " . $conn->error.')"' . '</script>';
    }
}

function isUserValid($email) {
    $sql = 'SELECT * FROM StudentScores WHERE student_email="'.$email.'"';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($row["hasEnteredExam"] === true) {
            return false; // todo return msg user already entered exam?
        } else {
            updateStudentExamEntryStatus($email);
            return true;
        }
    } else {
        return false; // todo return msg user email not in database?
    }
}


//include "bottom.php";
?>