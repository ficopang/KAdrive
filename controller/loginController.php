<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    /**
     * ///////////////////////////////////////
     * 
     * Login Controller:
     * -> Validating input field on the form
     * -> Check if account exists in csv
     * -> If success login in, redirect to index.php and store user's information in URL
     * -> If not, redirect to login page again and show error message
     * 
     * ///////////////////////////////////////
     */

    //  !!CODE START HERE
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errorMsg = array();
    if (empty($email) || empty($password)) {
        array_push($errorMsg, "All fields can’t be empty.");
    }

    $found = false;
    $userID = 0;
    $username = "";
    $userPassword = "";
    if (($handle = fopen("../csv/users.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if (strcmp($email, $data[2]) == 0) {
                $found = true;
                $userID = $data[0];
                $username = $data[1];
                $userPassword = $data[3];
                break;
            }
        }
        fclose($handle);
    }

    if (!$found) {
        array_push($errorMsg, "Account not exist.");
    } else
    if (!password_verify($password, $userPassword)) {
        array_push($errorMsg, "Invalid password");
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ../login.php');
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $userID;
        header('Location: ../index.php?id=' . $userID . "&username=" . $username);
    }

    // END HERE
}