<?php

$serverName = "STROJ"; //serverName\instanceName
$connectionInfo = array("Database" => "minecraft");
$conn = sqlsrv_connect($serverName, $connectionInfo);


$whitelist = "C:/hry/minecraft WF/server 1.2.5.R1.3/white-list.txt";

if (!$conn) {
  echo "Momentalne nelze dokoncit regstraci. Zkuste to prosim pozdeji. </br>";
} else {
  $sql = "UPDATE uzivatele SET activ='activ' WHERE id_uzivatele = ?;";
  $params = array(&$_GET['id_uzivatele']);
  $stmt = sqlsrv_prepare($conn, $sql, $params);
  if (!$stmt) {
    // nepodarilo se pripravit dotaz
    //var_dump(sqlsrv_errors());
  } else {
    if (sqlsrv_execute($stmt) === false) {
      // nepodarilo se spustit dotaz
      //var_dump(sqlsrv_errors());
    } else {

      /**
       *  zapsani do white listu
       */
      $wl = fopen($whitelist, "a");
      fwrite($wl, $def['login'] . "\r\n");
      fclose($wl);
      
      
      echo "Dokonceni registrace probehlo v poradku. Dekujeme za registraci.";
    }
  }
  sqlsrv_close($conn);
}
?>
