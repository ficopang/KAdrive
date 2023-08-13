<!-- 
    ///////////////////////////////////////

    Shared Drive Section:
    -> Automatically add the logged in user's shared folder if they still not have their own folder.

    ///////////////////////////////////////
-->
<!-- !!CODE START HERE -->

<?php
$dir = './all-drives/SHARED/' . $_SESSION['id'];
if (!is_dir($dir)) {
    mkdir($dir);
}
?>

<!-- END HERE -->

<div class="top-buttons">
    <p id="shared-title">SHARED</p>

    <div class="right-btn">
        <input type="button" class="download-btn" value="Download" onclick="downloadButton()">
        <input type="button" class="rename-btn" value="Rename" onclick="showModal(1)">
        <input type="button" class="delete-btn" value="Delete" onclick="showModal(2)">
    </div>
</div>

<div class="drive-container">

    <h4 class="d-title">Folders</h4>
    <div class="folder-container">

        <!-- 
            ///////////////////////////////////////

            Shared Drive Section:
            -> Only show SHARED (Me) folder if the user is on root shared folder (/SHARED/)

            ///////////////////////////////////////
        -->
        <!-- !!CODE START HERE -->

        <?php
        if (strcmp($_GET['dir'], "/SHARED/") == 0) {
        ?>

        <button class="folder">
            <input type="hidden" name="source" value="<?= "/SHARED/" . $_SESSION['id'] ?>">
            <img src="./assets/folder.png" alt="">
            <p class="contents-name">SHARED (Me)</p>
        </button>

        <?php

        } ?>
        <!-- END HERE -->

        <!-- 
            ///////////////////////////////////////

            Shared Drive Section:
            -> Show all folder in the shared directory

            ///////////////////////////////////////
        -->
        <!-- !!CODE START HERE -->

        <?php
        $dir = 'all-drives' . $_GET['dir'];
        if (strcmp($_GET['dir'], "/SHARED/") == 0 && $dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (filetype($dir . $file) == 'dir' && $file != "." && $file != "..") {
        ?>

        <button class="folder">
            <input type="hidden" name="source" value="<?= $_GET['dir'] . $file ?>">
            <img src="./assets/folder.png" alt="">
            <p class="contents-name"><?= $file ?></p>
        </button>


        <?php
                }
            }
            closedir($dh);
        }
        ?>
        <!-- END HERE -->
    </div>

    <h4 class="d-title">File</h4>
    <div class="file-container">

        <!-- 
            ///////////////////////////////////////

            Shared Drive Section:
            -> Show image preview
            -> Show all file in that current directory

            ///////////////////////////////////////
        -->
        <!-- !!CODE START HERE -->
        <?php
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (strcmp($_GET['dir'], "/SHARED/") != 0 && filetype($dir . $file) != 'dir') {
                    $mime = mime_content_type($dir . $file);
                    $imgsrc = './assets/doc.png';
                    $imgprev = './assets/nopreview.png';
                    if (strstr($mime, "video/")) {
                        // this code for video
                        $imgsrc = './assets/video.png';
                    } else if (strstr($mime, "image/")) {
                        // this code for image
                        $imgsrc = './assets/image.png';
                        $imgprev = $dir . $file;
                    } else if (strstr($mime, "/msword") || strstr($mime, "/vnd.openxmlformats-officedocument.wordprocessingml.document")) {
                        // this code for doc
                        $imgsrc = './assets/doc.png';
                    } else if (strstr($mime, "text/")) {
                        // this code for doc
                        $imgsrc = './assets/txt.png';
                    }
        ?>

        <button class="file">
            <input type="hidden" name="source" value="<?= $dir . $file ?>">
            <img src="<?= $imgprev ?>" alt="">
            <div class="file-name-container">
                <img src="<?= $imgsrc ?>" alt="">
                <p class="contents-name"><?= $file ?></p>
            </div>
        </button>

        <?php
                }
            }
            closedir($dh);
        }
        ?>
        <!-- END HERE -->

    </div>

</div>

<script src="./js/sharedDrive.js"></script>