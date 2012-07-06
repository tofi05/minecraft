<?php

$def = array('login' => '', 'jmeno' => '', 'prijmeni' => '', 'heslo' => '', 'email' => '');
$whitelist = "C:/hry/minecraft WF/server 1.2.5.R1.3/white-list.txt";

$serverName = "STROJ"; //serverName\instanceName
$connectionInfo = array("Database" => "minecraft");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if (!$conn) {
  echo "Registrace monentalne nefunguje, zkuste to pozdeji.<br />";
  //var_dump(sqlsrv_errors());
} else {
  if (!empty($_POST)) {
    $def = $_POST;
    if (!empty($def['jmeno']) and !empty($def['prijmeni']) and !empty($def['email']) and !empty($def['login']) and !empty($def['heslo'])) {
      // uzivatel vypnil vsechny policka
      $sql = "SELECT * FROM uzivatele WHERE login = ?;";
      $params = array(&$def['login']);
      $stmt = sqlsrv_prepare($conn, $sql, $params);
      if (!$stmt) {
        // nepodarilo se pripravit dotaz
        //var_dump(sqlsrv_errors());
      } else {
        if (sqlsrv_execute($stmt) === false) {
          // nepodarilo se spustit dotaz
          //var_dump(sqlsrv_errors());
        }
      }
      if (!sqlsrv_has_rows($stmt)) { // login je jedinecny          
        /**
         *  zapsani do white listu
         */
        $wl = fopen($whitelist, "a");
        fwrite($wl, $def['login'] . "\r\n");
        fclose($wl);

        /**
         *  ulozeni do DB
         */
        $sql = "INSERT INTO uzivatele (login, jmeno, prijmeni, heslo, email) 
          VALUES (?, ?, ?, ?, ?);";
        $params = array(&$def['login'], &$def['jmeno'], &$def['prijmeni'], &$def['heslo'], &$def['email']);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (!$stmt) {
          // nepodarilo se pripravit dotaz
          //var_dump(sqlsrv_errors());
        } else {
          if (sqlsrv_execute($stmt) === false) {
            // nepodarilo se spustit dotaz
            //var_dump(sqlsrv_errors());
          } else {
            echo "Uzivatel je registrovan. Pro dokonceni registrace potvrde registraci v emailove schrance.</br>";
          }
        }

        /**
         *  odeslani mailu
         */
        $sql = "SELECT * FROM uzivatele WHERE login = ?";
        $params = array($def['login']);
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) {
          // spatne sql
          var_dump(sqlsrv_errors());
        }
        $id = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $msg = "Pro dokonceni registrace kliknente na nasledujici odkaz:
          <a href='http://5.43.228.27/minecraft/index.php?clanek=potvrzeni&id_uzivatele=" . $id['id_uzivatele'] . "'>potvrdit registraci</a>";

        include("../PHPMailer_v2.0.4/class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username = "minecraftsrvbukkit@gmail.com";  // GMAIL username
        $mail->Password = "1234mnbv";            // GMAIL password
        $mail->AddReplyTo("minecraftsrvbukkit@gmail.com", "Minecraft");
        $mail->From = "minecraftsrvbukkit@gmail.com";
        $mail->FromName = "Minecraft";
        $mail->Subject = "MINECRAFT registrace noveho hrace";
        $mail->MsgHTML($msg);
        $mail->AddAddress($def['email']);
        $mail->IsHTML(true); // send as HTML
        if (!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Byl vam zaslan mail pro dokonceni registrace</br>";
        }
      } else {
        echo "Uzivatel s timhle loginem jiz existuje</br>";
      }
    } else {
      echo "vse musi byt vyplneno</br>";
    }
  }
  sqlsrv_close($conn);
}
echo '
<h4>Registrace</h4>

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
        Jmeno
      </td><td>
        <input type ="text" name="jmeno" value="' . $def['jmeno'] . '">
      </td>
    </tr><tr>
      <td>
        Prijmeni
      </td><td>
        <input type ="text" name="prijmeni" value="' . $def['prijmeni'] . '">
      </td>
    </tr><tr>
      <td>
        Heslo
      </td><td>
        <input type ="password" name="heslo" value="' . $def['heslo'] . '">
      </td>
    </tr><tr>
      <td>
        Email
      </td><td>
        <input type ="text" name="email" value="' . $def['email'] . '">
      </td>
    </tr><tr>
      <td colspan=2>
        <input type ="submit" name="submit" value ="registruj">
      </td>
    </tr>
  </table>
</form>';
?>
