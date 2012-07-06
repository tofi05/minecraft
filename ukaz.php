<?
  /*
  * Tento soubor obsahuje funkci na zobrazeni zdrojoveho
  * kodu. Umozni zobrazit pouze kody z php souboru ve
  * stejne slozce. Nazev zobrazeneho souboru je prevzat
  * z url (bez pripony)
  *
  * Priklad volani: http://[server]/ukaz.php?file=test
  * zobrazi zdrojovy kod skriptu test.php
  */
  function obsahsouboru ($file)
  {
    $soubor=fopen($file, "r"); 
    $obsah=fread($soubor, 50000); 
    fclose ($soubor);
    $obsah=ereg_replace ("(include)[^;]+\;", "// zde je include souboru s konstantami" ,$obsah); 
  
    ob_start();
    highlight_string($obsah);
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
  }

  if ($_GET["file"]=="") die ("Není co zobrazit");
  if (eregi("[\./~]", $file)) die (";-)))");
  if (eregi("ukaz", $file)) die (";-)))");
  if (!is_file($file.".php")) die ("Soubor neexistuje");
  ?>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
<?
  echo obsahsouboru ($file.".php");
?>


