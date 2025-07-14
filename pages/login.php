<?php
session_start(); 


if (!isset($_SESSION['mail_error'])) {
  $_SESSION['mail_error']=0;
}
if (!isset($_SESSION['pwd_error'])) {
  $_SESSION['pwd_error'] = 0 ;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <link rel="stylesheet" href="../assets/css_code/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css_code/login.css" />
  </head>
  <body>
    <div class="countainer card col-12 col-sm-10 col-md-9 col-lg-6 col-xl-5 col-xxl-4">
      <h1>Log in</h1>
      <form class="col-9" action="../treatment/login_treatment.php" method="post">
        <span class="text">Email</span>
        <div class="zone">
          <img src="../assets/css/bootstrap/bootstrap-icons/icons/envelope-open.svg" alt="" srcset="">
          <input type="email" name="email" id="email" placeholder="Email" />
        </div>
        <span class="error">
                    <?php
                        if ($_SESSION['mail_error']==2) {
                            echo "Veuillez remplir ce champ";
                        }
                        if ($_SESSION['mail_error']==1) { ?>
                           Email assigne a aucun compte <a href="signup.php">S'incrire ? </a>
                    <?php }
                    ?>
        </span>
        <span class="text">Password</span>
        <div class="zone">
          <img src="../assets/css/bootstrap/bootstrap-icons/icons/lock.svg" alt="" srcset="">
          <input type="password" name="pwd" id="pwd" placeholder="Password" />
        </div>
        <span class="error">
                    <?php
                        if ($_SESSION['pwd_error']==2) {
                            echo "Veuillez remplir ce champ";
                        }
                        if ($_SESSION['pwd_error']==1) { ?>
                           Mot de passe incorrect
                    <?php }
                    ?>
        </span>
        <button type="submit" class="col-12 submit_account">Log In</button>
        <div class="register col-12">
            <text>Don't have an account?</text><br/><a href="signup.php">Register</a>
          </span>
        </div>
      </form>
    </div>
  </body>
</html>
