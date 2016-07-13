
</div> 

<div id="footer"> 
</br>	&copy; 2016 </br>
		<?php echo "<a href='mailto:" . $config_adminemail . "'>Mail to " .$config_admin . "</a></br>"; 

if(isset($_SESSION['ADMIN']) == TRUE) 
	{  echo "[<a href='logout.php'>Admin Logout</a>]"; } 
else 
	 	{  echo "[<a href='admin.php'>Admin Login</a>]"; } 

?>
</div>
 
 </body> 
 
 </html>
 