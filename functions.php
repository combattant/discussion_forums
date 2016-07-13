<?php

/* used to process the script name ($SCRIPT_NAME) to detect 
 which GET variables are added to the current page and then 
 bolt them on to the action of the form. 
  if you know the name of the GET variable, then its fine;  but if the 
 variables could vary, you need to detect them and add them.
*/
 
function pf_script_with_get($script){
	$page = $script;
	$page = $page."?";

//from where r we providing the key and val?? for eg. how does it 
	// know that key=id n val=1

	foreach($_GET as $key => $val)
	{
		$page=$page.$key."=".$val."&";
	}
	return substr($page, 0, strlen($page)-1);
}

?>