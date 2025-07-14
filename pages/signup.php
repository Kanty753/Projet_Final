<?php
session_start();
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = array();
    $_SESSION['error']['pseudo'] = 0;
    $_SESSION['error']['email'] = 0;
    $_SESSION['error']['pwd'] = 0;
    $_SESSION['error']['cpwd'] = 0;
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
    <div class="countainer card col-12 col-sm-9 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <h1>Sign up</h1>
        <form class="col-10" action="../treatment/signup_treatment.php" method="post">
            <span class="text">Nom</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/person.svg" alt="" srcset="">
                <input type="text" name="pseudo" id="" placeholder="Username" />
            </div>
            <span class="error">
                <?php
                if ($_SESSION['error']['pseudo'] == 1) {
                    echo "Veuillez remplir ce champ";
                }
                ?>
            </span>
            <span class="text">Genre</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/envelope-open.svg" alt="" srcset="">
                <select name="genre" id="genre">
                    <option value="h">HOMME</option>
                    <option value="f">FEMME</option>
                </select>
                <span class="error"></span>
            </div>
            <span class="text">Date de naissance</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/envelope-open.svg" alt="" srcset="">
                <input type="date" name="birth"id="birth">
                <span class="error"></span>
            </div>
            <span class="text">Ville</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/envelope-open.svg" alt="" srcset="">
                <input type="text" name="ville" id="ville" placeholder="Ville" />
                <span class="error"></span>
            </div>
            <span class="text">Email</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/envelope-open.svg" alt="" srcset="">
                <input type="email" name="email" id="email" placeholder="Email" />
                <span class="error"></span>
            </div>
            <span class="error">
                <?php
                if ($_SESSION['error']['email'] == 1) {
                    echo "Veuillez remplir ce champ";
                }
                if ($_SESSION['error']['email'] == 2) { ?>
                    Cet Email a deja un compte <a href="login.php">Se Connecter ? </a>
                <?php }
                ?>
            </span>
            <span class="text">Password</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/lock.svg" alt="" srcset="">
                <input type="password" name="pwd" id="pwd" placeholder="Password" />
                <span class="error"></span>
            </div>
            <span class="error">
                <?php
                if ($_SESSION['error']['pwd'] == 1) {
                    echo "Veuillez remplir ce champ";
                }
                ?>
            </span>
            <span class="text">Confirm Password</span>
            <div class="zone">
                <img src="../assets/css/bootstrap/bootstrap-icons/icons/lock.svg" alt="" srcset="">
                <input type="password" name="cpwd" id="pwd" placeholder="Confirm Password" />
                <span class="error"></span>
            </div>
            <span class="error">
                <?php
                if ($_SESSION['error']['cpwd'] == 1) {
                    echo "Veuillez reconfirmer votre mot de passe ";
                }
                ?>
            </span>
            <p> By signing up, you agree to the Terms of <span class="text">Service</span> and <span
                    class="text">Privacy Policy</span></p>
            <button type="submit" class="col-12 submit_account">Sign Up</button>
            <div class="register col-12">
                <text>Already have an account?</text><br /> <a href="login.php">Log In</a>
                </span>
            </div>
        </form>
    </div>
</body>

</html>