
<?php

require("config.php");
require("functions.php");

$db = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbdatabase);

$check_forum="SELECT * FROM forums;";
$res_check=mysqli_query($db, $check_forum);
$no_forums=mysqli_num_rows($res_check);

if($no_forums==0)
	{ header("Location: ".$config_basedir); }

//validation & assignment of id in next if else
if(isset($_GET['id']) == TRUE)
	 { 
	 	if(is_numeric($_GET['id']) == FALSE) 
			{
			 header("Location: " . $config_basedir);
			  } 
			$validforum = $_GET['id'];
		}
else
	{ $validforum=0;  }		

//check if the user is lgged in

if(!isset($_SESSION['USERNAME']))
	{  header("Location: ".$config_basedir
			."/login.php?ref=newpost&id=".$validforum); }

if($_POST['submit'])
{
	session_start();

	if($validforum == 0)
	{
		$insert_topic="INSERT INTO topics(date, user_id, forum_id, subject)
						VALUES(NOW(), ".$_SESSION['USERID'].", "
							.$_POST['forum'].", '".$_POST['subject']."');";
	}
	else 
	{
		$insert_topic="INSERT INTO topics(date, user_id, forum_id, subject)
						VALUES(NOW(), ".$_SESSION['USERID'].", "
							.$validforum.", '".$_POST['subject']."');";
	}

	$res_insert_topic=mysqli_query($db, $insert_topic);
	$messages="INSERT INTO messages(date, user_id, topic_id, subject, body)
				VALUES(NOW(), ".$_SESSION['USERID'].", ".mysqli_insert_id($db)
					.", '".$_POST['body']."');";

$res_messages=mysqli_query($messages);
header("Location: ".$config_basedir."/viewmessages.php?id=".$topicid);

}

else {
	require("header.php");

	if($validforum!=0)
	{
		$forum_name="SELECT name FROM forums WHERE id=".$validforum.";";
		$res_name=mysqli_query($db, $all_name);
		$row_name=mysqli_fetch_assoc($res_name);

		echo "<h2>Post a new message to the ".$row_name['name']." forum</h2>";
	}

	else 
		{ echo "<h2>Post a new message</h2>";
	
	$all_forums = "SELECT * FROM forums ORDER BY name;"; 
	$res_forum = mysqli_query($all_forums);

	?>
<form action="<?php echo pf_script_with_get($_SERVER['PHP_SELF']); ?>" method="post">
 <table>
	<tr>
		<td>Forum</td>
		<td>
			<select name="forum">
				<?php 
				while($row_forums=mysqli_fetch_assoc($all_forums) )
				{
					echo "<option value=".$row_forums['id'].">"
						.$row_forums['name']."</option>";
				}
				?>
			</select>
		</td>
	</tr>

	<?php } ?>
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