<?php

// session_start();
if(!isset($_SESSION['id'])){
    // header("location: ./index.php");
}

include("connection.php");
        
$database = Database::getInstance();
$mysqli = $database->getConnection();

$result=$mysqli->query("SELECT * FROM places WHERE is_active=0;");

// $data[]=array();
while($data[] = $result->fetch_assoc()){
    // echo $data[0]['location'];
}
unset($data[count($data)-1]);

echo "a";

$database->closeConnection();

?>