<?php 
								// echo $_SESSION['id'];
								if (isset($_SESSION['id'])){
									$id = $_SESSION['id'];
									$re = $mysqli->query("SELECT name,host FROM persons WHERE id = '$id'");
									$data = $re->fetch_assoc();
									$name = $data['name'];
									if ($data['host']==="no"){
								?>
								<li class="has-dropdown">
									<a href="#">Become a Host</a>
									<ul class="dropdown">
										<li><a href="host/home">List your place</a></li>
										<li><a href="host/tour">Host an experience</a></li>
									</ul>
								</li>
								<?php }else{ ?>
								<li><a href="host/home">Host a Home</a></li>
								<li><a href="host/tour">Host an Experience</a></li>
								<?php } ?>
								<li class="has-dropdown">
									<a href="" onclick="return false;" style="color:aqua"><img src="images/user.png" alt="icon" hspace="15"><?php echo ucfirst($name) ?></a>
									<ul class="dropdown">
										<li><a href="dashboard/user.php">Dashboard</a></li>
										<li><a href="database/signout.php">Sign Out</a></li>
									</ul>
								</li>
								<?php
								}
								else{
								?>
								<li class="has-dropdown">
									<a href="#">Become a Host</a>
									<ul class="dropdown">
										<li><a href="host/home">List your place</a></li>
										<li><a href="host/tour">Host an experience</a></li>
									</ul>
								</li>
								<li><a href="enter.php">Sign In</a></li>
								<?php
								}
								?>