<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SignIn/SignUp</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/enter.css">
    
</head>

<body>
    <div id="pre" style="width:100%;text-align:center;font-size:190%;color:white;">
        <span ><?php include("database/enter.php");?></span>
    </div>
    <div class="container">
        <div class="row">
			<div class="col-md-5 mx-auto">
         <?php
         // if (isset($_GET['signin'])){
         ?>
         <div id="first">
				<div class="myform form ">
					 <div class="logo mb-3">
						 <div class="col-md-12 text-center">
							<h1>SignIn</h1>
						 </div>
					</div>
                   <form action="" method="post" name="login">
                           <div class="form-group">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                           </div>
                           <div class="form-group">
                              <i class="fa fa-sign-in" aria-hidden="true"></i>
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                           </div>
                           <div class="form-group">
                              <!-- <p class="text-center">By signing up you accept our <a href="#">Terms Of Use</a></p> -->
                              <pre></pre>
                           </div>
                           <div class="col-md-12 text-center ">
                              <button name="signin" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Sign In</button>
                           </div>
                           <div class="col-md-12 ">
                              <div class="login-or">
                                 <hr class="hr-or">
                                 <!-- <span class="span-or">or</span> -->
                              </div>
                           </div>
                           <!-- <div class="col-md-12 mb-3">
                              <p class="text-center">
                                 <a href="javascript:void();" class="google btn mybtn"><i class="fa fa-google-plus">
                                 </i> Signup using Google
                                 </a>
                              </p>
                           </div> -->
                           <div class="form-group">
                              <p class="text-center">Don't have account? <a href="" id="signup" onclick="return false;">Sign up here</a></p>
                           </div>
                        </form>
                 
				</div>
			</div>
         <?php 
         //  }else if (isset($_GET['signup'])){ 
             ?>
            <div id="second">
			      <div class="myform form ">
                        <div class="logo mb-3">
                           <div class="col-md-12 text-center">
                              <h1 >Signup</h1>
                           </div>
                        </div>
                        <form action="" method="POST" name="registration">
                           <div class="form-group">
                              <i class="fa fa-user" aria-hidden="true"></i>
                              <label for="exampleInputEmail1">Full Name</label>
                              <input type="text"  name="name" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="Enter Name" required>
                           </div>
                           <!-- <div class="form-group">
                              <label for="exampleInputEmail1">Last Name</label>
                              <input type="text"  name="lastname" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="Enter Lastname" required>
                           </div> -->
                           <div class="form-group">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                              <label for="exampleInputEmail1">Email address</label>
                              <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"required>
                           </div>
                           <div class="form-group">
                              <i class="fa fa-sign-in" aria-hidden="true"></i>
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password" required>
                           </div>
                           <div class="col-md-12 text-center mb-3">
                              <button name="signup" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Get Started For Free</button>
                           </div>
                           <div class="col-md-12 ">
                              <div class="form-group">
                                 <p class="text-center"><a href="#" id="signin" onclick="return false;">Already have an account?</a></p>
                              </div>
                           </div>
                            </div>
                        </form>
                     </div>
			</div>
		</div>
         <?php 
         // } 
         ?>
		</div>
      </div>   
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="js/enter.js"></script>
         
</body>

</html>