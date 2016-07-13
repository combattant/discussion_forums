<?php

require("config.php");
require("functions.php");

$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase); 

//validation of id
if(isset($_GET['id']) == TRUE)
	 { 
	 	if(is_numeric($_GET['id']) == FALSE) 
			{
			 header("Location: " . $config_basedir);
			  } 
			else {$validtopic = $_GET['id']; }
		}
		else{
			header("Location: ".$config_basedir);
		}

//check if user is logged in
 if(!isset($_SESSION['USERNAME']))
	{  header("Location: ".$config_basedir
			."/login.php?ref=reply&id=".$validtopic); }


if(isset($_POST['submit']))
{
	session_start();
$insert_message="INSERT INTO messages(date, user_id, topic_id, subject, body)
						VALUES(NOW(), ".$_SESSION['USERID'].", "
							.$validtopic.", '".$_POST['subject']."', '".$_POST['body']."');";

$res_ins_msg=mysqli_query($db, $insert_message);
header("Location: ".$config_basedir."/viewmessages.php?id=".$validtopic);
}

else
{
	require("header.php");
?>


<form action="<?php echo pf_script_with_get($_SERVER['PHP_SELF']); ?>" method="post"> 
	<table> 
		<tr>
		 <td>Subject</td> 
		 <td><input type="text" name="subject"></td> 
		</tr> 
		<tr>
		 <td>Body</td>
		  <td><textarea name="body" rows="10" cols="50"></textarea></td> 
		</tr> 
		<tr> 
			<td colspan='2'><input type="submit" name="submit" value="Post!"></td> 
		</tr> 
	</table> 
</form>

<?php 
}
require("footer.php");
?>