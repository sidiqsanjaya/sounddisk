<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:?id=login");
   exit;
 }
$error ="";
 $on = $_GET['on'];
 $decrpt = openssl_decrypt(base64_decode($on), $_SESSION["cypherMethod"],  $_SESSION["key"], $options=0, $_SESSION["iv"]);

 $sqloutput = mysqli_query($conn, "SELECT `t_music`.`id_music`, `t_music`.*, `d_music`.*
 FROM `t_music` 
     LEFT JOIN `d_music` ON `d_music`.`id_music` = `t_music`.`id_music`
 WHERE `t_music`.`id_music` = '$decrpt'");
while($data = mysqli_fetch_array($sqloutput)){
    $dataid = $data['id_music'];
    $datat  = $data['name'];
    $dataa  = $data['artist'];
    $src    = $data['src'];
    $srcp   = $data['poster'];
}

$sqlcek = mysqli_query($conn,"SELECT `user`.`id_user`, `t_music`.`id_music`
FROM `user` 
	LEFT JOIN `t_music` ON `t_music`.`id_user` = `user`.`id_user`
WHERE `user`.`id_user` = '$iduser' AND `t_music`.`id_music` = '$decrpt'");

if($_POST[destroyIt] == 1){
        $row = mysqli_num_rows($sqlcek);
        if($row == 1){
            unlink("$src");
            unlink("$srcp");
            $sqldelmusic =  mysqli_query($conn,"DELETE FROM `t_music` WHERE `t_music`.`id_music` = '$decrpt'");
            header('refresh: 5; url=/');
        }elseif($row == 0){
            $error = "this data has been deleted / not found";
            header('refresh: 5; url=/');
        }else{
            $error = "not your data, forced move in 5 seconds";
            header('refresh: 5; url=/');
        }
}

?>

<div class="row justify-content-center">
    <div class="card o-hidden border-0 my-5">
        <div class="card-body p-12">
            <div class="col-lg-12">
                <form method="POST" action="?id=destroy&on=<?php echo $on; ?>" enctype="multipart/form-data">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">music id</th>
                            <th scope="col">name</th>
                            <th scope="col">artist</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><?php echo $dataid; ?></td>
                            <td><?php echo $datat; ?></td>
                            <td><?php echo $dataa;?></td>
                            </tr>   
                        </tbody>
                    </table>
                    <div>
                        <button type=submit name="destroyIt" value="1" class="btn btn-danger">Danger</button>
                        <button  onclick="location.href='/'" type="button" class="btn btn-primary">cancel</button>
                    </div>
                    <a><?php echo $error; ?></a>
                </form>
            </div>
        </div>
    </div>
</div>
