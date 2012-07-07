<?php
$vybrane=array("nick"=>" ", "pwd"=> " ");
$budemezobrazovat=true;
if (!empty($_POST)) { // už se odeslalo
 $vybrane["nick"]=$_POST["prezdivka"];
echo "zapisuji ".$_POST["prezdivka"]."   ";

  if (!isset($_SESSION["id_uzivatele"])) {
    echo "Uživatelské jméno anebo heslo nesouhlasí";
  
    }
  else {  
    echo "Přihlášen ".$_POST["prezdivka"];
    $budemezobrazovat=false;
  } } else{
   
    }
if ($budemezobrazovat=='true'){
  echo "
<form method='post' action='index.php?clanek=prihlaseni'>
	<table>
		<tr>
			<td>Prezdivka:</td>
			<td><input type='text' name='prezdivka' value='".$vybrane["nick"]."' /></td>
		</tr><tr>
			<td>Heslo:</td>
			<td><input type='password' name='heslo' /></td>
		</tr><tr>
			<td colspan='2'><input type='submit'
			 name='odesli' value='Prihlasit' /></td>
		</tr>
	</table>
</form>";
 }

?>

