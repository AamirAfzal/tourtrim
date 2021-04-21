<?php

// echo "a";
session_start();
// echo "a";

include("connection.php");
// echo "a";

if (!isset($_SESSION['id'])){
    header("Location: ../index.php");
}

$database = Database::getInstance();
$mysqli = $database->getConnection();

//  $servername = "localhost";
//  $username = "root";
//  $password = "root";
//  $database = "webapp";
// $mysqli = new mysqli($this->servername, $this->username, $this->password, $this->database);
// echo "a";



$id = $_SESSION['id'];

$re = $mysqli->query("SELECT * FROM persons WHERE id = '$id';") or die($mysqli->error);
$data = $re->fetch_assoc();
// echo $re->fetch_assoc()['password']."ddd";
// $count = mysqli_num_rows($re);

$name = $data['name'];
$email = $data['email'];
$host = $data['host'];

$nam = explode(" ",$name);

if (isset($_POST['profile'])){
    $name = isset($_POST['name'])? $_POST['name']:"";
    $mysqli->query("UPDATE persons SET name='$name' WHERE id='$id'");
    header("location: user.php");
}

if (isset($_POST['delete'])){
    $iid= $_POST['id'];
    $x=$_SERVER['QUERY_STRING'];
    $mysqli->query("DELETE FROM '$x' WHERE id='$iid';");
}

if (isset($_GET['places'])){

    if (isset($_POST['delete'])){
        $iid= $_POST['id'];
        $mysqli->query("DELETE FROM places WHERE id='$iid';");
    }
    else if(isset($_POST['update'])){
        $iid = $_POST['id'];
        $name = $_POST['name'];
        $bath = $_POST['bath'];
        $bed = $_POST['bed'];
        $price = $_POST['price'];
        $max = $_POST['people'];

        $mysqli->query("UPDATE places SET name='$name',bath_rooms='$bath',bed_rooms='$bed',price='$price',maxpeople='$max' WHERE id='$iid';");

        header("location: tables.php?places");
    }

    $re = $mysqli->query("SELECT * FROM places WHERE host_id='$id';");
    $count = mysqli_num_rows($re);
    $data = array();
    while($data[]=$re->fetch_assoc());
    unset($data[count($data)-1]);
    $data = array_filter($data);
    $data = array_values($data);
    
    $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price($)/night","Has","Update","Delete");

}else if (isset($_GET['experiences'])){
    if (isset($_POST['delete'])){
        $iid= $_POST['id'];
        $mysqli->query("DELETE FROM experiences WHERE id='$iid';");
    }
    else if(isset($_POST['update'])){
        $iid = $_POST['id'];
        $name = $_POST['name'];
        $days = $_POST['days'];
        $price = $_POST['price'];
        $max = $_POST['people'];

        $mysqli->query("UPDATE experiences SET name='$name',days='$days',price='$price',max_persons='$max' WHERE id='$iid';");

        header("location: tables.php?experiences");
    }
    $re = $mysqli->query("SELECT * FROM experiences WHERE host_id='$id';");
    $count = mysqli_num_rows($re);
    $data = array();
    while($data[]=$re->fetch_assoc());
    unset($data[count($data)-1]);
    $data = array_filter($data);
    $data = array_values($data);
    $headings = array("No.","Name","Type","Max People","days","Location","Price ($)","Update","Delete");

}else if (isset($_GET['reservations'])){
    if (isset($_POST['delete'])){
        $iid= $_POST['id'];
        $mysqli->query("DELETE FROM reservations WHERE id='$iid';");
    }
    $re = $mysqli->query("SELECT r.id,p.home_type,p.bed_rooms,p.bath_rooms,p.name,p.price,p.maxpeople,p.location,p.is_tv,p.is_kitchen,p.is_heating,p.is_internet,r.start_date,r.end_date,r.total FROM reservations as r INNER JOIN places as p ON r.place_id=p.id AND r.guest_id='$id';");
    $count = mysqli_num_rows($re);
    $data = array();
    while($data[]=$re->fetch_assoc());
    unset($data[count($data)-1]);
    $data = array_filter($data);
    $data = array_values($data);

    $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price ($)/Night","Has","Checkin Date","Checkout Date","Total","Delete");

}else if (isset($_GET['reserviences'])){
    if (isset($_POST['delete'])){
        $iid= $_POST['id'];
        $mysqli->query("DELETE FROM reserviences WHERE id='$iid';");
    }
    $re = $mysqli->query("SELECT r.id,e.experience_type,e.name,e.place,e.price,e.max_persons,r.start_date,r.end_date,r.total FROM reserviences as r INNER JOIN experiences as e ON r.experience_id=e.id AND r.tourist_id='$id';");
    $count = mysqli_num_rows($re);
    $data = array();
    while($data[]=$re->fetch_assoc());
    unset($data[count($data)-1]);
    $data = array_filter($data);
    $data = array_values($data);
    $headings = array("No.","Name","Type","Max People","days","Location","Price ($)","Start Date","End Date","Total","Delete");


}


$database->closeConnection();


?>