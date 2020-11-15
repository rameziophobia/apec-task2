<!DOCTYPE html>
<html>
<head>
   <title>APEC|Registration</title>
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
  <div class="container" id="page1">
      <div class="center">
          <form id="firstForm" action="first.php" method="POST">
              <div class="form-group row mb-2">
                  <label for="staticName" class="col-sm-2">Name: </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="staticName" >
                    <span id="nameError" style="color:red; visibility: hidden;"><p>*input must be filled</p></span>
                  </div>
              </div>
              <div class="form-group row mb-2">
                  <label for="staticNumber" class="col-sm-2 col-form-label">Mobile Number: </label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="staticNumber" pattern="[0-9]{11}">
                    <span id="numberError" style="color:red;visibility: hidden"><p>*input must be filled</p></span>
                  </div>
                </div>
              <div class="form-group row mb-2">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email Address: </label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="staticEmail" name="mail">
                  <span id="emailError" style="color:red;visibility: hidden"><p>*input must be filled</p></span>
                </div> 
              </div>

              <div class="col text-center mt-5 ">
                  <div class="red col-sm-4">
                  <script type="text/javascript">
                    $(document).ready(function() {
                        $("#firstForm").submit(function(event){
                            console.log("fhi");
                            //event.preventDefault();
                            //if(isUserValid === "false") {event.preventDefault();};
                            if(condition() == false) {event.preventDefault();};
                        });
                    });
                    </script>
                    <?php
                      include "test.php";
                      if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                        if(isUserValid($_POST['mail']))
                        {
                          header("Location: second.php");
                          exit();
                        }
                        else {
                          echo "<script>alert('User isn't Registered')</script>";
                        }
                      }
                    ?>
                      <button type="submit" class="btn" onsubmit="return condition()" id="next-btn">Next</button>
                      <script type="text/javascript">
                      function ValidateEmail(inputText)
                          {var mailformat = /^[a-zA-Z0-9.!#$%&'+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$/ ;
                             if(!(inputText.value.match(mailformat)))
                             {
                               return false;
                             }
                             else{return true;}

                          }
                       function condition() {
                            //e.preventDefault();
                            console.log("dsdsadbtn");
                         if(document.getElementById("staticName").value!='' &&
                            document.getElementById("staticEmail").value!='' &&
                            document.getElementById("staticNumber").value!='' && ValidateEmail(document.getElementById("staticEmail"))) {
                            // location.href = "second.html";
                            return true;
                          }
                          else if(document.getElementById("staticName").value==''){
                            document.getElementById("nameError").style.visibility='visible';
                            document.getElementById("staticName").style.border='2px solid red';

                             }
                          else if(document.getElementById("staticEmail").value==''){
                            document.getElementById("emailError").style.visibility='visible';
                            document.getElementById("staticEmail").style.border='2px solid red';

                            }
                          else if(document.getElementById("staticNumber").value==''){
                            document.getElementById("numberError").style.visibility='visible';
                            document.getElementById("staticNumber").style.border='2px solid red';

                            }
                            return false;
                             };

                     </script>
                  </div>
              </div>
          </form>
      </div>
  </div>

</body>


</html>
