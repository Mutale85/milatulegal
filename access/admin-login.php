<?php 
    include '../includes/db.php';

    if(isset($_SESSION['adminEmail'])){
       
        header("location:./");  
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="../intL/build/css/intlTelInput.css">
    <script src="../intL/build/js/intlTelInput.js"></script>
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
                                    <a href="../"><img src="../dist/images/MilatuLogo.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-5">
                                <div class="p-3">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back to <a href="../">Milatu</a> </h1>
                                    </div>
                                    <form class="user" method="post" id="loginForm">
                                        <div class="form-group">
                                            <label class="mb-2 text-dark" for="username">Phone Number</label><br>
                                            <input type="text" name="email" id="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Your email">
                                                                                    </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" id="loginBtn">
                                            Login
                                        </button>
                                        
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password">Forgot Password?</a>
                                    </div> -->
                                    
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
    <script>
        function loginsuccessNow(msg){
            toastr.warning(msg);
            toastr.options.progressBar = false;
            toastr.options.positionClass = "toast-top-right";
        }
        function errorNow(msg){
            toastr.error(msg);
            toastr.options.progressBar = true;
            toastr.options.positionClass = "toast-top-center";
            toastr.options.showDuration = 1000;
        }
        var sign_in = document.getElementById('loginBtn');
        var LoginFormNow = document.getElementById('loginForm');
        var email = document.getElementById('email');
        var password = document.getElementById('password');
        
        var url = '../parsers/adminloginPage';
        var xhr = new XMLHttpRequest();
        
        LoginFormNow.addEventListener('submit', (event) => {
            event.preventDefault();
            if(email.value == ""){
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
                        alert("Sorry, Incorrect login credentials");
                        sign_in.innerHTML = 'Sign In';
                    }else{
                        alert(r);
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

    </script>
</body>
</html>