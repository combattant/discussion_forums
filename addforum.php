<?php

require("config.php");
require("functions.php");

$db=mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

if(isset($_POST['submit']))
{
	session_start();
	if(!isset($_SESSION['ADMIN'])) 
		{ 
			header("Location: " . $config_basedir . "/admin.php?ref=add"); 
		} 

			$insert_forum="INSERT into forums(cat_id, name, description)
					VALUES(".$_POST['cat'].", '".$_POST['name'].", '".$_POST['description']."');";
		
		$res_ins_forum=mysqli_query($db, $insert_forum);
		header("Location: ".$config_basedir);
}

else 
{ 
	require("header.php");

?>



<h2>Add a new forum</h2>
<form action="<?php echo pf_script_with_get($_SERVER['PHP_SELF']); ?>" method="post">
 <table> 
 	<?php

		$all_cat = "SELECT * FROM categories ORDER BY name;"; 
		$res_cat = mysqli_query($db, $all_cat); ?> 
		<tr> 
			<td>Forum</td>
			 <td> <select name="cat">
			  <?php while($row_all_cat = mysqli_fetch_assoc($res_cat))
			   {
			    echo "<option value='" . $row_all_cat['id'] . "'>" 
			    . $row_all_cat['name'] . "</option>"; 
			    } 
			  ?> 
			</select> 
		</td> 
	</tr> 

<tr> 
	<td>Name</td> 
	<td><input type="text" name="name"></td> 
</tr> 
<tr> 
	<td>Description</td>
	 <td><textarea name="description" rows="10" cols="50"></textarea></td> 
</tr> 
<tr> 
	<td></td> 
	<td><input type="submit" name="submit" value="Add Forum!"></td> 
</tr> 
</table> 
</form>

<?php
}
require("footer.php");
?>