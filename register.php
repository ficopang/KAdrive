<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require './templates/template.php'; ?>

    <div class="container">
        <form action="./controller/registerController.php" method="POST">
            <img id="logo" src="./assets/logo.png" alt="KAdrive.">
            <h1>Create an account</h1>
            <p>Proceed to KAdrive</p>

            <div class="forms-container">

                <div class="form-component">
                    <input type="text" name="username" id="username" placeholder="Username">
                </div>

                <div class="form-component">
                    <input type="text" name="email" id="email" placeholder="Email">
                </div>

                <div class="form-component pw-field">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <input type="password" name="conf-password" id="conf-password" placeholder="Confirmation">
                </div>

                <!-- 
                    ///////////////////////////////////////

                    Login Page:
                    -> Show Error Message
                
                    ///////////////////////////////////////
                 -->
                <!-- !!CODE START HERE -->

                <?php
                if (isset($_SESSION['error'])) {
                ?>

                <div class="error-msg">
                    <p><?= $_SESSION['error'][0] ?></p>
                </div>

                <?php
                } ?>

                <!-- END HERE -->

            </div>

            <div class="form-buttons">
                <a href="./login.php" class="login-btn">
                    Just Login
                </a>

                <input name="register" type="submit" value="Confirm" class="continue-btn">
            </div>

        </form>

        <img id="acc" src="./assets/account.svg" alt="">
    </div>
</body>

</html>