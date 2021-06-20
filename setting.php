<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location:?id=login");
 exit;
}

$sqltable = mysqli_query($conn, "SELECT `t_music`.`name`, `t_music`.`artist`, `d_music`.`src`, `d_music`.`poster`, `t_music`.`id_user` FROM `t_music` LEFT JOIN `d_music` ON `d_music`.`id_music` = `t_music`.`id_music` WHERE `t_music`.`id_user` = '$iduser'");

$sqladmin = mysqli_query($conn, "SELECT `level` FROM user WHERE id_user = '$iduser'");
while($a = mysqli_fetch_array($sqladmin)){
  $admin = $a['level'];
}

$sqllistuser = mysqli_query($conn, "SELECT * FROM `user` WHERE `username` != 'admin'");


if($admin == 'master'){
?>
<div class="jumbotron">
<h5>Welcome Back Master</h5>
<h6>user access only for master level</h6>
<br>
<h5>List User</h5>
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">id user</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      <th scope="col">crate at</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($listuser = mysqli_fetch_array($sqllistuser)){
    $non = $non + 1; 
    $userref= base64_encode(openssl_encrypt($listuser['id_user'], $_SESSION["cypherMethod"], $_SESSION["key"], $options=0, $_SESSION["iv"]));
  ?>
    <tr>
      <th scope="row"><?php echo $non; ?></th>
      <td><?php echo $listuser['id_user']; ?></td>
      <td><?php echo $listuser['username']; ?></td>
      <td><?php echo $listuser['password']; ?></td>
      <td><?php echo $listuser['create_at']; ?></td>
      <td><button onclick="location.href='?id=edituser&on=<?php echo $userref;?>'" type="button" class="btn btn-primary">change password</button> <button onclick="location.href='?id=destroyuser&on=<?php echo $userref;?>'"  type="button" class="btn btn-primary">Delete user</button></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?php } ?>

<HR>
<div class="jumbotron">
<h5>in here you can edit your song, or delete</h5>
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">poster</th>
      <th scope="col">audio</th>
      <th scope="col">name</th>
      <th scope="col">artist</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  
  while($listaudio = mysqli_fetch_array($sqltable)){
    $no = $no + 1; 
    $ref= base64_encode(openssl_encrypt($listaudio['id_music'], $_SESSION["cypherMethod"], $_SESSION["key"], $options=0, $_SESSION["iv"]));
  ?>  
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><img src="<?php echo $listaudio['poster']; ?>" alt="img" class="rounded img-thumbnail" width="200" height="300"></td>
      <td><button class="btn btn-success" onclick="proses(this)" value="<?php echo $listaudio['src']; ?>">play</button></td>
      <td><?php echo $listaudio['name']; ?></td>
      <td><?php echo $listaudio['artist']; ?></td>
      <td><button onclick="location.href='?id=edit&on=<?php echo $ref;?>'" type="button" class="btn btn-primary">Edit</button> <button onclick="location.href='?id=destroy&on=<?php echo $ref;?>'"  type="button" class="btn btn-primary">Delete</button></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>
<script>
function click(elem){
  $("button").click(function () {
    var playmusic = this.value;
    var audio = new Audio(playmusic);
    audio.play();
  }}
</script>
