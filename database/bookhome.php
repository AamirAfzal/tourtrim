<?php
        session_start();
        if(!isset($_SESSION['id'])){
            // header("location: ./index.php");
        }

        include("connection.php");
                
        $database = Database::getInstance();
        $mysqli = $database->getConnection();

        $result=$mysqli->query("SELECT * FROM places WHERE is_active=0;");

        // $data[]=array();
        while($data[] = $result->fetch_assoc());
        unset($data[count($data)-1]);

        $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price/Night","Has","Booking");

        if (isset($_POST['book'])){
            $userId = $_SESSION['id'];
            $price = isset($_POST['price'])?(int)$_POST['price']:0;
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            $mysqli->query("UPDATE places SET is_active=1 WHERE id='$id';") or die($mysqli->error);
            $mysqli->query("INSERT INTO reservations (guest_id,place_id,start_date,price) VALUES ('$userId','$id',CURDATE(),'$price');");
            header("location: ./availableHome.php");
        }


    ?>