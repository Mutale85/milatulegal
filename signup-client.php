<!DOCTYPE html>
<html>
<head>
	<?php include("supports/header.php")?>
	<link rel="stylesheet" href="intL/build/css/intlTelInput.css">
	<script src="intL/build/js/intlTelInput.js"></script>
	<style>
		.iti { width: 100%; }
		/*register.php password validation*/
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
			content: "";
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
		/*end of password */
	</style>
</head>
<body>
	<?php include("supports/nav.php")?>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12 mt-5">
				<div class="coverDiv">
					<h4 class="mb-5 border bg-New p-2 text-center text-white ">Create a Client's Account</h4>
					<form id="registerForm" method="post">
						<!-- <div class="form-group mb-3">
			       			<label class="mb-2 text-dark" for="username">First and Last names</label>
			       			<div class="input-group">
								<input type="text" name="firstname" id="firstname" class="form-control" required placeholder="Firstname">
								<input type="text" name="lastname" id="lastname" class="form-control" required placeholder="Lastname">
							</div>
			       		</div> -->

			       		<div class="form-group mb-3">
			       			<label class="mb-2 text-dark" for="username">Phone Number</label><br>
							<input type="text" name="phonenumber" id="phonenumber" class="form-control" onkeyup="fetchAllNumber(this.value)" required onblur="fetchAllNumber(this.value)">
							<input type="hidden" name="phone" id="phone">
			       		</div>

			       		<!-- <div class="form-group mb-3">
			       			<label class="mb-2 text-dark" for="email">Email</label>
			   				<input type="email" name="email" id="email" class="form-control" required placeholder="Email" autocomplete="off">
			   				
			       		</div>
			       		<div class="form-group mb-3">
			       			<label class="mb-2 text-dark" for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" required placeholder="Username">
			       		</div> -->
			       		
			       		<div class="form-group mb-3">
			       			<label class="mb-2 text-dark" for="password">Create Password </label>
			       			<div class="input-group">
			       				<input type="password" name="password" id="password" class="form-control" required  autocomplete="off" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
			       				<span class="input-group-text" id="showpass_text" onclick="passReveal()"><i class="bi bi-eye"></i></span>
			       			</div>
			       		</div>
			       		<div class="form-check mb-3">
			       			<input type="hidden" class="form-control" name="business_type" id="business_type" value="Car Hiring">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
							<label class="form-check-label" for="flexCheckDefault">
								I agree to <a href="policy/terms-of-use" class="text-decoration-none text-dark " title="terms"> Terms </a> 
							</label>
						</div>
			       		<div class="mt-4">
			       			<button id="submitBtn" type="submit" class="btn btn-outline-dark py-3 px-4 rounded-pill">Create Account</button> 
			       			<a href="access/login" class=" btn btn-outline-dark py-3 px-4 rounded-pill" title="login">Already a member? Login</a>
			       		</div>
			       		
					</form>

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
	<?php include("supports/footer.php");?>	
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


		$(document).ready(function(){
			$("#registerForm").submit(function(e){
				e.preventDefault();
				var url = 'parsers/registerClient';
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
							window.open("verify-client","_blank");
						}, 1500);
						$("#submitBtn").html("Create Account");
						
					}
				})
			})
		})
	</script>
	<script>
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
			utilsScript: "intL/build/js/utils.js",
		});

    	function fetchAllNumber(phone){
      		// var num = iti.getNumber(),
      		var number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
			var isValid = iti.isValidNumber();
			result = document.querySelector("#result");
			phone = document.getElementById("phone");
			otp_phone = document.getElementById("otp_phone");
			if (phone == "") {
				// result.textContent = "Add Your Number";
				return false;
			}
			if (isValid === true) {
			  	// result.textContent = "Number: " + number + ", is valid";
			  	phone.value = number;
			  	otp_phone.value = number;
			}else if(isValid === false){
			  	// result.textContent = "Number: " + number + ", is invalid";
			  	phone.value = number;
			  	otp_phone.value = number;
			}
    	}

    	$(function(){
    		$("#location_province").change(function(e){
    			var province = $(this).val();
    			$.ajax({
    				url:"parsers/fetchTowns",
    				method:"post",
    				data:{province:province},
    				success:function(data){
    					$("#location_town").html(data);
    				}
    			})
    		})
    	})
	</script>
</body>
</html>