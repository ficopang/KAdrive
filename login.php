<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAdrive.: Login</title>

    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php require './templates/template.php'; ?>

    <div class="container">

        <form action="./controller/loginController.php" method="POST">
            <img id="logo" src="./assets/logo.png" alt="KAdrive.">
            <h1>Login</h1>
            <p>Proceed with KAdrive</p>

            <div class="form-components">
                <input class="form" type="email" name="email" placeholder="Email">
                <input class="form" type="password" name="password" id="password" placeholder="Password">


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
                <a href="./register.php" class="regist-btn">
                    Create account
                </a>

                <input name="login" type="submit" value="Continue" class="continue-btn">
            </div>
        </form>

    </div>
</body>

</html>