<?php
if(!$logintrue){
  header("location:?id=home");
  exit;
}
$error = $password_err = "";
$sql = mysqli_query($conn, "SELECT * FROM `user` WHERE `id_user` = '$iduser'");
while($tempsave = mysqli_fetch_array($sql)){
  $usernametmp = $tempsave['username'];
  $passtemp = $tempsave['password'];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    }elseif(password_verify($_POST['password'], $passtemp)){
        $password_err = "please insert new password, not same password";
    }else{
        $passnew = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    }

    if(empty($password_err)){
      $updatepass = "UPDATE `user` SET `password` = '$passnew' WHERE `user`.`id_user` = '$iduser' AND `user`.`username` = '$usernametmp'";
      print_r($updatepass);
      if(mysqli_query($conn,$updatepass)){
        $error = "Password change OK <br> redirect in 5 second";
      header('refresh: 5; url=/');
      }else{
        $error = "somethink error, try again later";
      }
       
    }

}
?>


<div class="row justify-content-center">
        <div class="card o-hidden border-0 my-5">
          <div class="card-body p-0">
        <div class="col-lg-12">
        <h5>disini untuk ganti password</h5>
        <form action="?id=change" method="POST">
            <div class="form-group">
                <label>username</label>
                <input readonly type="text" name="username" class="form-control" placeholder="Enter username" value="<?php echo $usernametmp; ?>">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" >
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="mt-4">
                <div class="row">
                  <div class="col-12">
                  <span class="help-block"><?php echo $error; ?></span>
                    <button type="submit" class="btn btn-outline-primary btn-block btn-lg">change password</button>
                  </div>
                </div>
              </div>
         </form>
        </div>
      </div>
    </div>