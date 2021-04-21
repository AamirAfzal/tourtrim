<?php
session_start();
require_once("connection.php");
$database = Database::getInstance();
$mysqli = $database->getConnection();


$stmt = $mysqli->prepare("INSERT INTO persons (name,email,password,host) VALUES (?, ?, ?, ?);");
$stmt->bind_param('ssss',$name, $email, $hash, $host);


if (isset($_SESSION['id'])){
    header("Location: ./index.php");
}
else if (isset($_POST['signup'])){
    // session_destroy();
    $name = isset($_POST['name'])? $_POST['name']:"";
    $email = isset($_POST['email'])? $_POST['email']:"";
    $password = isset($_POST['password'])? $_POST['password']:"";
    $host = isset($_GET['host'])? $_GET['host']:"no";
    $hash = hash("sha512",$password);

    $re = mysqli_query($mysqli,"SELECT * FROM persons WHERE email='$email';");
    // echo $re->fetch_assoc()['name'];
    $count = mysqli_num_rows($re);
    if ($count==0){
        $stmt->execute();
        echo "Registerd";
        $re = mysqli_query($mysqli,"SELECT * FROM persons WHERE email='$email';");
        $data = $re->fetch_assoc();
        $_SESSION['id'] = $data['id'];
        echo $_SESSION['id'];
        header("Location: ./index.php");
    }   
    else{
        echo "User Already Exist";
    }
}
$database->closeConnection();

?>