<?php

include("config.php");

if(isset($_GET['id']) == TRUE)
 { 
 	if(is_numeric($_GET['id']) == FALSE) 
		{
			 header("Location: " . $config_basedir); 
		} 
	else { 
			$validtopic = $_GET['id'];
		 }
} 
	else { 
			header("Location: " . $config_basedir); 
		}

require("header.php");

$topic="SELECT topics.forum_id, topics.subject, forums.name, 
		FROM topics, forums WHERE topics.forum_id= forums.id 
		AND topics.id=".$validtopic.";";

	$res_topic=mysqli_query($db, $topic);
	$row_topic=mysqli_fetch_assoc($res_topic);

	echo "<h2>".$row_topic['subject']."</h2>"; 

//breadcrumb trail
	echo "<a href='index.php'>".$config_forumsname."</a> --> <a href='viewforum.php?id="
			.$row_topic['forum_id']."'>".$row_topic['name']."</a> --> 
			<a href='viewmessages.php?id=".$validtopic."'>"
			.$row_topic['subject']."</a></br></br>";

			$thread="SELECT messages.*, users.username FROM messages, users 
			WHERE messages.user_id=users.id AND messages.topic_id="
			.$validtopic." ORDER BY messages.date;";
			
			$res_thread=mysqli_query($db, $thread);

	echo "<table>";

		echo"<tr><strong>";
		echo "<th>Posted on</th>";
		echo "<th>Posted by</th>";
		echo "<th>Message</th>";
		echo "</strong><tr>";

	while($row_thread=mysqli_fetch_assoc($res_thread))
	{
		echo "<tr>";
		echo "<td>".date("D jS F Y g.iA",strtotime($row_thread['date']))."</td>";
		echo "<td>".$row_thread['username']."</td>";
		echo "<td>".$row_thread['body']."</td>";
		echo "</tr>";
		echo "<tr></tr>";
	}	
	echo "<tr><td>[<a href='reply.php?id=".$validtopic."'>Reply</a>]</td></tr>";
	echo "<tr></tr>";
	echo "</table>";

	require("footer.php");

	?>

