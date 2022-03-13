<!DOCTYPE html>
<html><head><SCRIPT language="JavaScript">
<!--
var password;
var pass1="y";
password=prompt('Şifre ile korunmaktadır 🔒','');
if (password==pass1){alert('Şifre doğru ✔️');}
else{window.location="";}
//--></SCRIPT><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><meta name="description" content="Dosyalarım"><meta name="author" content="Arda Daşdelen"><title>Dosyalarım Beta</title><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/narrow-jumbotron.css" rel="stylesheet"></head><body>
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
		$dir = opendir("uploads"); 

		while (($dosya = readdir($dir)) !== false)
		{

		if ($dosya == "ip.php" || $dosya == "download.php" || $dosya == "." || $dosya == "..") {
		}else 
		{
			$i++;
			
			echo "<tr><td style=\"text-align: left;\">$dosya</td><td style=\"text-align: center;\"><a target=\"_blank\" href=\"http://$hst/dosya/uploads/$dosya\">Görüntüle</a></td><td style=\"text-align: right;\"><a href=http://$hst/dosya/uploads/$dosya><span class=\"badge badge-primary\">&nbsp;Dosyayı İndir&nbsp;</span></a></td></tr>";
		}

		}
		closedir($dir);

		if($i == 0){
			echo "<div class=\"alert alert-info\" role=\"alert\"><h6>Yüklü Dosya Bulunmamaktadır.</h6></div>";
		}
		?>
                    
                </tbody>
            </table>
        </div>
        <footer class="footer">
            <p>Arda Daşdelen &copy; Company 2022</p>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>