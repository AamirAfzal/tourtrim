<?php
session_start();
// echo "a";
require_once("connection.php");
$database = Database::getInstance();
$mysqli = $database->getConnection();

// echo "A";

if (!isset($_SESSION['id'])){
    header("Location: ../../enter.php?home");
}

$id = $_SESSION['id'];

$stmnt = $mysqli->prepare("INSERT INTO places (host_id,home_type,bed_rooms,bath_rooms,name,price,maxpeople,location,is_tv,is_kitchen,is_heating,is_internet) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);");
$stmnt->bind_param('isiisiisiiii',$id,$type,$bed,$bath,$name,$price,$max,$location,$tv,$kit,$ac,$net);


if (isset($_POST['hosthome'])){
    $name=isset($_POST['name'])?$_POST['name']:"";
    $type=isset($_POST['type'])?$_POST['type']:"";
    $bed=isset($_POST['bed'])?(int)$_POST['bed']:0;
    $bath=isset($_POST['bath'])?(int)$_POST['bath']:0;
    $price=isset($_POST['price'])?(int)$_POST['price']:0;
    $max=isset($_POST['people'])?(int)$_POST['people']:0;
    $location=isset($_POST['countries']) && isset($_POST['cities'])?$_POST['countries'].",".$_POST['cities']:"";
    $tv=0;
    $ac=0;
    $net=0;
    $kit=0;
    // if (!empty($_POST['box'])){
    foreach($_POST['box'] as $val){
        if ($val == 'ac'){
            $ac=1;
        }else if ($val == 'tv'){
            $tv=1;
        }else if ($val == 'net'){
            $net=1;
        }else if ($val == 'kit'){
            $kit=1;
        }
    }
    // }

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