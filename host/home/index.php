<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Host a Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Holiday Homes Booking Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--fonts--> 
<link href="//fonts.googleapis.com/css?family=Barlow:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<!--//fonts--> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
</head>
<body>
<!--background-->
<h1> Host a Home </h1>
    <div class="bg-agile" style="margin-top: 7px;">
	<div class="book-appointment">
		<div>
			<?php include("../../database/hostahome.php"); ?>
		</div>
		<!-- <h2> Host a Home </h2> -->
						<div class="book-form agileits-login">
							<form action="" method="post">
								<div class="phone_email">
									<label>Name of House: </label>
									<div class="form-text">
										<i class="fa fa-home" aria-hidden="true"></i>
										<input type="text" name="name" placeholder="" required="">
									</div> 
								</div>
								<div class="phone_email phone_email1">
									<label>No.of Bedrooms: </label>
									<div class="form-text">
										<i class="fa fa-bed" aria-hidden="true"></i>
										<input type="text" name="bed" placeholder="" required="">
									</div>
								</div>
								<div class="phone_email">
									<label>No.of Bathrooms: </label>
									<div class="form-text">
										<i class="fa fa-square" aria-hidden="true"></i>
										<input type="text" name="bath" placeholder="" required="">
									</div> 
								</div> 
								<div class="phone_email phone_email1">
									<label>Price per Night: </label>
									<div class="form-text">
										<i class="fa fa-money" aria-hidden="true"></i>
										<input type="text" name="price" placeholder="" required="">
									</div> 
								</div> 
								<div class="clear"></div>
								<div class="agileits_reservation_grid">
									<!-- <div class="span1_of_1">
										<label>Departure Date : </label> 
										<div class="book_date"> 
											<i class="fa fa-calendar" aria-hidden="true"></i>
												<input  id="datepicker" name="Text" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">

										</div>					
									</div>
									<div class="span1_of_2">
										<label>Arrival Date : </label> 
										<div class="book_date"> 
											<i class="fa fa-calendar" aria-hidden="true"></i>
												<input  id="datepicker1" name="Text" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'mm/dd/yyyy';}" required="">

										</div>					
									</div> -->
									<div class="clear"></div>
									<div class="span1_of_1">
										<label>kitchen: </label>
										<!-- start_section_room -->
										<div class="section_room">
											<i class="fa " aria-hidden="true"></i>
											<input type="checkbox" name="box[]" value="kit">
										</div>	
									</div>
									<div class="span1_of_2">
										<label>Television: </label>
										<!-- start_section_room -->
										<div class="section_room">
											<i class="fa " aria-hidden="true" style="margin-right:20px;"></i>
											<input type="checkbox" name="box[]" value="tv" id="" >
										</div>	
									</div>
									<div class="clear"></div>
									<div class="span1_of_1">
										<label>Climate Control: </label>
										<!-- start_section_room -->
										<div class="section_room">
											<i class="fa " aria-hidden="true"></i>
											<input type="checkbox" name="box[]" value="ac" >
										</div>	
									</div>
									<div class="span1_of_2">
										<label>Internet: </label>
										<!-- start_section_room -->
										<div class="section_room">
											<i class="icon-wi-fi" aria-hidden="true"></i>
											<input type="checkbox" name="box[]" value="net" id="" >
										</div>	
									</div> 					
									<div class="clear"></div>
									<div class="span1_of_1">
										<label>Max No.of people: </label>
										<!-- start_section_room -->
										<div class="section_room">
											<i class="fa fa-users" aria-hidden="true"></i>
											<select name="people" id="country1" class="frm-field required sect" required>
												<option value=""></option>
												<option value=1>1 People</option>
												<option value=2>2 People</option>
												<option value=3>3 People</option>         
												<option value=4>4 People</option>
												<option value=5>5+ People</option>
											</select>
										</div>	
									</div>
									<div class="span1_of_2">
										<label>Select Type: </label>
										<!-- start_section_room -->
										<div class="section_room">
											<i class="fa fa-home" aria-hidden="true"></i>
											<select name="type" id="country1" class="frm-field required sect" required>
												<option value=""></option>
												<option value="villa">Villa</option>
												<option value="appartment">Apartment</option>
												<option value="house">House</option>         
											</select>
										</div>	
									</div> 									
									<div class="clear"></div>

									<div class="span1_of_1">
										<label>Select Country: </label> 
										<div class="section_room"> 
											<select style="width: 100%;" class="pt-4 pb-4 countries js-example-basic-single js-states form-control" id="countries" name="countries" onchange="return getcities();" required>
												<option value="">Select Country</option>
											</select>
										</div>					
									</div>
									<div class="span1_of_2">
										<label>Select City: </label> 
										<div class="section_room"> 
											<select style="width: 100%;" class="pt-4 pb-4 cities js-example-basic-single js-states form-control" id="cities" name="cities" required>
												<option value="">Select City</option>
											</select>
										</div>					
									</div> 
									<div class="clear"></div>
								</div> 
								<div class="clear"></div>
								<input name="hosthome" type="submit" value="Host" style="width: 100%;">
							</form>
						</div>

		</div>
   </div>
   <!--copyright-->
			<!-- <div class="copy w3ls">
		       <p>&copy; 2018 Holiday Homes Booking Form . All Rights Reserved  | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
	        </div> -->
		<!--//copyright-->
		<!-- <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script> -->
		<!-- Calendar -->
				<!-- <link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script> -->
			<!-- //Calendar -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> 
	<script type="text/javascript">	
		var base= "https://shivammathur.com/countrycity"	
		$.ajax({
		    url: base+"/countries",
		    dataType: 'json',
		}).done(function(data){
		    result = $.map(data, function (item) {
		        return {
		            id: item,
		            text: item
		        };
		    });		    
		    $("#countries").select2({
		        placeholder: "Choose a country",
		        data: result,
		    });
		});
	    $("#cities").select2({
	        placeholder: "Choose a country first",
	        data: null,
	    });	
		function getcities() {
			var country = $('#countries').val();
			$.ajax({
			    url: base+"/cities/" + country,
			    dataType: 'json',
			}).done(function(data){
			    result = $.map(data, function (item) {
			        return {
			            id: item,
			            text: item
			        };
			    });
			    $('#cities option').not(':first').remove();
			    $("#cities").select2({
			        placeholder: "Choose a city in " + country,
			        data: result,
			    });			    
			});				
		}
	</script>

</body>
</html>