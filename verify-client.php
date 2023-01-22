<!DOCTYPE html>
<html>
<head>
	<?php include("supports/header.php")?>
	<link rel="stylesheet" href="intL/build/css/intlTelInput.css">
	<script src="intL/build/js/intlTelInput.js"></script>
	<style>
		.iti { width: 100%; }
		.registerDiv {
			margin: 3em auto;
			width: 50%;
		}
		@media(max-width:600) {
			.registerDiv {
				width: 100%;
			}
		}
	</style>
</head>
<body>
	<?php include("supports/nav.php");
		if (isset($_COOKIE['phonenumber'])) {
			$phonenumber = $_COOKIE['phonenumber'];
		}
	?>
	<div class="container mt-5">
		<div class="main_section">
			<div class="row">
				
				<div class="col-md-12 mt-5">
					<div class="registerDiv">
						<h4 class="mb-5 border bg-New p-2 text-center text-white ">Enter verification code </h4>
						<div class="form-group">
							<form id="otpForm" method="post">
								<div class="input-group mb-3">
									<input type="text" name="otp" id="otp" class="form-control" required>
									<input type="text" name="otp_phone" id="otp_phone" class="form-control" readonly value="<?php echo $phonenumber ?>">
									<button class="btn btn-primary bg-New" type="submit" id="submitOtp">Verify OTP</button>

								</div>
								
								Didn't get your code? <a href="<?php echo $phonenumber?>" id="resend" class="resendOTP">Resend OTP</a>  | Text Your "CODENOW" to 0976330092
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$("#otpForm").submit(function(e){
			e.preventDefault();
			var url = 'parsers/activateClient';
			$.ajax({
				url:url,
				method:"POST",
				data:$(this).serialize(),
				beforeSend:function(){
					$("#submitOtp").html("<span class='spinner-grow spinner-grow-sm'></span> Please Wait...");
				},
				success:function(data){
					loginsuccessNow(data);
					$("#submitOtp").html("Verify OTP");
					// setTimeout(function(){
					// 	window.location = 'login';
					// }, 1500);
					
				}
			})
		})

		$(document).on("click", ".resendOTP", function(e){
			e.preventDefault();
			const phonenumber = $(this).attr("href");
			const url = 'parsers/resendOTP';
			$.ajax({
				url:url,
				method:"POST",
				data:{phonenumber:phonenumber},
				beforeSend:function(){
					$("#resend").html("<span class='spinner-grow spinner-grow-sm'></span> Please Wait...");
				},
				success:function(data){
					loginsuccessNow(data);
					$("#resend").html("Resend OTP");
					
				}
			})
		})
		
	</script>

</body>
</html>