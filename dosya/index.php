<?php

session_start();

if($_SESSION['use'] == "used") {
  $_SESSION['use'] = "unused";
}

 ?>
    <!DOCTYPE html>
    <html>

    <head>

        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dosyalarım Beta</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/narrow-jumbotron.css" rel="stylesheet">
        
        <marquee>Siteyi kullanmayın, aksi halde IP banı yersiniz.</marquee>
        
    </head>

    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills float-right">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Ana Sayfa <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="list.php">Dosyalar</a>
                        </li>
                    </ul>
                </nav>
                <h3 class="text-muted"><a style="text-decoration: none;" href="index.php">Dosya Yükleme</a></h3>
            </div>
            <div class="jumbotron"> &nbsp;
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <h4>Yüklemek istediğiniz dosyayı seçin:</h4>&nbsp;
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br/>
                    <br/>
                    <input type="submit" class="btn btn-outline-primary" value="Yükle" name="submit">
                </form>&nbsp;
                <p>Yükle tuşuna bastıktan sonra bekleyiniz.</p>
            </div>
            <footer class="footer">
                <p>Arda Daşdelen &copy; Company 2022</p>
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>

    </html>