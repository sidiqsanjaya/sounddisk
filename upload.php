<?php
  session_start();
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location:?id=login");
    exit;
  }

$err = $extension_poster = $extension_file = "";
//error_reporting(0);
if($_SERVER["REQUEST_METHOD"] == "POST"){            
                //init
                $id_music = substr(md5(time()), 0, 16);
                $folder ='./disk/';
                $rename = $folder.$iduser.'_'.$id_music;
                //get all post file
                $get_tmp_music   = $_FILES['file_music']['tmp_name'];
                $get_name_music  = $_FILES['file_music']['name'];
                $get_error_music = $_FILES['file_music']['error'];
                $get_size_music  = $_FILES['file_music']['size'];
                $get_tmp_poster  = $_FILES['poster']['tmp_name'];
                $get_name_poster = $_FILES['poster']['name'];
                $get_error_poster= $_FILES['poster']['error'];
                $get_size_poster = $_FILES['poster']['size'];

                //get all post text
                $get_post_title = $_POST['title'];
                $get_post_artis = $_POST['nameArtis'];

                //cek extension
                $extension_img = array('png','jpg');
                $ex = explode('.', $get_name_poster);
                $ext = strtolower(end($ex));

                $extension_music = array('mp3');
                $ex2 =explode('.', $get_name_music);
                $ext2=strtolower(end($ex2));

                if(in_array($ext2, $extension_music) == true){
                  if(in_array($ext, $extension_img) == true){
                    move_uploaded_file($get_tmp_music,$rename.'.'.$ext2);
                    move_uploaded_file($get_tmp_poster,$rename.'.'.$ext);

                    //prepare sql
                    $t_music ="INSERT INTO `t_music` (`id_user`, `id_music`, `name`, `artist`) VALUES ('$iduser', '$id_music', '$get_post_title', '$get_post_artis')";
                    $d_music ="INSERT INTO `d_music` (`id_music`, `src`, `size`, `poster`, `sizep`) VALUES ('$id_music', '$rename.$ext2', $get_size_music, '$rename.$ext', $get_size_poster)";
                    $upload=mysqli_query($conn,$t_music);
                    $upload2=mysqli_query($conn,$d_music);
                    if($upload){   
                      if($upload2){
                        $error = "OK";
                        header('refresh: 1; url=/');
                      }else{
                        $delete="DELETE FROM `t_music` WHERE `t_music`.`id_music` = '$id_music'";
                        mysqli_query($conn,$delete);
                        unlink('$rename.$ext2');
                        unlink('$rename.$ext');
                        $error = 'error code : 404';
                      }
                    }else{
                      unlink('$rename.$ext2');
                      unlink('$rename.$ext');
                      $error = 'query failed';
                      
                    }
                  }else{
                    $extension_poster = "Extension accept only png and jpg";
                  }
                }else{
                  $extension_file = "Extension accept only Mp3";
                }
             
}
?>




<div class="row justify-content-center">
        <div class="card o-hidden border-0 my-5">
          <div class="card-body p-12">
        <div class="col-lg-12">
        <font size=6> upload file music</font>
                <form method="POST" action="?id=upload" enctype="multipart/form-data">
                <br>
                <div class="form-group">
                  <label for="fileinput">File Music</label>
                  <input type="file" accept="audio/mp3" class="form-control" name="file_music" id="fileinput" required>
                  <span class="help-block"><?php echo $extension_file; ?></span>
                </div>
                <div class="form-group">
                  <label for="fileinput2">Poster</label>
                  <input type="file" accept="image/png, image/jpg" class="form-control" name="poster" id="fileinput2" required>
                  <span class="help-block"><?php echo $extension_poster; ?></span>
                </div>
                <div class="form-group">
                  <label for="tittle">Name song</label>
                  <input type="text" class="form-control" name="title" id="tittle" required placeholder="Enter name Song">
                </div>
                <div class="form-group">
                  <label for="Artisname">Artis name</label>
                  <input type="text" class="form-control" name="nameArtis" id="Artisname" required placeholder="Enter Name Artis">
                </div>
                <input type=submit class="btn btn-primary" name="simpan" value=Save> 
                <input type=reset class="btn btn-danger" name="reset" value=Reset> 
                <br>  
				        <span class="help-block"><?php echo $error; ?></span>             
              </div>
            </div>
          </div>
</div>
