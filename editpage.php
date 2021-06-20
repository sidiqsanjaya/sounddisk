<?php

error_reporting(0);
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:./landinglogin.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
                include "config.php";
                $NamaLain=$_POST['NamaLain'];
                $Inggris=$_POST['Inggris'];
                $Genre=$_POST['Genre'];
                $Produksi=$_POST['Produksi'];
                $Status=$_POST['Status'];
                $Total=$_POST['Total'];
                $Durasi=$_POST['Durasi'];
                $Rilis=$_POST['Rilis'];
                $Sinopsi=$_POST['Sinopsi'];
                $ukuran480p=$_POST['ukuran480p'];
                $link480pG=$_POST['link480pG'];
                $link480pM=$_POST['link480pM'];
                $ukuran720p=$_POST['ukuran720p'];
                $link720pG=$_POST['link720pG'];
                $link720pM=$_POST['link720pM'];
                $ukuran1080p=$_POST['ukuran1080p'];
                $link1080pG=$_POST['link1080pG'];
                $link1080pM=$_POST['link1080pM'];

                     $sql="UPDATE `anime` SET `NamaLain` = '$NamaLain', `Genre` = '$Genre', `Produksi` = ' $Produksi', `Status` = '$Status', `Total` = '$Total', `Durasi` = '$Durasi', `Rilis` = '$Rilis', `Sinopsis` = '$Sinopsi', `ukuran480p` = '$ukuran480p', `480pG` = '$link480pG', `480pM` = '$link480pM', `ukuran720p` = '$ukuran720p', `720pG` = ' $link720pG', `720pM` = ' $link720pM', `ukuran1080p` = '$ukuran1080p', `1080pG` = '$link1080pG', `1080pM` = '$link1080pG' WHERE `anime`.`Inggris` = '$Inggris' ";
                    $hasil=mysqli_query($conn, $sql);
                    if ($hasil){
                      $error_data = "data sudah ditambah";
                    }else{
                      $error_data = mysqli_error($conn);
                    }                 
                mysqli_close($conn);
                header("location:./landinglogin.php");
                exit;
              }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./logowp/favicon.png">
    <?php
    $meta = mysqli_query($conn, "SELECT *  FROM metaweb WHERE no = 1");  
    while($hasilmeta=mysqli_fetch_array($meta)){ ?> 
    <title><?php echo $hasilmeta['title'];?></title>
    <?php } ?>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/stylesheet.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet"  type="text/css">
  </head>

  <body style=" background-image: url(&quot; ./logowp/wallpaper.jpg&quot;);  background-position: top left;  background-size: 100%;  background-repeat: repeat;">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="./index.php">Batch Anime</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">          
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="landinglogin.php">Sign in</a>
              <a class="dropdown-item" href="admin/Register.php">Register</a>
              <a class="dropdown-item" href="admin/logout.php">Log Out</a>
              <a class="dropdown-item" href="insertdb.php">tambah data</a>
            </div>
          </li>
        </ul>
        <form action="index.php" method="GET" class="form-inline my-2 my-lg-0">
          <input type="text" name="Cari" class="form-control mr-sm-2"  placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <main role="main" class="container" style="">
    <div class="py-4" style="background-image: linear-gradient(rgb(255, 255, 255,0.8), rgba(0, 0, 0, 0.2)); background-position: left top; background-size: 100%; background-repeat: repeat;">
      <?php
        require ("config.php");
        $inggris=$_GET['judul'];
        $data = mysqli_query($conn, "select * from anime where Inggris='$inggris'");
        while($hasil=mysqli_fetch_array($data)){
      ?>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card"> <img class="card-img" src="imgwallpaper/<?php echo $hasil['gambar2']; ?>" alt="Card image" width="720" style="  max-width: 1280px;  max-height: 720px;" >
            </div>
          </div>
        </div>
        <form method="POST" action="editpage.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <p class="lead text-center"><input name=Inggris value=<?php echo $hasil['Inggris'];?> readonly ></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p class=""><?php echo $hasil['Sinopsis'];?></p>
            <p class=""><textarea name=Sinopsis></textarea></p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table table-striped table-dark">
                <thead>
                  <tr>                   
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>English Tittle</td>
                    <td><input name=NamaLain value=<?php echo $hasil['NamaLain'];?>></td>
                  </tr>
                  <tr>
                    <td>Romaji Tittle</td>
                    <td><input name=Inggris value=<?php echo $hasil['Inggris'];?> readonly></td>
                  </tr>
                  <tr>
                    <td>Genre</td>
                    <td><input name=Genre value=<?php echo $hasil['Genre'];?>></td>
                  </tr>
                  <tr>
                    <td>Produksi</td>
                    <td><input name=Produksi value=<?php echo $hasil['Produksi'];?>></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td><input name=Status value=<?php echo $hasil['Status'];?>></td>
                  </tr>
                  <tr>
                    <td>Total Eps</td>
                    <td><input name=Total value=<?php echo $hasil['Total'];?>></td>
                  </tr>
                  <tr>
                    <td>Durasi</td>
                    <td><input name=Durasi value=<?php echo $hasil['Durasi'];?>></td>
                  </tr>
                  <tr>
                    <td>rilis</td>
                    <td><input name=Rilis type=date value=<?php echo $hasil['Rilis'];?>></td>
                  </tr>
                  <tr>
                    <td>ukuran 480p</td>
                    <td><input name=ukuran480p value=<?php echo $hasil['ukuran480p'];?>></td>
                  </tr>
                  <tr>
                    <td>480p Gdrive</td>
                    <td><input name=link480pG value=<?php echo $hasil['480pG'];?>></td>
                  </tr>
                  <tr>
                    <td>480p Mega</td>
                    <td><input name=link480pM value=<?php echo $hasil['480pM'];?>></td>
                  </tr>
                  <tr>
                    <td>ukuran 720p</td>
                    <td><input name=ukuran720p value<?php echo $hasil['ukuran720p'];?>></td>
                  </tr>
                  <tr>
                    <td>720p GDrive</td>
                    <td><input name=link720pG value=<?php echo $hasil['720pG'];?>></td>
                  </tr>
                  <tr>
                    <td>720p Mega</td>
                    <td><input name=link720pM value=<?php echo $hasil['720pM'];?>></td>
                  </tr>
                  <tr>
                    <td>ukuran 1080p</td>
                    <td><input name=ukuran1080p value=<?php echo $hasil['ukuran1080p'];?>></td>
                  </tr>
                  <tr>
                    <td>1080p Gdrive</td>
                    <td><input name=link1080pG value=<?php echo $hasil['1080pG'];?>></td>
                  </tr>
                  <tr>
                    <td>1080p Mega</td>
                    <td><input name=link1080pM value=<?php echo $hasil['1080pM'];?>></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <input type=submit name="simpan" value=Save> 
                <input type=reset name="reset" value=Reset>
                <br> <br>  
                <span class="help-block"><?php echo $error_data; ?></span> 
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <p class="text-primary" >apaan ini anjir</p>
      </div>
      <?php } ?>
    </div>
  </main>
    <footer class="text-muted py-5" >
    <div class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>
      <p>Bootstrap©MITlicense2018.&nbsp; <br>BatchAnime@2020 - sampe hosting mati</p>
    </div>
  </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="./assets/js/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>    
        <script src='//safelinkblogger.com/js/full-page-script.js'></script>
  </body>
</html>