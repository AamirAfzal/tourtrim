<?php
        session_start();
        if(!isset($_SESSION['id'])){
            // header("location: ./index.php");
        }

        include("connection.php");
                
        $database = Database::getInstance();
        $mysqli = $database->getConnection();

        $result=$mysqli->query("SELECT * FROM experiences");

        // $data[]=array();
        while($data[] = $result->fetch_assoc());
        unset($data[count($data)-1]);

        $headings = array("No.","Name","Type","Max People","days","Location","Price","Booking");

        if (isset($_POST['book'])){
            $userId = $_SESSION['id'];
            $price = isset($_POST['price'])?(int)$_POST['price']:0;
            $id = isset($_POST['id'])?(int)$_POST['id']:0;
            $mysqli->query("UPDATE experiences SET is_active=1 WHERE id='$id';") or die($mysqli->error);
            $mysqli->query("INSERT INTO reserviences (tourist_id,experience_id,start_date,price) VALUES ('$userId','$id',CURDATE(),'$price');");
            header("location: ./availableTours.php");
        }


    ?>