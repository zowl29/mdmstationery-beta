<?php
if (isset($_POST['submit'])) {

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $itemname = $_POST["itemName"];
    $iteminstock = $_POST["itemInStock"];
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (UploadItemImage($fileActualExt, $allowed, $fileError, $fileSize) !== false) {
        header("location: ../signup.php?error=uploadimagefailed");
        exit();
    }

    $fileNameNew = uniqid('', true).".".$fileActualExt;
    $fileDestination = '../uploads/'.$fileNameNew;
    move_uploaded_file($fileTmpName, $fileDestination);
    addNewItem($conn, $itemname, $iteminstock, $fileNameNew);

}