<?php
include "index.php";
$servername = "localhost";
$username = "username";
$password = "password";
$databaste = "APEC2020";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// Create database
$sql = "CREATE DATABASE APEC2020";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
//Create Table 1
$sql = "CREATE TABLE ExamQuestions (
    question_number INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(256) NOT NULL,
    choice1 VARCHAR(128) NOT NULL,
    choice2 VARCHAR(128) NOT NULL,
    choice3 VARCHAR(128) NOT NULL,
    choice4 VARCHAR(128) NOT NULL)";
if ($conn->query($sql) === TRUE) {
    echo "Table ExamQuestions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
//Create Table 2
$sq1 = "CREATE TABLE StudentScores (
    student_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    studnt_name VARCHAR(256) NOT NULL,
    student_email VARCHAR(320) NOT NULL,
    student_number VARCHAR(11) NOT NULL"
if ($conn->query($sql) === TRUE) {
    echo "Table StudentScores created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
//Connect To database
$conn = mysqli_connect($servername, $username, $password, $databaste);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

foreach($questions as $question) {
    $sql = "INSERT INTO ExamQuestions (question, choice1, choice2, choice3, choice4)
    VALUES ($question->question , $question->$choices[0] , $question->$choices[1], $question->$choices[2], $question->$choices[3])";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
mysqli_close($conn);
?>