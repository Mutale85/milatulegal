<?php 
    include '../includes/db.php';

    if(isset($_SESSION['userType'])){
        if($_SESSION['userType'] == "client"){
            header("location:../clients/");
        }else if($_SESSION['userType'] == "lawyer"){
            header("location:../lawyers/");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Milatu - Client Sign Up Page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="icon" type="image/x-icon" href="../dist/images/MilatuIcon.png" />
    <link rel="stylesheet" href="../intL/build/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        .logoDiv {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .iti { width: 100%; }
        #message {
            display:none;
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding: 20px;
            margin-top: 10px;
        }

        #message p {
            padding: 10px 35px;
            font-size: 14px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "√";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
</head>

<body class="bg-gradient-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="logoDiv">
                                    <a href="../"><img src="../dist_old/images/MilatuLogo.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-5">
                                <div class="p-3">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create your account @ <a href="../">Milatu</a> </h1>
                                        <p>This will enebale you to post your legal needs and consult available lawyers</p>
                                    </div>
                                    <form class="user" method="post" id="registerForm">
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <label class="mb-2 text-dark" for="username">First and Last names</label>
                                                <div class="input-group">
                                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-user" required placeholder="Firstname">
                                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-user" required placeholder="Lastname">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            
                                            <label>Phone Number</label>
                                            <input type="text" name="phonenumber" id="phonenumber" class="form-control form-control-user" onkeyup="fetchAllNumber(this.value)" required onblur="fetchAllNumber(this.value)">
                                            <input type="hidden" name="phone" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <label>Create Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                                                <span class="input-group-text" id="showpass_text" onclick="Reveal()"><i class="bi bi-eye"></i></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" id="loginBtn">
                                            Submit
                                        </button>
                                        
                                        <a href="login" class="btn btn-secondary btn-user btn-block" id="loginBtn">
                                            Already a member? Login
                                        </a>
                                    </form>
                                </div>

                                <div id="result"></div>
                                <div id="message" class="mt-4">
                                    <h5>Password must contain the following:</h5>
                                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                    <p id="number" class="invalid">A <b>number</b></p>
                                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="../intL/build/js/intlTelInput.js"></script>
    <script>
        var showpass = document.getElementById('showpass_text');
        var password = document.getElementById('password');
        function Reveal(){
            var password = document.getElementById('password');
            if(password.type == 'password') {
                password.type = 'text';
                showpass.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }else {
                password.type = 'password';
                showpass.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }

        function loginsuccessNow(msg){
            toastr.warning(msg);
            toastr.options.progressBar = false;
            toastr.options.positionClass = "toast-top-right";
        }
        function errorNow(msg){
            toastr.error(msg);
            toastr.options.progressBar = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showDuration = 2000;
        }
        
        $(document).ready(function(){
            $("#registerForm").submit(function(e){
                e.preventDefault();
                var url = '../parsers/registerClient';
                $.ajax({
                    url:url,
                    method:"POST",
                    data:$(this).serialize(),
                    beforeSend:function(){
                        $("#submitBtn").html("<span class='spinner-grow spinner-grow-sm'></span> Please Wait...");
                    },
                    success:function(data){
                        
                        loginsuccessNow(data);
                        setTimeout(function(){
                            // window.location = 'verify-client';
                            window.open("../verify-client","_blank");
                        }, 1500);
                        $("#submitBtn").html("Create Account");
                        
                    }
                })
            })
        })


        var input = document.querySelector("#phonenumber");
        var iti = intlTelInput(input, {
            autoHideDialCode: true,
            autoPlaceholder: true,
            separateDialCode: true,
            nationalMode: true,
            allowDropdown: true,
            autoPlaceholder: "polite",
            dropdownContainer: document.body,
            geoIpLookup: function(callback) {
                $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            nationalMode: false,
            placeholderNumberType: "MOBILE",
            preferredCountries: ['zm'],
            separateDialCode: true,
            utilsScript: "../intL/build/js/utils.js",
        });

        function fetchAllNumber(phone){
            // var num = iti.getNumber(),
            var number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
            var isValid = iti.isValidNumber();
            result = document.querySelector("#result");
            phone = document.getElementById("phone");
            // otp_phone = document.getElementById("otp_phone");
            if (phone == "") {
                // result.textContent = "Add Your Number";
                return false;
            }
            if (isValid === true) {
                // result.textContent = "Number: " + number + ", is valid";
                phone.value = number;
                // otp_phone.value = number;
            }else if(isValid === false){
                // result.textContent = "Number: " + number + ", is invalid";
                phone.value = number;
                // otp_phone.value = number;
            }
        }

        // ------- PASSWORD VALIDATOR ---------

        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }
          
          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }

          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }
          
          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }
    </script>

</body>

</html>