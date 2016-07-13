<?php

require("config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

if(isset($_POST['submit'])) 
	{ 
		if($_POST['password1'] == $_POST['password2']) 
				{
					 $checksql = "SELECT * FROM users 
					 WHERE username='".$_POST['username']."';";

					  $checkresult = mysqli_query($db, $checksql); 

					  $checknumrows = mysqli_num_rows($checkresult);

					  if($checknumrows == 1) 
					  		{ 
					  			header("Location: " . $config_basedir . "register.php?error=taken"); 
					  		}

					  else {
					  	for($i=0;$i<16;$i++)
  					  		{ $ran_str .= chr(mt_rand(32,126)); }
					  	}

					  $verify_url= "verify.php";
					  $verify_str= urlencode($ran_str);
					  $verify_email=urlencode($_POST['email']);
					  $valid_user=$_POST['username'];

					  $verify_insert="INSERT INTO users(username, password, email, verifystring, active)
					  				VALUES('".$_POST['username']."', '".$_POST['password1']
					  						."', '".$_POST['email'].", '".addslashes($ran_str)."' 0);";
						$res_verify=mysqli_query($db, $verify_insert);

						$email_header="From: <kritimahalaxmi@gmail.com>";

// note: the last character b4 closing identifier must be a new line character.
						$mail_body = <<<_MAIL
						Hi $valid_user,

						Please click on the following link to verify your account:

						$verify_url?email=$verify_email&verify=$verify_str
_MAIL;

				mail($_POST['email'], $config_forumsname." - User Verification", $mail_body, $email_header );

		require("header.php");

		echo "A link has been emailed to the address you entered below.
				 Please follow the link in the email to validate your account.";
		}

// if passwords do not match..
		else
		{
			  header("Location: ".$config_basedir."/register.php?error=pass");
		}
	
	}

else
{
	require("header.php");

	switch(isset($_GET['error']))
	{
		case "pass":
		echo "Passwords do not match!";
		break;
		case  "taken": 
		echo "Username taken, please use another."; 
		break;
		case "no": 
		echo "Incorrect login details!";
		break;

	}

?>


<script type="text/javascript">

function validator(){

if( document.forms[0].elements[0].value == "" )
         {
            alert( "This field is required!" );
            document.forms[0].your_name.focus() ;
            return false;
         }

if( document.forms[0].elements[1].value == "" )
         {
            alert( "This field is mandatory!" );
            document.forms[0].your_name.focus() ;
            return false;
         }
if( document.forms[0].elements[2].value == "" )
         {
            alert( "This field is required!" );
            document.forms[0].your_name.focus() ;
            return false;
         }

}



function validate_Email(){

	var email = document.forms[0].email.value;
         atpos = email.indexOf("@");
         dotpos = email.lastIndexOf(".");
         
         if (atpos < 1 || ( dotpos - atpos < 2 )) 
         {
            alert("Please enter correct email ID")
            document.forms[0].email.focus() ;
            return false;
         }
         return( true );
}


</script>



<h2>Register</h2>
To register on <?php echo $config_forumsname ?>, fill in the form below.
<form action='<?php echo $_SERVER['REQUEST_URI'] ?>' method="POST">

<table>
	<tr>
		<td>Username</td>
		<td><input type='username' name='username'></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type='password' name='password1'></td>
	</tr>
	<tr>
		<td>Confirm Password</td>
		<td><input type='password' name='password2'></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><input type="email" name="email"></td>
	</tr>
	<tr>   
		<td colspan='2' align="center"><input type="submit" name="submit" value="Register!"  onclick="validator()" onclick="validate_Email()"></td> 
	</tr> 
</table>

</form>


<?php

	}
	require("footer.php");

?>
