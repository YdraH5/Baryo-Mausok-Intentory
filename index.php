<br><br><br><br>
<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn()) { redirect('admin.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<style>
body {
  background-image: url('./libs/images/malupitnausok.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}


</style>
<div class="login-page">  
    <div class="text-center">
    <img src="./libs/images/baryomausok(2).png" style="height:250px;">
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group"style="">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username"style="border-radius:30px">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="Password"style="border-radius:30px;">
        </div>
        <br>
        <div class="btn">
                <button type="submit" class="btn btn-danger" >LOGIN</button>
        </div>
        <br>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>