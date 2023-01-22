<!DOCTYPE html>
<html>
<head>
	<?php require 'supports/header.php';?>
	<style>
		.legal_btn {
			border-radius: 2em;
			text-transform: capitalize;
			padding: 8px 13px;
		}
		.space {
			margin: 8em auto;
		}
		.containerMain {
			position: relative;
			text-align: center;
/*			color: white;*/
		}

		/* Bottom left text */
		.bottom-left {
			position: absolute;
			bottom: 8px;
			left: 16px;
		}

		/* Top left text */
		.top-left {
			position: absolute;
			top: 8px;
			left: 16px;
		}

		/* Top right text */
		.top-right {
			position: absolute;
			top: 8px;
			right: 16px;
		}

		/* Bottom right text */
		.bottom-right {
			position: absolute;
			bottom: 8px;
			right: 16px;
		}

		/* Centered text */
		.centered {
			position: absolute;
			top: 25%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
	</style>
</head>
<body>
	<?php require 'supports/nav.php';?>
	
	<div class="containerMain">
		<img src="lawyer1.jpeg" alt="Snow" style="width:100%; opacity: .2;">
		<div class="bottom-left">Bottom Left</div>
		<div class="top-left">Top Left</div>
		<div class="top-right">Top Right</div>
		<div class="bottom-right">Bottom Right</div>
		<div class="centered">
			<h1 class="h1 mb-2">Hire or consult a lawyer in 3 easy steps</h1>
			<p class="fs-5">The best platform to find and get a lawyer in Zambia</p>
		</div>
	</div>
	<!-- <div class="container mb-5">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-xs-12">
				<h1 class="h1 mb-2">Hire or consult a lawyer in 3 easy steps</h1>
				<p class="fs-5">The best platform to find and get a lawyer in Zambia</p>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<img src="dist/images/front2.png" class="img-fluid frontImage" alt="frontImage">
			</div>
		</div>
	</div> -->

	<div class="container mt-5 space">
		<div class="row">
			<div class="col-md-4 mb-5">
				<h4>Step 1</h4>
				<p>Create your account in an easy way</p>
			</div>
			<div class="col-md-4 mb-5">
				<h4>Step 2</h4>
				<p>Post your case anynimously and receive proposals from lawyers</p>
			</div>
			<div class="col-md-4 mb-5">
				<h4>Step 3</h4>
				<p>Review the proposals and select the best lawyer to represent you</p>
			</div>

			<div class="col-md-12 text-center mt-5">
				<p><a href="post-your-legal-needs" class="button-111">POST YOUR LEGAL NEED</a></p>
			</div>
		</div>
	</div>


	<div class="container  mt-5 mb-5">
		<div class="row">
			
			<div class="col-md-6 mb-5">
				<h3 class="mb-4 findTag">Find Lawyers by location <i class="bi bi-geo-alt"></i></h3>
				<a href="lusaka" class="btn btn-secondary btn-sm legal_btn m-2">Lusaka</a>
				<a href="Kitwe" class="btn btn-secondary btn-sm legal_btn m-2">Kitwe</a>
				<a href="Ndola" class="btn btn-secondary btn-sm legal_btn m-2">Ndola</a>
				<a href="Kafue" class="btn btn-secondary btn-sm legal_btn m-2">Kafue</a>
				<a href="Livingstone" class="btn btn-secondary btn-sm legal_btn m-2">Livingstone</a>
				<a href="Mansa" class="btn btn-secondary btn-sm legal_btn m-2">Mansa</a>
				<a href="Siavonga" class="btn btn-secondary btn-sm legal_btn m-2">Siavonga</a>
				<a href="Mongu" class="btn btn-secondary btn-sm legal_btn m-2">Mongu</a>
				<a href="Choma" class="btn btn-secondary btn-sm legal_btn m-2">Choma</a>
				<img src="dist/images/location.svg" alt="location" class="img-fluid">
				<p class="fs-3 mt-5"></p>
			</div>
			
			<div class="col-md-6 mb-5">
				<h3 class="mb-4 findTag">Find lawyers by practice </h3>
				<a href="Busines" class="btn btn-secondary btn-sm legal_btn m-2">Busines</a>
				<a href="Commercial" class="btn btn-secondary btn-sm legal_btn m-2">Commercial</a>
				<a href="Criminal" class="btn btn-secondary btn-sm legal_btn m-2">Criminal</a>
				<a href="Family" class="btn btn-secondary btn-sm legal_btn m-2">Family</a>
				<a href="Immigration" class="btn btn-secondary btn-sm legal_btn m-2">Immigration</a>
				<a href="labor and employment" class="btn btn-secondary btn-sm legal_btn m-2">labor and employment</a>
				<a href="Property" class="btn btn-secondary btn-sm legal_btn m-2">Property</a>
				<a href="Intellectual Property" class="btn btn-secondary btn-sm legal_btn m-2">Intellectual Property</a>
				<a href="Contracts" class="btn btn-secondary btn-sm legal_btn m-2">Contracts</a>
				<img src="dist/images/practice.svg" alt="location" class="img-fluid">
			</div>
			
		</div>
	</div>

	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-md-6">
				<h4>Are You A Lawyer?</h4>
				<p>Milatu Services is here to help client lawyer relationship by creating an online platform where prospective clients come to lawyers, and lawyers connect directly with those clients–at the click of a button.</p>

				<p>We can help you get more clients. Simply create your profile to be listed in our lwayers directory and network, and immediately start receiving email summaries of relevant legal projects. Learn more here or sign up below.</p>

				<p class="text-centers mt-5"><a href="lawyers" class="button-111">Create your account</a></p>
			</div>
			<div class="col-md-6">
				<img src="dist/images/contract.jpeg" alt="location" class="img-fluid rounded">
			</div>
		</div>
	</div>
</body>
</html>