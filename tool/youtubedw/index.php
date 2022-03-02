<?php

include "GetVideoInfo.php";

$isvalid="";
$isVideoIdValid="";

if (isset($_POST['submit'])){
    $video_link = $_POST['video_url'];
    if($video_link != ""){
        $isVideoIdValid = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_link, $match);
        if($isVideoIdValid=="1"){
          $video_id =  $match[1];

          // getting video information
          $video = json_decode(GetVideoInfo($video_id));
          $isvalid = $video->playabilityStatus->status;
          
          @$formats = $video->streamingData->formats;
          @$thumbnails = $video->videoDetails->thumbnail->thumbnails;
          @$title = $video->videoDetails->title;
          @$short_description = $video->videoDetails->shortDescription;
          @$channel_id = $video->videoDetails->channelId;
          @$channel_name = $video->videoDetails->author;
          @$views = $video->videoDetails->viewCount;
          @$video_duration_in_seconds = $video->videoDetails->lengthSeconds;
          @$thumbnail = end($thumbnails)->url; 
          
          // seconds to minutes&hours
          $hours = floor($video_duration_in_seconds / 3600);
          $minutes = floor(($video_duration_in_seconds / 60) % 60);
          $seconds = $video_duration_in_seconds % 60;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Youtube Video İndirici</title>
</head>
<body class="bg-primary">
  <div class="container">
        <div class="row">
           
                <div class="text mt-5">
                    <h2 class="text-center">Youtube Video İndirici</h2>
                <p class="text-center">Aşağıya dilediğiniz videonun linkini girerek videoları mp4 olarak ve istediğiniz kalitede indirebilirsiniz.</p>
                </div>
      
        </div>
        <div class="row">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="video_url" placeholder="https://www.youtube.com/watch?v=dc9Q-AciafI" autocomplete="off">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-warning mt-3">İNDİR</button>
                        </div>
                    
                        </form>

                </div>
            </div>
            <?php
     if($isVideoIdValid=="0"){ ?>
         <label><i class='bx bx-unlink'></i></label>
         <h3>Yanlış Url!</h3>
          <p>Girdiğiniz linki kontrol edin.</p>
     <?php }else if($isvalid==""){ ?>
      <p class="text-center mt-5">Ozgur_Medya 2022</p>

    <?php }else if($isvalid=="OK"){ ?>

    
          <div class="text-center">
          <img src="<?php echo $thumbnail; ?>" alt="thumbnail">
          </div>
    
      <div class="text-center">
      <b>Kapak Resmini İndir: </b><a href="download_img.php?url=<?php echo $thumbnail; ?>&name=<?php echo $title; ?>" id="img_download_btn"><button class="btn btn-secondary mt-3" ><i class='bx bxs-download'></i></button></a>


<?php if(!empty($formats)){
  
  if(@$formats[0]->url == ""){ ?>

    <label><i class='bx bx-video-off'></i></label>
    <h3>Desteklenmiyor.</h3>
    <p>Bu video şu anda desteklenmiyor.</p>

  <?php }else{ ?>
         
        
             <p class="text-center"><b>Video Adı:</b> <?php echo $title; ?></p>
             <p class="text-center"><b>Kanal Adı:</b> <a href="<?php echo 'https://www.youtube.com/channel/'.$channel_id ?>"><?php echo $channel_name ?></a></p>
             <p class="text-center"><b>Video Süresi:</b> <?php echo "$hours:$minutes:$seconds"; ?></p>
             <p class="text-center"><b>Video İzlenmesi:</b> <?php echo $views; ?></p>
         
             
             <table class="table text-center">
  <thead>
    <tr>
      <th scope="col">Çözünürlük</th>
      <th scope="col">Format</th>
      <th scope="col">İndir</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach($formats as $format){
                    
                    // getting all available video formats
                    if(@$format->url == ""){
                      $signature = "https://youtube.com?".$format->signatureCipher;
                      parse_str( parse_url( $signature, PHP_URL_QUERY ), $parse_signature );
                      $url = $parse_signature['url']."&sig=".$parse_signature['s'];
                    }else{
                      $url = $format->url;
                    }        
                    ?>

    <tr>
      <td><?php if($format->qualityLabel) echo $format->qualityLabel; else echo "Unknown"; ?></td>
      <td><?php if($format->mimeType) echo explode(";",explode("/",$format->mimeType)[1])[0]; else echo "Unknown";?></td>
      <td><a href="download_video.php?link=<?php echo urlencode($url)?>&title=<?php echo urlencode($title)?>&type=<?php if($format->mimeType) echo explode(";",explode("/",$format->mimeType)[1])[0]; else echo "mp4";?>" id="download_btn"><i class='bx bxs-download'></i>&nbsp;Download</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


             <table>              
         </div>
     </div>

<?php } } }else{ ?>

       <label><i class='bx bx-video-off'></i></label>
       <h3>Video bilgisini alamıyoruz...</h3>
       <p>Girdiğiniz linki kontrol edebilirsiniz, bizde yanlış olmaz.</p>

  <?php } ?>

 </div>

 </div>
        </div>
    </div>

     


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
