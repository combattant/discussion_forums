<?php

require("config.php");
$db=mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

if(isset($_GET['id']))
{
	if(is_numeric($_GET['id']) == FALSE) 
			{
			 header("Location: " . $config_basedir);
			  } 
			else { $validid = $_GET['id']; }
}
else
{
			header("Location: ".$config_basedir); 
}

switch($_GET['func'])
 { 
 	case "cat":
	 	  $del_cat = "DELETE FROM categories WHERE id = ". $validid . ";"; 
	 	  $res_del_cat=mysqli_query($db, $del_cat);
	 	  header("Location: " . $config_basedir); 
	 	  break;
case "forum": 
		  $del_forum = "DELETE FROM forums WHERE id = " . $validid . ";";
		  $res_del_forum= mysqli_query($db, $del_forum);
		  header("Location: " . $config_basedir); break;
case "thread": 
		  $del_thread = "DELETE FROM topics WHERE id = " . $validid . ";"; 
		  $res_del_thread=mysqli_query($db,$del_thread); 
		  header("Location: " . $config_basedir . "/viewforum.php?id=" . $_GET['forum']); 
		  break;
default: 
		  header("Location: " . $config_basedir); 
		  break;
} 

?>
