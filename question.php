<?php
    class question {
        public string $question;
        public array $choices;

        function __construct($question, $choices) {
            $this->question = $question;
            $this->choices = $choices;
            // echo $this->question;
        }

        function displayQuestion() {
            echo $this->question." ";
            foreach($this->choices as $val) {
                echo $val." ";
            }
            echo "<br>";
        }
    }
?>