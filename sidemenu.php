<?php

if (empty($_GET["clanek"])){
$_GET["clanek"]="_uvod";
}
if ($_GET["clanek"]=="prihlaseni")
{ if (isset($_POST["prezdivka"])){
  $id = iduzivatele($_POST["prezdivka"], $_POST["heslo"]);
  if ($id<>0) {
  $_SESSION["id_uzivatele"]=$id;
  }
  }
}
elseif ($_GET["clanek"]=="odhlaseni")
{ 
  unset($_SESSION["id_uzivatele"]);

}


if (isset($_SESSION["id_uzivatele"])) {
echo '<p><a href="index.php?clanek=odhlaseni">Odhlásit</a></p>';
echo 'prihlasen  ID: '.$_SESSION["id_uzivatele"];
} else {
echo '<p><a href="index.php?clanek=prihlaseni">Přihlásit</a></p>
<a href="index.php?clanek=registrace">registrace</a>';
}

?>
