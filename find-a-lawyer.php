<!DOCTYPE html>
<html>
<head>
	<?php require 'supports/header.php';?>
	<style>
		.clickable {
			cursor: pointer;
		}
	</style>
	<link rel="stylesheet" href="intL/build/css/intlTelInput.css">
	<script src="intL/build/js/intlTelInput.js"></script>
</head>
<body class="bg-gradient-light">
	<?php require 'supports/nav.php';?>
	<br><br>
	<div class="container mb-5">
		<div class="coverDiv">
			<div class="row">
				<div class="col-md-3 bg-light border p-4">
					<h4>Search Criteria</h4>
					<form method="get" id="searchForm">
						<div class="form-group mb-3">
							<label class="mb-2">Province</label>
							<select class="form-control" name="province" id="province" onchange="searchByProvince(this.value)">
								<option value="">All Provinces</option>
									<?php 
										$query = $connect->prepare("SELECT * FROM `provinces`");
										$query->execute();
										foreach ($query->fetchAll() as $row) {
											extract($row);
										
									?>
								<option value="<?php echo $id;?>"><?php echo $name;?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label class="mb-2">Town</label>
							<select class="form-control" name="town" id="town" onchange="searchByTown(this.value)" >
								<option value="">Select City</option>
							</select>
						</div>
					</form>
				</div>
				<div class="col-md-9">
					<h4>Find Lawyers</h4>
					<div id="lawyersFind"></div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).on("click", ".clickable", function (e) {
			const clickable = $(this).data("id");
			window.location = 'lawyer-profile/'+btoa(clickable);
		})

		function lawyersFind(){
			var find = 'lawyersFind';
			$.ajax({
				url: 'parsers/lawyersFind',
				method:'post',
				data:{find:find},
				success:function(data){
					$("#lawyersFind").html(data);
				}
			})
		}
		lawyersFind();

		function searchByProvince(province){
			if(province !== ""){
				$.ajax({
					url: 'parsers/findByProvince',
					method:'post',
					data:{province:province},
					success:function(data){
						$("#lawyersFind").html(data);
					}
				})
				$.ajax({
    				url:"parsers/fetchTowns",
    				method:"post",
    				data:{province:province},
    				success:function(data){
    					$("#town").html(data);
    				}
    			})
			}else{
				lawyersFind();
			}
		}

		function searchByTown(town){
			if(town !== ""){
				$.ajax({
					url: 'parsers/findByTown',
					method:'post',
					data:{town:town},
					success:function(data){
						$("#lawyersFind").html(data);
					}
				})
				
			}else{
				lawyersFind();
			}
		}
	</script>
</body>
</html>