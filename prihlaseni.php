<?php

$conn = connect();

if (!$conn) {
  echo "Momentalne se nelze prihlasit.</br>";
} else {
  $def = array("login" => '', "heslo" => '');
  if (!empty($_POST["login"]) and !empty($_POST["heslo"])) {
    $def = $_POST;
    $sql = "SELECT id_uzivatele, activ FROM uzivatele WHERE login = ? AND heslo = ?;";
    $params = array($_POST["login"], sha1($_POST["heslo"]));
    $stmt = sqlsrv_query($conn, $sql, $params);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (!empty($row)) {
      if ($row["activ"] == "activ") {
        $_SESSION['id_uzivatele'] = $row["id_uzivatele"];
        echo "Byl jste upesne prihlasen.";
      } else {
        echo "Dosud jste neaktivovali ucet.</br>";
      }
    } else {
      echo "Spatne heslo nebo login.</br>";
    }
  }
  echo '
          <h4>Prihlaseni</h4>
          <form action ="" method ="POST">
            <table>
              <tr>
                <td>
                  Login
                </td><td>
                  <input type ="text" name="login" value="' . $def['login'] . '">
                </td>
              </tr><tr>
                <td>
                  Heslo
                </td><td>
                  <input type ="password" name="heslo" value="' . $def['heslo'] . '">
                </td>
              </tr><tr>
                <td colspan=2>
                  <input type ="submit" name="submit" value ="Prihlasit">
                </td>
              </tr>
            </table>
          </form>';

  sqlsrv_close($conn);
}
?>

