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

    <title>Milatu - Login page</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="icon" type="image/x-icon" href="../dist/images/MilatuIcon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../intL/build/css/intlTelInput.css">

    <style>
        .iti { width: 100%; }
        .logoDiv {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back to <a href="../">Milatu</a> </h1>
                                    </div>
                                    <form class="user" method="post" id="loginForm">
                                        <div class="form-group mb-3">
                                            
                                            <label class="mb-2 text-dark" for="username">Phone Number</label><br>
                                            <input type="text" name="phonenumber" id="phonenumber" class="form-control form-control-user" onkeyup="fetchAllNumber(this.value)" required onblur="fetchAllNumber(this.value)">
                                            <input type="hidden" name="phone" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-2 text-dark">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password">
                                                <span class="input-group-text" id="showpass_text" onclick="passReveal()"><i class="bi bi-eye"></i></span>
                                            </div>
                                        </div>
                                        
                                        <button class="btn btn-primary btn-user btn-block" id="loginBtn">
                                            Login
                                        </button>
                                        
                                        <a href="signup-account" class="btn btn-secondary btn-user btn-block" id="loginBtn">
                                            New here? Create your account
                                        </a>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password">Forgot Password?</a>
                                    </div>
                                    
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
        function passReveal(){
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
            toastr.options.showDuration = 2000;
        }
        function errorNow(msg){
            toastr.error(msg);
            toastr.options.progressBar = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showDuration = 1000;
        }
        var sign_in = document.getElementById('loginBtn');
        var LoginFormNow = document.getElementById('loginForm');
        var phonenumber = document.getElementById('phonenumber');
        var password = document.getElementById('password');
        
        var url = '../parsers/loginPage';
        var xhr = new XMLHttpRequest();
        
        LoginFormNow.addEventListener('submit', (event) => {
            event.preventDefault();
            if(phonenumber.value == ""){
                alert("phone number is required");
                // phone.focus();
                return false;
            }
            if(password.value == ""){
                alert("password is required");
                password.focus();
                return false;
            }
            
            var data = new FormData(LoginFormNow);
            xhr.open('POST', url, true);
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200) {
                    r = xhr.responseText;
                    if(r == 'Incorrect login credentials'){
                        loginsuccessNow("Sorry, Incorrect login credentials");
                        sign_in.innerHTML = 'Sign In';
                    }else{
                        loginsuccessNow(r);
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                    
                }else{

                }
            }
            sign_in.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Processing...';
            xhr.send(data);
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
    </script>

</body>

</html>