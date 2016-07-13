
 <?php

// in this pg, the switch statement needs to be shifted smwhere else, bcoz if u try to login directly
 // w/o any reference then it simply redirects u to the index pg bcoz of the default case. 
require("config.php");
require("functions.php");

$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

if(isset($_POST['submit']))
{
	session_start();

	$check_user= "SELECT * FROM  users WHERE username='".$_POST['username']
				."' AND password='".$_POST['password']."';";
	$res_check_user=mysqli_query($db, $check_user);

	$num_check_user=mysqli_num_rows($res_check_user);

	if($numrows == 1)
	 { 
	 	$row_check = mysql_fetch_assoc($result); 

	 	if($row_check['active'] == 1) 
	 	{

	 			$_SESSION['USERNAME'] = $row_check['username']; 
	 			$_SESSION['USERID'] = $row_check['id'];

switch($_GET['ref']) { 
	case "newpost": 
		if(isset($_GET['id']) == FALSE) 
			{
				 header("Location: " . $config_basedir . "/newtopic.php"); 
			} 
		else { 
				 header("Location: " . $config_basedir . "/newtopic.php?id=" 
				 	. $_GET['id']); 
			} 

			break;
	case "reply": 
		if(isset($_GET['id']) == FALSE) 
			{ 
				header("Location: " . $config_basedir . "/reply.php");
			 } 
		else 
			{ 
				header("Location: " . $config_basedir . "/reply.php?id="
				 . $_GET['id']);
			 } 
			 break;
/*	default: 
		header("Location: " . $config_basedir); 
		break;
*/ 	
	}
// closing bracket of active rows
	}

else {
	require("header.php");
echo "This account is not verified yet. 
		You were emailed a link to verify the account. 
		Please click on the link in the email to continue." ;
	}

}

	else {
		header("Location: " . $config_basedir . "/login.php?error=1");
	}
}

else
{
	require("header.php");
	if(isset($_GET['error']))
	{
		echo   "Incorrect login, please try again!";
	}

?>

<form action="<?php echo pf_script_with_get( $_SERVER['PHP_SELF'] ); ?>" method="post">
<table> 
	<tr> 
		<td>Username</td>
		 <td><input type="text" name="username"></td> 
	</tr> 
	<tr> 
		<td>Password</td> 
		<td><input type="password" name="password"></td>
	 </tr> 
	 <tr> 
	 	<td colspan='2' align='center'>
	 		<input type="submit" name="submit" value="Login!">
	 	</td> 
	 </tr> 
	</table> 
</form>

<?php

}
require("footer.php");
?>
