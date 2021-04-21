<?php

session_start();
require_once("connection.php");
$database = Database::getInstance();
$mysqli = $database->getConnection();

$stmnt = $mysqli->prepare("INSERT INTO reservations (guest_id,place_id,start_date,end_date,price,total) VALUES(?,?,CAST(? AS DATE),CAST(? AS DATE),?,?);");
$stmnt->bind_param('iissii',$guest,$place,$sdate,$edate,$price,$total);


if (isset($_POST['home'])){
    $sdate = isset($_POST['startdate'])? $_POST['startdate']:"";
    $edate = isset($_POST['enddate'])? $_POST['enddate']:"";
    $guest = isset($_POST['people'])? (int)$_POST['people']:0;

    // $myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
    // $newDateString = $myDateTime->format('m/d/Y');
    // echo new DateTime($edate);
    // echo $sdate->format('Y-m-d');
    // echo $sdate;
    $sdate = DateTime::createFromFormat('m/d/Y', $sdate);
    $edate = DateTime::createFromFormat('m/d/Y', $edate);
    $sdate = $sdate->format('Y-m-d');
    $edate = $edate->format('Y-m-d');
    // echo $guest;
    // echo $sdate;
    // echo $edate;
    // echo "a";

    $re = $mysqli->query("SELECT * FROM places WHERE maxpeople>='$guest';") or die($mysqli->error);
    // echo $re->fetch_assoc()['name'];
    // echo "a";
    // while($data[] = $re->fetch_assoc()){
        // $id = $data['id'];
        // echo $id;
        // echo "a";
            // echo $sdate;
        // $res = $mysqli->query("SELECT * FROM reservations WHERE place_id='$id' AND '$sdate' BETWEEN start_date AND end_date;") or die($mysqli->error);
        // if (mysqli_num_rows($res)){

        // }
        // echo $res->fetch_assoc()['place_id'];
        // echo 'n';
    // }
    // echo "a";
    $count = mysqli_num_rows($re);
    if ($count!=0){
        $data = array();
        while($data[] = $re->fetch_assoc());
        foreach($data as $index=>$single){
            $id = $single['id'];
            // echo "a";
            $reSD = $mysqli->query("SELECT * FROM reservations WHERE place_id='$id' AND '$sdate' BETWEEN start_date AND end_date;") or die($mysqli->error);
            $reED = $mysqli->query("SELECT * FROM reservations WHERE place_id='$id' AND '$edate' BETWEEN start_date AND end_date;") or die($mysqli->error);
            if (mysqli_num_rows($reSD) || mysqli_num_rows($reED)){
                $data[$index]=null;
            }   
        }
    }
    
    $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price/Night","Has","Booking");
    unset($data[count($data)-1]);
    $data = array_filter($data);
    $data = array_values($data);
}else{
    // header("location: ./index.php");
}

if (isset($_POST['book']) && isset($_SESSION['id'])){
    $userId = $_SESSION['id'];
    $price = isset($_POST['price'])?(int)$_POST['price']:0;
    $id = isset($_POST['id'])?(int)$_POST['id']:0;
    $sdate = isset($_POST['sdate'])? $_POST['sdate']:"";
    $edate = isset($_POST['edate'])? $_POST['edate']:"";
    $days = strtotime($edate) - strtotime($sdate);
    $days = round($days/86400);
    $total = (int)$days * $price;
    // $mysqli->query("UPDATE places SET is_active=1 WHERE id='$id';") or die($mysqli->error);
    
    $mysqli->query("INSERT INTO reservations (guest_id,place_id,start_date,end_date,price,total) VALUES ('$userId','$id','$sdate','$edate','$price','$total');");
    header("location: ./dashboard/tables.php?reservations");
}
else{
    // header("location: ./enter.php?bookhome");
}
$database->closeConnection();



?>