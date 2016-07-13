<?php

require("header.php");

if(isset($_SESSION['ADMIN'])) 
	{ 
		echo "[<a href='addcat.php'>Add new category</a>]"; 
		echo "[<a href='addforum.php'>Add new forum</a>]";
	}


$all_cat="SELECT * FROM categories;";
$res_all_cat=mysqli_query($db, $all_cat);

echo "<table cellspacing=0>";

	while($row_all_cat=mysqli_fetch_assoc($res_all_cat))
	{
		echo "<tr class='head'><td colspan=2>";

		if(isset($_SESSION['ADMIN'])) 
			{ echo "[<a href='delete.php?func=cat&id=".$row_all_cat['id']."'>X</a>] - "; }

		echo "<strong>".$row_all_cat['name']."</strong></td></tr>";


		$forum_in_cat="SELECT * FROM forums WHERE cat_id=".$row_all_cat['id'].";";
		$res_forum_in_cat=mysqli_query($db, $forum_in_cat);

		$num_forum_in_cat=mysqli_num_rows($res_forum_in_cat);

		if($num_forum_in_cat==0)
		{
			echo "<tr><td>No Forums!!</td></tr>";
		}
		else
		{
			while($row_forum_in_cat=mysqli_fetch_assoc($res_forum_in_cat))
			{
				echo "<tr>";
				echo"<td>";

				if(isset($_SESSION['ADMIN'])) 
			{ echo "[<a href='delete.php?func=forum&id=".$row_forum_in_cat['id']."'>X</a>] - "; }
				
				echo "<strong><a href='viewforum.php?id="
					.$row_forum_in_cat['id']."'>".$row_forum_in_cat['name']
					."</a></strong>";
				echo "<br/><i>".$row_forum_in_cat['description']."</i>";
				echo "</td>";
				echo "</tr>";
			}
		}

	}

echo "</table>";

require("footer.php");

?>