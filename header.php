<?php
session_start();

require("config.php");

$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase); 
?>

<html>
<head>
	<title><?php echo $config_forumsname; ?></title>
	 <link rel="stylesheet" href="stylesheet.css" type="text/css" /> 
	</head>

	<body>
		<div id="header">
			<h1><?php echo $config_forumsname; ?></h1>

			[<a href="index.php">Home</a>]

<?php
if(isset($_SESSION['USERNAME']) == TRUE)
 	{ 
 		echo "[<a href='logout.php'>Logout</a>]"; 
 	}
 		 else { 
 		 		echo "[<a href='login.php'>Login</a>]"; 
 		 		echo "[<a href='register.php'>Register</a>]"; 
 		 		}
?>

[<a href="newtopic.php">New Topic</a>]</br></br> 
 	</div>

 <div id="main">	 
