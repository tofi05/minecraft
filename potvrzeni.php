<?php

$serverName = "STROJ"; //serverName\instanceName
$connectionInfo = array("Database" => "minecraft");
$conn = sqlsrv_connect($serverName, $connectionInfo);

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
    }else{
      echo "Dokonceni registrace probehlo v poradku. Dekujeme za registraci.";
    }
  }
  sqlsrv_close($conn);
}
?>
