hi

<?php
// $servername = "localhost";
// $username = "username";
// $password = "password";

// // Creating connection
// $conn = new mysqli($servername, $username, $password);

// // Checking connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>

<?php
    include "question.php";
    $file = fopen("questions.csv","r");
    $row = fgetcsv($file);
    $row = fgetcsv($file);
    $questions = array();
    while($row){
        $newQuestion = new question($row[0], array_slice($row, 1));
        array_push($questions, $newQuestion);
        $newQuestion->displayQuestion();
        $row = fgetcsv($file);
    }
    fclose($file);
?>