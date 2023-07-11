<?php

function emptyInputSignup($name, $email, $username, $department, $password, $confirmpassword) {
    $result = false;
    if (empty($name) || empty($username) || empty($email) || empty($department) || empty($password) || empty($confirmpassword)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $confirmpassword) {
    $result = false;
    if($password !== $confirmpassword) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username, $email) {
    $sql = "SELECT * FROM user WHERE user_username = ? OR user_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
        return $row;
    }

    else {
        $result = false;
        mysqli_stmt_close($stmt);
        return $result;
    }

    
}

//Sign up the user
function createUser($conn, $name, $email, $username, $department, $password) {
    $sql = "INSERT INTO user (user_name, user_email, user_username, user_department, user_password) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $username, $department, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../main.php");
    exit();
}

function emptyInputLogin($username, $password) {
    $result = false;
    if (empty($username) || empty($password)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password) {
    $usernameExists = usernameExists($conn, $username, $username);
    
    if ($usernameExists === false) {
        header("location: ../login.php?error=wronglogin1");
        exit();
    }

    $passwordHashed = $usernameExists["user_password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../login.php?error=wronglogin2");
        exit();
    }

    else if ($checkPassword === true) {
        session_start();
        $_SESSION["userid"] = $usernameExists["user_id"];
        $_SESSION["userusername"] = $usernameExists["user_username"];
        header("location: ../main.php");
        exit();
    }
}

function uploadItemImage($fileActualExt, $allowed, $fileError, $fileSize) {
    $result = false;
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                /*
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);*/
                //header("Location: main.php?uploadsuccess");
                $result = false;
            }
            else {
                //echo "Your file is too big!";
                $result = true;
            }
        }
        
        else {
            //echo "There was an error uploading your file!";
            $result = true;
        }
    }
    else {
        //echo "You cannot upload files of this type!";
        $result = true;
    }
    return $result;
}

function addNewItem($conn, $itemname, $iteminstock, $fileNameNew) {
    $sql = "INSERT INTO inventory (item_name, item_in_stock, item_image) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../main.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $itemname, $iteminstock, $fileNameNew);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../main.php");
    exit();
}

function checkLoggedIn() {
    if (isset($_SESSION["userid"])) {
        // User is logged in
        header("location: main.php");
        exit;
    }
}