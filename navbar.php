<?php
if(file_exists("install.php"))
{
	die('<p style="padding: 5px; background-color: #EEFF57; border: 2px solid black;"><strong>Important:</strong> Delete install.php to complete installation.</p>');
}
 
include_once("memesettings.php"); 
?>