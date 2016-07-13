<?php

require("config.php"); 
require("functions.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase); 

if(isset($_POST['submit'])) 
	{ 
		session_start();
		$check_admin = "SELECT * FROM admins WHERE username = '" 
			. $_POST['username'] . "' AND password = '" . $_POST['password'] . "';";


	$res_admin=mysqli_query($db, $check_admin);
	$no_admin=mysqli_num_rows($res_admin);

	if($numrows == 1)
	 { 
	 	$row_admin = mysql_fetch_assoc($result);
		
		$_SESSION['ADMIN'] = $row_admin['username'];

		switch($_GET['ref']) 
			{ 
				case "add": 
					header("Location: " . $config_basedir . "/addforum.php"); 
					break;
				case "cat": 
					header("Location: " . $config_basedir . "/addcat.php"); 
					break;
				case "del": 
					header("Location: " . $config_basedir); 
					break;
				default: 
					header("Location: " . $config_basedir);
					 break;
			}
	}
	else {
		header("Location: " . $config_basedir . "/admin.php?error=1");
	 }
	}

	else {
		require("header.php");

		echo "<h2>Admin Login</h2>";
		if(isset($_GET['error']))
		{
			echo "Incorrect login, please try again!";
		}
?>

<form action="<?php echo pf_script_with_get($_SERVER['PHP_SELF']); ?>" method="post">
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
 <td colspan='2'><input type="submit" name="submit" value="Login!"></td> 
</tr> 
</table>
</form>

<?php

}
require("footer.php");

?>
