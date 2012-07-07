<?php

session_start();

require('func.php');

print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//CS" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head> 
    <title>Minecraft server</title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <meta name="generator" content="PSPad editor, www.pspad.com">
   <LINK REL=StyleSheet HREF="style.css" TYPE="text/css" MEDIA=screen>
 
    </head>
    <body>';

//includujeme menu 
 
require "./navigace.php";

//oddil pro telo stranky

echo "<div id='mainarea'>

	<div id='sidebar'>";

require "./sidemenu.php";

echo"  </div>
   	
	<div id='contentarea'>";

//funkce ktera zobrazuje clanky
ukazclanek();


echo '
	</div>
	  </div>';

echo '<div id="footer"> 	<a href="http://www.templatesold.com/" target="_blank">Website Templates</a> by
 <a href="http://www.free-css-templates.com/" target="_blank">Free CSS Templates</a></div>';
  echo '</div></body></html>';
?>
