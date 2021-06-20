<?php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:?id=login");
   exit;
}
$on = openssl_decrypt(base64_decode($_GET['on']), $_SESSION["cypherMethod"],  $_SESSION["key"], $options=0, $_SESSION["iv"]);
echo $on;
$sql = mysqli_query($conn, "SELECT * FROM `user` WHERE `id_user` = '$on'");
while($tempsave = mysqli_fetch_array($sql)){
  $usernametmp = $tempsave['username'];
}

$deletesql = "DELETE FROM `user` WHERE `user`.`id_user` = '$on' AND `user`.`username` = '$usernametmp'";
echo $deletesql;
$deletesql2 = mysqli_query($conn,$deletesql);
if(!$delete2){
    echo "<script> window.history.back(); </script>";
}else{
    echo "<script> alert('error, going back'); </script>";
    echo "<script> window.history.back(); </script>";
}
?>