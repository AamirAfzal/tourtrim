<?php
session_start();
require_once("connection.php");
$database = Database::getInstance();
$mysqli = $database->getConnection();


if (isset($_SESSION['id'])){
    header("Location: ./index.php");
}
else if (isset($_POST['signin'])){
    $email = isset($_POST['email'])? $_POST['email']:"";
    $password = isset($_POST['password'])? $_POST['password']:"";
    $hash = hash("sha512",$password);

    $re = mysqli_query($mysqli,"SELECT * FROM persons WHERE email = '$email';");
    $data = $re->fetch_assoc();
    // echo $re->fetch_assoc()['password']."ddd";
    $count = mysqli_num_rows($re);
    // echo $count;
    if ($count==0){
        echo "User does not exist";
    }   
    else if ($hash==$data['password']){
        $_SESSION['id'] = $data['id'];
        header("Location: ./index.php");
    }else{
        echo "Incorrect Password";
    }
}
$database->closeConnection();

?>