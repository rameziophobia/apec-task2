<!DOCTYPE html>
<html>
<head>
	<title>
		Apec|Exam
	</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styling/StyleCss.css">
<body>
	
	<header>
			<div class="col-12">
				<img class="rotating" src="logo.png"></img><img src="rsz_11logo.png">
			</div>
	</header>
  <div class="container align-items-center" id="page3">
  		<div class="center">
  				<h1>Your Answers Have been Submitted</h1>
  		</div>
		  <?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						include "test.php";
						echo '<script> console.log("sfsfa") </script>';
						$userAnswers = array();
						for($x = 0; $x < QUESTIONS_COUNT; $x++) {
							if(isset($_POST["radioGroup".($x+1)])){
								$name_of_radio_button = $_POST ["radioGroup".($x+1)];
							} else {
								$name_of_radio_button = "No Choice Selected";
							}
							echo $name_of_radio_button;
							array_push($userAnswers, $name_of_radio_button);
						}
						echo "score is".checkAnswers($userAnswers);
					}
				?>
  </div>
</body>
</html>
