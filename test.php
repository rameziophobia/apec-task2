<?php
//include "top.php";
include "question.php";
define("QUESTIONS_COUNT", 3);
session_start();
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

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function getQuestions() {
    $_SESSION['answerlist'] = array();
    $conn = connectToDB();
    if(userAlreadySubmitted($conn)) {
        throw new Exception('user has already submitted answers');
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
    for($x = 0; $x < QUESTIONS_COUNT; $x++) {
        question_showcase($questionList[$x]->question, $questionList[$x]->choices, $x+1);
        array_push($_SESSION['answerlist'], $questionList[$x]->choices[0]);
    }
    
}

function checkAnswers($userAnswers) : int {
    $score = 0;
    //var_dump($_SESSION['answerlist']);
    for($x = 0; $x < QUESTIONS_COUNT; $x++) {
        if($userAnswers[$x] === $_SESSION['answerlist'][$x]) {
            $score += 1;
        }
    }
    return $score;
}

function updateStudentExamEntryStatus($email, $conn) {
    $sql = 'UPDATE StudentScores SET hasEnteredExam=true WHERE student_email="'.$email.'"';

    if ($conn->query($sql) === TRUE) {
        echo '<script>'."console.log('student Record updated successfully')" . '</script>';
    } else {
        echo '<script>'."console.log('"."Error updating record: " . $conn->error.')"' . '</script>';
    }
}

function userAlreadySubmitted($conn) {
    $sql = 'SELECT * FROM StudentScores WHERE student_email="'.$_SESSION['Email'].'"';
    $result = mysqli_query($conn, $sql);
    if($result == true) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["hasSubmittedAnswers"] == true;
        }
    }
    return false;
}

function updateStudentExamScore($userAnswers) {
    $conn = connectToDB();
    $score = checkAnswers($userAnswers);
    if(userAlreadySubmitted($conn)) {
        throw new Exception('user has already submitted answers');
    }
    $sql = 'UPDATE StudentScores SET student_score='.$score.
            ', `hasSubmittedAnswers` = 1'.
            ' WHERE student_email="'.$_SESSION['Email'].'"';

    if ($conn->query($sql) === TRUE) {
        echo '<script>'."console.log('student Record updated successfully')" . '</script>';
    } else {
        echo '<script>'."console.log('"."Error updating record: " . $conn->error.')"' . '</script>';
    }
}

function isUserValid($email) {
    $conn = connectToDB();
    $sql = 'SELECT * FROM StudentScores WHERE student_email="'.$email.'"';
    $result = mysqli_query($conn, $sql);
    if($result == true) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if($row["hasEnteredExam"] == true) {
                throw new Exception('user already entered Exam');
                return false;
            } else {
                updateStudentExamEntryStatus($email, $conn);
                $_SESSION['Email'] = $email;
                return true;
            }
        } else {
            throw new Exception('user email not registered');
            return false;
        }
    }
}


//include "bottom.php";
?>