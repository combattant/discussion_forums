<?php

session_start();
if(isset($_SESSION["USERNAME"]))
{
	session_unregister("USERNAME");		
}

else if(isset($_SESSION["ADMIN"]))
{
	session_unregister("ADMIN");
}

require("config.php");
header("Location: ".$config_basedir);

?>