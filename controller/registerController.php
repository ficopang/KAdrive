<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    /**
     * ///////////////////////////////////////
     * 
     * Register Controller:
     * -> Validating input field on the form
     * -> Check if email already exists in csv
     * -> Password hash
     * -> Generate id
     * -> If success login in, redirect to login.php
     * -> If not, redirect to register page again and show error message
     * 
     * ///////////////////////////////////////
     */

    //  !!CODE START HERE
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['conf-password'];

    $errorMsg = array();
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        array_push($errorMsg, "All fields can’t be empty.");
    }
    if (strlen($username) < 5 || strlen($username) > 20) {
        array_push($errorMsg, "Username inputted must be atleast 5 to 20 characters.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errorMsg, "Email inputted must be a valid format email");
    }

    $unique = true;
    $lastId = 0;
    if (($handle = fopen("../csv/users.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            // $num = count($data);
            // for ($c = 0; $c < $num; $c++) {
            //     echo $data[$c] . "<br />\n";
            // }
            if (strcmp($email, $data[2]) == 0) {
                $unique = false;
            }
            $lastId = (int)$data[0] + 1;
        }
        fclose($handle);
    }

    if (!$unique) {
        array_push($errorMsg, "Email in use");
    }
    if (!preg_match('/[A-Z]/', $password)) {
        array_push($errorMsg, "Password inputted must have atleast one uppercase letter");
    }
    if (strcmp($password, $confirm_password) != 0) {
        array_push($errorMsg, "Confirm password inputted must match with password");
    }

    unset($_SESSION['error']);
    if (count($errorMsg) > 0) {
        $_SESSION['error'] = $errorMsg;
        header('Location: ../register.php');
    } else {
        $handle = fopen("../csv/users.csv", "a");
        fputcsv($handle, array($lastId, $username, $email, password_hash($password, PASSWORD_DEFAULT)), ";");
        fclose($handle);
        mkdir('../all-drives/' . $lastId);
        header('Location: ../login.php');
    }

    // END HERE
}