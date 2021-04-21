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
        echo "User does not exist!";
    }   
    else if ($hash==$data['password']){
        $_SESSION['id'] = $data['id'];
        // echo $_SESSION['id'];
        if (isset($_GET['home'])){
            header("Location: host/home");
        }else if (isset($_GET['tour'])){
            header("Location: host/tour");
        }else{
            header("Location: ./index.php");
        }
    }else{
        echo "Incorrect Password!";
    }
}
else if (isset($_POST['signup'])){
    
    $stmt = $mysqli->prepare("INSERT INTO persons (name,email,password,host) VALUES (?, ?, ?, ?);");
    $stmt->bind_param('ssss',$name, $email, $hash, $host);
    // session_destroy();
    $name = isset($_POST['name'])? $_POST['name']:"";
    $email = isset($_POST['email'])? $_POST['email']:"";
    $password = isset($_POST['password'])? $_POST['password']:"";
    $host = isset($_GET['host'])? "yes":"no";
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
        if (isset($_GET['home'])){
            header("Location: host/home");
        }else if (isset($_GET['tour'])){
            header("Location: host/tour");
        }else{
            header("Location: ./index.php");
        }
    }   
    else{
        echo "User Already Exist!";
    }
}


$database->closeConnection();

?>