<?php

require("header.php");

$verify_str=urldecode($_GET['verify']);
$verify_email=urldecode($_GET['email']);

$check_verify="SELECT id FROM users WHERE verify='"
			.$verify_str."' AND email='".$verify_email."';";

	$res_check=mysqli_query($db, $check_verify);
	
	$num_check=mysqli_num_rows($res_check);

	if($num_check==1)
	{
		$row_check=mysqli_fetch_assoc($res_check);

		$update_active="UPDATE users SET active=1 WHERE id=".$row_check['id'].";";
		$res_update=mysqli_query($db, $update_active);

		echo "Your account has now been verified.
			 	You can now <a href='login.php'>login</a>";
	}
	else
	{
		echo  "This account could not be verified.";
	}
require("footer.php");


?>