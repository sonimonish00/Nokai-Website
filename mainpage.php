<?php
session_start();
include("checklogin.php");
//Checks for Login of User
check_login();	

require_once("dbconnection.php");

//Load the settings
require_once("settings.php");
$message = "";

//Setting the Time Limit 
set_time_limit(0);

//Has the user uploaded something?
if(isset($_FILES['file']))
{
	$target_path = Settings::$uploadFolder;
	$target_path = $target_path . time() . '_' . basename( $_FILES['file']['name']); 
	
	//Fetch Username & Password here - Encrypt the Password here in MD5 if possible in Future
	$mypass = $_POST['pass'];
	$myuser = $_POST['userid'];
	$statement= mysqli_query($bd,"SELECT * FROM user WHERE userid='".$myuser."' and password='$mypass'");
	$check=mysqli_fetch_array($statement);

	//Check the username and password to verify legal upload
	if(!($check>0))
	{
		$message = "Invalid Username or Password!! Contact Administrator ";
	}
	else
	{
		//Try to move the uploaded file into the designated folder
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
		    $message = "The file ".  basename( $_FILES['file']['name']). 
		    " has been uploaded";
		} else{
		    $message = "There was an error uploading the file, please try again!";
		}
	}
	
	//Clear the array
	unset($_FILES['file']);
}

if(strlen($message) > 0)
{
	$message = '<p class="error">' . $message . '</p>';
}

/** LIST UPLOADED FILES **/
$uploaded_files = "";

//Open directory for reading
$dh = opendir(Settings::$uploadFolder);

//LOOP through the files
while (($file = readdir($dh)) !== false) 
{
	if($file != '.' && $file != '..')
	{
		$filename = Settings::$uploadFolder . $file;
		$parts = explode("_", $file);
		$size = formatBytes(filesize($filename));
		$added = date("m/d/Y", $parts[0]);
		$origName = $parts[1];
		$filetype = getFileType(substr($file, strlen($file) - 3));
        $uploaded_files .= "<li class=\"$filetype\"><a href=\"$filename\">$origName</a> $size - $added</li>\n";
	}
}
closedir($dh);

if(strlen($uploaded_files) == 0)
{
	$uploaded_files = "<li><em>No files found</em></li>";
}

function getFileType($extension)
{
	$images = array('jpg', 'gif', 'png', 'bmp');
	$docs 	= array('txt', 'rtf', 'doc');
	$apps 	= array('zip', 'rar', 'exe','.7z');
	
	if(in_array($extension, $images)) return "Images";
	if(in_array($extension, $docs)) return "Documents";
	if(in_array($extension, $apps)) return "Applications";
	return "";
}

function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
   
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
   
    $bytes /= pow(1024, $pow); 
   
    return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
?>

<!DOCTYPE PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Welcome to File Uploading System | NOKIA</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/heroic-features.css" rel="stylesheet">

	<style type="text/css" media="all"> 
	    @import url("css/style1.css");
	</style>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
	    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Welcome User</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <!-- <a href="#"><?php echo $_SESSION['name'];?></a> -->
                        <a href="#">Link1</a>
                    </li>
                    <li>
                        <a href="#">Link2</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
    <!-- FROM HERE COMES THE ACTUAL CODE :---------- -->
    <div class="container">
        <header class="jumbotron hero-spacer">
            <h2>Welcome to file uploading system by NOKIA</h2>
            <p> This is an Online Portal To Upload Any File Here !!! Start Uploading Below</p>
            <!-- <p><a  href="logout.php" class="btn btn-primary btn-large">Logout </a> -->
            </p>
        </header>

					<!-- MAIN LOGIC STARTS HERE -->
		
	    <form method="post" action="mainpage.php" enctype="multipart/form-data">
			
			<input type="hidden" name="MAX_FILE_SIZE" value="524288000" />
			
			<fieldset>
				<legend>Add a new file to the storage</legend>
					<?php echo $message; ?>
					<p><label for="name">Select file</label><br />
					<input type="file" name="file" /></p>
					
					<p><label for="userid">Username :</label><br />
		        	<input type="text" name="userid" /></p>

					<p><label for="pass">Password for upload</label><br />
					<input type="password" name="pass" /></p>
					
					<p><input type="submit" name="submit" value="Start upload" /></p>	
				</fieldset>
		</form>

	    	<fieldset>
			    <legend>Previousely uploaded files</legend>
			    <ul id="menu">
			        <li><a href="">All files</a></li>
			        <li><a href="">Documents</a></li>
			        <li><a href="">Images</a></li>
			        <li><a href="">Applications</a></li>
			    </ul>
			    
			    <ul id="files">
						<?php echo $uploaded_files; ?>
				</ul>
			</fieldset>
		<hr>
        </div>
        <hr>
		
		<!-- <div id="container">
    		<h1>Online File Storage</h1>
		</div> -->

    </div>
    <script src="js/filestorage.js" />
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>