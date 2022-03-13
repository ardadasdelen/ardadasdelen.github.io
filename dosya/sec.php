<?php

// $refer = $_SERVER['HTTP_REFERER'];

$URIL = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(!empty($_SERVER['HTTP_REFERER'])) {
echo $refer; 
  $reffer = $_SERVER['HTTP_REFERER'];
}else {
  echo $refer;
    die("INVAILD REQUEST");
  }
$hst = $_SERVER['HTTP_HOST'];
if(!strpos($reffer,$hst) !== false ) {
  die("YOU ARE REQUEST IS INVAILD SEC.P");
}
//if($refer != $_SERVER['HTTP_HOST']) {
// for disallow direcr access!
// die("YOU ARE REQUEST A INVAILD URL");
// }

 ?>