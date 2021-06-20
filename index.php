<?php 
session_start();
require ("config.php");
error_reporting(0);
$iduser = $_SESSION['iduser'];

$id = $_GET['id'];
      switch ($id){
        case 'home':
          $header = "SoundDisk";
          break;
        case 'upload':
          $header = "Upload | SoundDisk";
          break;
        case 'login':
          $header = "Login | SoundDisk";
          break;
        case 'logout':
          $header = "Logout | SoundDisk";
          break;
        case 'register':
          $header = "Register | SoundDisk";
          break;
        case 'user':
          $header = "account | SoundDisk";
          break;  
        case 'edit':
          $header = "Edit | SoundDisk";
          break;
        case 'destroy':
          $header = "Logout | SoundDisk";
          break;
        case 'change':
          $header = "change password | SoundDisk";
          break;
        case 'edit user':
          $header = "user edit | SoundDisk";
          break;   
        default:
          $header = "SoundDisk";
          break;
        }

?>    
<html lang="en">
  <head>   
    <meta charset="utf-8">
    <link rel="icon" href="./logowp/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="<?php echo $hasilmeta['author'];?>">  
    <meta name="description" content="<?php echo $hasilmeta['deskripsi'];?>">    
    <title><?php echo $header; ?></title>
    
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/stylesheet.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet"  type="text/css">
  </head>

  <body style=" background-image: url(&quot;logowp/wallpaper.jpg&quot;);  background-position: top left;  background-size: 100%;  background-repeat: no-repeat;  background-size: cover;" class="">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="/">SoundDisk</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        <?php if(!$logintrue){ ?>
        <li class="nav-item">
          <a class="nav-link" id="signin" href="?id=login">Sign in</a> 
        </li> 
        <?php }else{ ?>
          <li class="nav-item">
          <a class="nav-link" id="account"href="?id=change">change password</a> 
        </li> 
        <li class="nav-item">
          <a class="nav-link" id="add"href="?id=upload">upload</a> 
        </li> 
        <li class="nav-item">
          <a class="nav-link" id="list" href="?id=user">your song list</a> 
        </li> 
        <li class="nav-item">
          <a class="nav-link" id="signout"href="?id=logout">Log Out</a> 
        </li> 
        <?php } ?>   
        </ul>
        <form action="/" method="get" class="form-inline my-2 my-lg-0">
          <input type="text" name="search" class="form-control mr-sm-2"  placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <main role="main" class="container" >
       <div class="py-4" style="background-position: center top; background-size: 100%; background-repeat: repeat;">
    <div class="container">
    <!--disini gan -->

    <?php


      switch ($id){
        case 'home':
          include "welcome.php";
          break;
        case 'upload':
          include "upload.php";
          break;
        case 'login':
          include "login.php";
          break;
        case 'logout':
          include "logout.php";
          break;
        case 'register':
          include "register.php";
          break;
        case 'user':
          include "setting.php";
          break;  
        case 'edit':
          include "rubah.php";
          break;
        case 'destroy':
          include "destroy.php";
          break;
        case 'change':
          include "change.php";
          break;
        case 'edituser':
          include "edituser.php";
          break;
        case 'destroyuser':
          include "destroyuser.php";
          break;
        default:
          include "welcome.php";
          break;
        }
    ?>
    <!--stop disini gan -->
    </main>
  <nav class="navbar fixed-bottom bg-dark">
    <div class="container-fluid">
        <div class="mx-auto order-0">               
                <p class="text-primary" >SoundDisk web &copy; 2021 SIDDIQ SANJAYA BAKTI</p>
                <div id="app"></div>            
          </div>
        </div>
  </nav>
</body>

<script id ="cp" src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
function proses(elem){
  $("button").click(function () {
        //no reason to create a jQuery object just use this.value
        var id = this.value;
  $.post("loadlist.php",
  {
    id
  },
  function(data,status){
    document.getElementById("txtHint").innerHTML = data;
  });
  });
}
</script>
<script id="txtHint"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>