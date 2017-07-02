<?php 
session_start();
include('dbconnection.php');

// Code for login system - Secure Code For Front User
if(isset($_POST['login']))
{
	//Case Insensitive Secure Code
	$password=$_POST['password'];
	$ret= mysqli_query($bd,"SELECT * FROM securecode WHERE code='$password'");
	$num=mysqli_fetch_array($ret);

if($num>0)
		{
			$extra="mainpage.php";
			$_SESSION['login']=$_POST['password'];
			// $_SESSION['id']=$num['id'];
			// $_SESSION['name']=$num['fname'];
			$host=$_SERVER['HTTP_HOST'];
			$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}
		else
		{
			echo "<script>alert('Invalid Secure Code!! Contact Administrator');</script>";
			$extra="index.php";
			$host  = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			//Keep a Alert Here if you uncomment Following Code
			//header("location:http://$host$uri/$extra");
			exit();
		}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>File Uploading System | NOKIA</title>
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<script src="js/jquery.min.js"></script>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
				<script type="text/javascript">
					$(document).ready(function () {
						$('#horizontalTab').easyResponsiveTabs({
							type: 'default',       
							width: 'auto', 
							fit: true 
						});
					});
				   </script>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600,700,200italic,300italic,400italic,600italic|Lora:400,700,400italic,700italic|Raleway:400,500,300,600,700,200,100' rel='stylesheet' type='text/css'>

</head>
<body>

<div class="main">
		<h1>Welcome to File Uploading System For Nokia Employee</h1>
	 <div class="sap_tabs">	
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
			  <ul class="resp-tabs-list">
			  	  <!-- <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><div class="top-img"><img src="images/top-note.png" alt=""/></div><span>Register</span> -->
			  	  	
				</li>
				  <li class="resp-tab-item" aria-controls="tab_item-1" role="tab" style="display: block; width: 100%; margin: 0px;"><div class="top-img"><img src="images/top-lock.png" alt=""/></div><span>Secure Login</span></li>
				  <!-- <li class="resp-tab-item lost" aria-controls="tab_item-2" role="tab"><div class="top-img"><img src="images/top-key.png" alt=""/></div><span>Forgot Password</span></li> -->
				  <div class="clear"></div>
			  </ul>		
			  	 
	<div class="resp-tabs-container">	
		<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
					 	<div class="facts">
							 <div class="login">
							<div class="buttons">
							</div>
							<form name="login" action="" method="post">
								<!-- <input type="text" class="text" name="uemail" value="" placeholder="Enter your registered email"  ><a href="#" class=" icon email"></a> -->

								<input type="text" value="" name="password" placeholder="Enter Secure Code Here"><a href="#" class="icon lock"></a>
									<!-- Nokai - Put password in Input type if you want to display in password form -->
								<div class="p-container">
									<div class="submit two" id="inner">
									<input type="submit" name="login" value="LOG IN" >
									</div>

									<div class="clear"> </div>

								</div>
							</form>
						</div>
					</div> 
				</div> 			        					 
				     </div>	
		        </div>
	        </div>
	     </div>




</body>
</html>
<!-- 	
	PREPARED STATEMENT REPLACEMENT
$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "nokiaus";
	$password1=$_POST['password'];
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$stmt = $conn->prepare('SELECT * FROM securecode WHERE code= ?');
	$stmt->bind_param('s', $password1);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) 
	{
    	printf ("%s\n", $row["code"]);
    	//Here Comes Secure Code - ABC 123
    } 
    -->