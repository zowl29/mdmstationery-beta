<?php

if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Error handlers
    if (emptyInputSignup($name, $email, $username, $department, $password, $confirmpassword) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("location: ../signup.php?error=invalidusername");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (passwordMatch($password, $confirmpassword) !== false) {
        header("location: ../signup.php?error=passworddontmatch");
        exit();
    }

    if (usernameExists($conn, $username, $email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $department, $password);
}

else {
    header("location: ../signup.php");
    exit();
}