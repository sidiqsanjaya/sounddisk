<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
     header("location:?id=login");
    exit;
  }
$error ="";
  $on = $_GET['on'];
  $decrpt = openssl_decrypt(base64_decode($on), $_SESSION["cypherMethod"],  $_SESSION["key"], $options=0, $_SESSION["iv"]);

  $sqledit = mysqli_query($conn, "SELECT `user`.`id_user`, `t_music`.`id_music`, `t_music`.`name`, `t_music`.`artist`
  FROM `user` 
    LEFT JOIN `t_music` ON `t_music`.`id_user` = `user`.`id_user`
  WHERE `user`.`id_user` = '$iduser' AND `t_music`.`id_music` = '$decrpt'");

if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    while($edit = mysqli_fetch_array($sqledit)){
        $idmusic = $edit['id_music'];
        $title = $edit['name'];
        $nameA = $edit['artist'];
    }
    $get_post_title = $_POST['title'];
    $get_post_artis = $_POST['nameArtis'];

    if(empty(trim($get_post_title))){ 
        }else{
        if($title !== $get_post_title){
            $sqlnama = "UPDATE `t_music` SET `name` = '$get_post_title' WHERE `t_music`.`id_music` = '$idmusic'";
            $updatenama = mysqli_query($conn, $sqlnama);
        }else{
          $error= "the name to be replaced write in the space provided";
        }
    }
    if(empty(trim($get_post_artis))){
        }else{   
        if($nameA !== $get_post_artis){
            $sqlartist = "UPDATE `t_music` SET `artist` = '$get_post_artis' WHERE `t_music`.`id_music` = '$idmusic'";
            $updateartist = mysqli_query($conn, $sqlartist);
        }else{
            $error = "the name of the artist to be replaced write in the space provided";
        }
    }
    header('refresh: 5; url=/');
}
while($edit = mysqli_fetch_array($sqledit)){
?>  
    
    <div class="row justify-content-center">
        <div class="card o-hidden border-0 my-5">
          <div class="card-body p-12">
        <div class="col-lg-12">
        <font size=6> upload file music</font>
                <form method="POST" action="?id=edit&on=<?php echo $on; ?>" enctype="multipart/form-data">
                <br>
                <div class="form-group">
                  <label for="tittle">Name song</label>
                  <input type="text" class="form-control" name="title" id="tittle" value="<?php echo $edit['name']; ?>" required placeholder="Enter name Song">
                </div>
                <div class="form-group">
                  <label for="Artisname">Artis name</label>
                  <input type="text" class="form-control" name="nameArtis" id="Artisname" value="<?php echo $edit['artist']; ?>" required placeholder="Enter Name Artis">
                </div>
                <input type=submit class="btn btn-primary" name="simpan" value=Save> 
                <input type=reset class="btn btn-danger" name="reset" value=Reset> 
                <br>  
				    </form>
                    <span class="help-block"><?php echo $error; ?></span>             
              </div>
            </div>
          </div>
</div>
  <?php } ?>