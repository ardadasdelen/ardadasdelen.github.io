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
                        <a class="nav-link active" href="list.php">Dosyalar <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </nav>
            <h3 class="text-muted"><a style="text-decoration: none;" href="index.php">Dosya Yükleme</a></h3>
        </div>
        <div class="jumbotron">
            <h4>Yüklü Olan Dosyalar: </h4>&nbsp;
            <table class="table table-borderless table-striped">
                <tbody>
                    
                        <?php 
		$i=0;
		$hst = $_SERVER['HTTP_HOST'];
		$dir = opendir("uploads"); //Burada Hangi Klasörün içersini listelemek istiyorsak onu seçtik

		while (($dosya = readdir($dir)) !== false) // While Döngüsüne girerek dosyamızı okuyoruz.
		{

		if ($dosya == "ip.php" || $dosya == "download.php" || $dosya == "." || $dosya == "..") {
		}else 
		{
			$i++;
			
			echo "<tr><td style=\"text-align: left;\">$dosya</td><td style=\"text-align: center;\"><a target=\"_blank\" href=\"http://$hst/uploads/$dosya\">Görüntüle</a></td><td style=\"text-align: right;\"><a href=http://$hst/uploads/download.php?file=$dosya><span class=\"badge badge-primary\">&nbsp;Dosyayı İndir&nbsp;</span></a></td></tr>";
		}

		}
		closedir($dir); //İşimiz Bitti

		if($i == 0){
			echo "<div class=\"alert alert-info\" role=\"alert\"><h6>Yüklü Dosya Bulunmamaktadır.</h6></div>";
		}
		?>
                    
                </tbody>
            </table>
        </div>
        <footer class="footer">
            <p>Bahadır Düzcan &copy; Company 2019</p>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>