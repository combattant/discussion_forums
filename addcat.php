<?php

require("config.php");
$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase); 

if(isset($_POST['submit'])) 
	{ 
		if(!isset($_SESSION['ADMIN']))
			{
				header("Location: ".$config_basedir."/admin.php?ref=cat");
			}

		$insert_cat = "INSERT INTO entries(cat_id, dateposted, subject, body) 
			VALUES(" . $_POST['cat'] . ", NOW(), '" . $_POST['subject'] . "', '" . $_POST['body'] . "');";

		 $res_ins_cat=mysqli_query($db, $insert_cat); 
		 header("Location: " . $config_basedir);
	 } 

else 
	{ 
		require("header.php"); 
		if(!isset($_SESSION['ADMIN']))
			{
				header("Location: ".$config_basedir."/admin.php?ref=cat");
			}
?>

<h2>Add a new category</h2>
<form action="<?php echo pf_script_with_get($_SERVER['PHP_SELF']); ?>" method="post">
 <table>
  <tr> <td>Category</td> 
  	<td><input type="text" name="cat"></td> 
  </tr>
   <tr>
   	<td colspan='2'><input type="submit" name="submit" value="Add Category!"></td> 
   </tr> 
</table> 
</form>

<?php
}
require("footer.php");
?>