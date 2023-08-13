<!-- 
    ///////////////////////////////////////

    Index Page:
    -> Validate that only logged in user can enter this page

    ///////////////////////////////////////
-->
<!-- !!CODE START HERE -->

<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['id'])) {
    header('location: login.php');
} else if (!isset($_GET['page'])) {
    header('location: index.php?page=myDrive&dir=/' . $_SESSION['id'] . '/');
}
?>

<!-- END HERE -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Drive - KAdrive</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/drives.css">
    <link rel="stylesheet" href="./css/modals.css">
</head>

<body>
    <?php require('./modals.php'); ?>

    <!-- 
        ///////////////////////////////////////

        Index Page:
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

    <?php require './templates/header.php'; ?>


    <div class="content-container">
        <div class="left-c">
            <!-- YOU CAN CHANGE THIS !!CODE:
                                                                    V change this number to current logged in user's id using php-->
            <a class="left-btn" href="./index.php?page=myDrive&dir=/<?= $_SESSION['id'] ?>/">
                My Drive
            </a>
            <a class="left-btn" href="./index.php?page=sharedDrive&dir=/SHARED/">
                Shared
            </a>
        </div>

        <div class="right-c" ondrop="uploadFile(event)" ondragover="allowDrop(event)" ondragenter="allowDrop(event)"
            ondragleave="allowDrop(event)">
            <!-- YOU CAN CHANGE THIS !!CODE:
                                                    V change this to current directory (obtained from url) -->
            <p class="curr-dir">Current directory: <?= $_GET['dir'] ?></p>
            <?php
            $page = $_GET['page'] . ".php";
            include "./" . $page;
            ?>
        </div>
    </div>

    <script src="./js/index.js"></script>
    <script src="./js/dropZone.js"></script>
</body>

</html>