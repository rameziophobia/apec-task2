<?php
include "index.php";
$servername = "localhost";
$username = "root";
$password = "";
$database = "APEC2020";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// Create database
$sql = "CREATE DATABASE 'APEC2020' if not exists";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
//Connect To database
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//Create Table 1
$sql = "CREATE TABLE 'ExamQuestions' if not exists(
    'question_number' INT UNSIGNED AUTO_INCREMENT,
    'question' VARCHAR(256) NOT NULL,
    'choice1' VARCHAR(128) NOT NULL,
    'choice2' VARCHAR(128) NOT NULL,
    'choice3' VARCHAR(128) NOT NULL,
    'choice4' VARCHAR(128) NOT NULL,
    PRIMARY KEY (question_number)
    )";
if ($conn->query($sql) === TRUE) {
    echo "Table ExamQuestions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
//Create Table 2
$sq1 = "CREATE TABLE 'StudentScores' if not exists (
    student_id INT UNSIGNED AUTO_INCREMENT,
    studnt_name VARCHAR(256) NOT NULL,
    student_email VARCHAR(320) NOT NULL,
    student_number VARCHAR(11) NOT NULL,
    student_score INT,
    PRIMARY KEY (student_id)
    )";
if ($conn->query($sql) === TRUE) {
    echo "Table StudentScores created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

foreach($questions as $ques) {
    $answer1 = $ques->choices[0];$answer2 = $ques->choices[1];$answer3 = $ques->choices[2];$answer4 = $ques->choices[3];
    $sql = "INSERT INTO ExamQuestions (question, choice1, choice2, choice3, choice4)
    VALUES ('$ques->question' ,
    '$answer1' , '$answer2', '$answer3', '$answer4')";  
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
mysqli_close($conn);
?>