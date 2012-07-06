<?php
 $serverName = "STROJ"; //serverName\instanceName
$connectionInfo = array("Database" => "minecraft");
//$conn = sqlsrv_connect($serverName, $connectionInfo);

function iduzivatele ($prezdivka, $heslo)
{
/*$sql="select id_uzivatele from uzivatele where activ='activ' and login='".$prezdivka."' and heslo='".sha1($heslo)."'";
$params = array($prezdivka,$heslo);

 $vysledek=sqlsrv_query($conn, $dotaz);
  if (mysql_num_rows($vysledek)==0) 
      return false; 
  else {
    $radek = mssql_fetch_array($vysledek);
    return $radek["id_uzivatele"];
  }*/
  if ($prezdivka=="aaa"){
  $radek="1";
  }else {
  $radek="0";
   }
  
  return $radek;
}

//funkce pro vypsani clanku (souboru)
function ukazclanek ()
{ 
# ak neexistuje '?clanek='
  if(!isset($_REQUEST["clanek"]))
  {
    # tak ho nastav na 'prazdny_znak'
    $_REQUEST['clanek']="";
  }
  
   if ((string)$_REQUEST["clanek"]<>'') $mujclanek=$_REQUEST["clanek"]; else $mujclanek="_uvod";
     if (is_file("./".$mujclanek.".htm")):
       $nazevclanku=$mujclanek.".htm";
       require $nazevclanku;
     elseif (is_file("./".$mujclanek.".php")):
       $nazevclanku=$mujclanek.".php";
       require $nazevclanku;
     else:
       $nazevclanku=$mujclanek.".htm";
       require "notfound.php";
   endif;
 
}




?>

