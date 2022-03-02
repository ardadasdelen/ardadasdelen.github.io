<?php

 // its for who want to regist download information! include 'ip.php';

$hst = $_SERVER['HTTP_HOST'];

include 'ip.php';
if(!empty($_GET['file'])) {
  $fil = $_GET['file'];
  $file = "http://".$hst."/"."php/uploads/". $fil;
  $filetest = $fil;
//  "/uploads" . "/" .
  if (file_exists($fil)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($fil).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($fil));
    readfile($fil);
  exit;
  } else {
    //  for debug echo $filetest;
    echo "   file not exists!";
  }
} else {
die("INVAILD REQUEST!");
}

?>