<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-folder'])) {
    /**
     * ///////////////////////////////////////
     * 
     * File Folder Controller:
     * -> Validate input
     * -> Make sure the name not used
     * -> Add the folder to the desired directory
     * -> If success, redirect to the previous page
     * -> If not, redirect to the previous page and show error message
     * 
     * ///////////////////////////////////////
     */

    //  !!CODE START HERE
    $folderName = $_POST['folderName'];
    $id = $_POST['id'];
    $username = $_POST['username'];
    $dir = '../all-drives' . $_POST['dir'];


    $errorMsg = array();
    if (strlen($folderName) > 15) {
        array_push($errorMsg, "folder’s name inputted can’t be more than 15 characters");
    }

    $unique = true;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if (strcmp($file, $folderName) == 0) {
                $unique = false;
            }
        }
        closedir($dh);
    }

    if (!$unique) {
        array_push($errorMsg, "duplicate folder name");
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        mkdir($dir . $folderName);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // END HERE
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rename-f'])) {
    /**
     * ///////////////////////////////////////
     * 
     * File Folder Controller:
     * -> Validate input
     * -> Make sure the new name not used
     * -> Rename the file/folder
     * -> If success, redirect to the previous page
     * -> If not, redirect to the previous page and show error message
     * 
     * ///////////////////////////////////////
     */

    //  !!CODE START HERE
    $id = $_POST['id'];
    $username = $_POST['username'];
    $dir = '../all-drives' . $_POST['dir'];
    $page = $_POST['page'];
    $oldName = $_POST['oldName'];
    $newName = $_POST['fName'];

    $errorMsg = array();
    if (file_exists($dir . $newName)) {
        array_push($errorMsg, "name already used");
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        rename($dir . $oldName, $dir . $newName);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    // END HERE
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-f'])) {
    /**
     * ///////////////////////////////////////
     * 
     * File Folder Controller:
     * -> Delete the selected file
     * -> Delete the selected folder and its whole content inside
     * -> If success, redirect to the previous page
     * -> If not, redirect to the previous page and show error message
     * 
     * ///////////////////////////////////////
     */

    //  !!CODE START HERE
    $id = $_POST['id'];
    $username = $_POST['username'];
    $dir = '../all-drives' . $_POST['dir'];
    $page = $_POST['page'];
    $fileName = $_POST['fName'];

    $errorMsg = array();
    if (filetype($dir . $fileName) == 'dir') {
        rmdir($dir . $fileName);
    } else {
        unlink($dir . $fileName);
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        rename($dir . $oldName, $dir . $newName);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }



    // END HERE

}