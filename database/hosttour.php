<?php
session_start();
// echo "a";
require_once("connection.php");
$database = Database::getInstance();
$mysqli = $database->getConnection();

// echo "A";

if (!isset($_SESSION['id'])){
    header("Location: ../../enter.php?tour");
}

$id = $_SESSION['id'];

$stmnt = $mysqli->prepare("INSERT INTO experiences (host_id,experience_type,name,place,price,days,max_persons) VALUES(?,?,?,?,?,?,?);");
$stmnt->bind_param('isssiii',$id,$type,$name,$location,$price,$days,$max);


if (isset($_POST['hosttour'])){
    $name=isset($_POST['name'])?$_POST['name']:"";
    $type=isset($_POST['type'])?$_POST['type']:"";
    $price=isset($_POST['price'])?(int)$_POST['price']:0;
    $max=isset($_POST['people'])?(int)$_POST['people']:0;
    $location=isset($_POST['countries']) && isset($_POST['cities'])?$_POST['countries'].",".$_POST['cities']:"";
    $days=isset($_POST['days'])?(int)$_POST['days']:0;

    $stmnt->execute();

    $result = $mysqli->query("SELECT * FROM persons WHERE id = '$id';");
    $result = $result->fetch_assoc();
    if ($result['host']=="no"){
        $mysqli->query("UPDATE persons SET host='yes' WHERE id = '$id';");
    }
    header("Location: ../../index.php");

}

$database->closeConnection();

?>