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
	<script src="jquery-3.5.1.min.js"></script>
</head>
<body>
   <header>
			 <div class="col-12">
				 <img class="rotating" src="logo.png"></img><img src="rsz_11logo.png">
			 </div>
   </header>

		 <!--Second Page Start-->
<div class="container" id="page2">
		<div class="center">
				<form method="post" id="secondForm" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<div class="d-flex center2">
								<h3 style="color: white;" class="mr-3">Time Left:</h3>
								<h3 id="counter" style="color: white;"></h3>
						</div>

						<h1 style="color: rgb(182, 6, 6);">Questions: </h1>
						<?php
							include "test.php";
							getQuestions();
						?>
						<div class="col text-center mt-5 ">
								<div class="red col-sm-4">
										<button type="submit" class="btn">Submit</button>
								</div>
						</div>
				</form>
				<!-- <script type="text/javascript">
                    $(document).ready(function() {
                        $("#secondForm").submit(function(event){
                            if(true) {
                                console.log("fhi");
								event.preventDefault();
                            }
                        });
                    });
				</script> -->
				<?php
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						// include "test.php";
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
</div>

</div>
<script src="./ex.js"></script>
<!-- <?php include "timer.php"; ?> -->
</body>
</html>
