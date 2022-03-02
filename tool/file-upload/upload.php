<?php 
	include 'ip.php';
	include 'sec.php';
	setcookie("use", "used", 172800, "/" , $hst);
	session_start();

	if($_SESSION['use'] == "used") {
	$_SESSION['use'] = "unused";
	echo "<body onload=window.location='index.php'>";
	die();
	}
	$dir = "uploads";
	if(is_dir($dir)) {
		} else {
	  mkdir($dir);
	}
	try {
	  chmod($dir, 0777);
	} catch (Exception $e) {
	  die("cant chmod Direcotry");
	}
	$fileName = basename($_FILES["fileToUpload"]["name"]);
	$fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName);
	$fileNameNoExtension2 = str_replace(" ", "_", $fileNameNoExtension);
	$target_file = $dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	function generateRandomString($length = 10) {
	  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	  $charactersLength = strlen($characters);
	  $randomString = '';
	  for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	  }
		  return $randomString;
		}
		generateRandomString();
		$ran = generateRandomString();
		try {
		  $ran = $fileNameNoExtension2 ."_(". $ran .").". $FileType;
		  $dwnran = $ran;
		  $ran = $dir."/".$ran;
		} catch (Exception $e) {
		  die();
		}
		}
 ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dosya Yükleme Scripti</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/narrow-jumbotron.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills float-right">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Ana Sayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list.php">Dosyalar</a>
                        </li>
                    </ul>
                </nav>
                <h3 class="text-muted"><a style="text-decoration: none;" href="index.php">Dosya Yükleme</a></h3>
            </div>
            <div class="jumbotron">
                <?php 

		if (file_exists($target_file)) {
			echo "<div class=\"alert alert-danger\" role=\"alert\"><h6>Dosya Zaten Mevcut!</h6></div>";
			$uploadOk = 0;
		}

		if ($_FILES["fileToUpload"]["size"] > 10737418240) {
			echo "<div class=\"alert alert-danger\" role=\"alert\"><h6>Dosya Boyutu Çok Büyük!</h6></div>";
			$uploadOk = 0;
		}

		if($FileType == "") {
			echo "<div class=\"alert alert-danger\" role=\"alert\"><h6>Dosya Türü Desteklenmiyor!</h6></div>";
		  $uploadok = 0;
		}else {

			if ($uploadOk == 0) {
				echo "<div class=\"alert alert-danger\" role=\"alert\"><h6>Dosya Yüklenemedi!</h6></div>";
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$ran)) {
				  $hst = $_SERVER['HTTP_HOST'];
				  $flname = $_FILES["fileToUpload"]["name"];
				  $prot = $_SERVER['SERVER_PROTOCOL'];
				  $imurl = "https://$hst/$ran";
				  $_SESSION['use'] = "used";
				  echo "<h4>\"$dwnran\" İçin İndirme linki :</h4>&nbsp;";
				  echo "<br/>";
				  echo "<a href=\"http://$hst/$dir/download.php?file=$dwnran\"><input type=\"submit\" class=\"btn btn-outline-primary\" value=\"İndir\"></a>";
				} else {
					echo "<div class=\"alert alert-danger\" role=\"alert\"><h6>Dosya Yüklenirken Bir Hata İle Karşılaşıldı!</h6></div>";
				}
			}
		}
 ?>
            </div>
            <footer class="footer">
                <p>Bahadır Düzcan &copy; Company 2019</p>
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>

    </html>