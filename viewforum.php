<?php

require("config.php");
if(isset($_GET['id']) == TRUE)
	 { 
	 	if(is_numeric($_GET['id']) == FALSE) 
			{
			 header("Location: " . $config_basedir);
			  } 
		else {	$validforum = $_GET['id']; }
		}
else{
			header("Location: ".$config_basedir);
		}

require("header.php");

$current_forum="SELECT * FROM forums WHERE id=".$validforum.";";

$res_current_forum=mysqli_query($db, $current_forum);
$row_current_forum=mysqli_fetch_assoc($res_current_forum);

echo "<h2>".$row_current_forum['name']."</h2>";

// note: breadcrumb trail -->  A breadcrumb trail provides a series of links that shows the steps taken 
// to get to the current page in the site.

echo "<a href='index.php'>".$config_forumsname."</a> > <a href='"
		.$config_basedir."'>forums</a></br></br>"; 

echo "[<a href='newtopic.php?id=" . $validforum . "'>New Topic</a>]<br /><br />";

$topic_in_forum="SELECT messages.date, topics.id AS topicid, 
				topics.*, users.*
				FROM messages, topics, users
				WHERE topics.id=messages.topic_id AND users.id=topics.user_id
				AND topics.forum_id=".$validforum."
				GROUP BY messages.topic_id ORDER BY messages.date DESC;";

	$res_topic_in_forum = mysqli_query($db, $topic_in_forum);
	
	$num_topic_in_forum =mysqli_num_rows($res_topic_in_forum);		

	if($num_topic_in_forum==0)	
	{
		echo "<table width='250px'><tr><td>No topics!!</td></tr></table>";
	}

	else 
	{
		echo "<table class='forum'>";

		echo "<tr><th>Topic<th>";
		echo	"<th>Replies</th>";
		echo		"<th>Author</th>";
		echo 			"<th>Date Posted</th></tr>";
	
	while($row_topic_in_forum=mysqli_fetch_assoc($res_topic_in_forum))
	{
		  $msgs_in_topic="SELECT id FROM messages WHERE topic_id=".$row_topic_in_forum['topicid'].";";

		 $res_msgs_in_topic=mysqli_query($db, $msgs_in_topic);

		echo "<tr><td>";

if(isset($_SESSION['ADMIN'])) 
			{ echo "[<a href='delete.php?func=thread&id="
				.$row_topic_in_forum['topicid']."?forum=".$validforum."'>X</a>] - "; }

		echo "<strong>";
		echo "<a href='viewmessages.php?id=".$row_topic_in_forum['topicid']."'>"
				.$row_topic_in_forum['subject']."</a></strong></td>";
		echo "<td>".$num_topic_in_forum."</td>";
		echo "<td>".$row_topic_in_forum['username']."</td>"
		;
		echo "<td>".date("D jS F Y g.iA", strtotime($row_topic_in_forum['date']))."</td>";

		echo "</tr>";


	}

	echo "</table>";

}

require("footer.php");

?>