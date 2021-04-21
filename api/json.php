<?php

require_once("../database/connection.php");
$database = Database::POSTInstance();
$mysqli = $database->POSTConnection();
// $hash = hash('sha512','A@24685135');
// define('token',$hash);

if (isset($_POST['signin'])){
    
    if (isset($_POST['signin'])){
        $email = isset($_POST['email'])? $_POST['email']:"sajidhassan1997@gmail.com";
        $password = isset($_POST['password'])? $_POST['password']:"";
        $hash = hash("sha512",$password);

        $re = mysqli_query($mysqli,"SELECT * FROM persons WHERE email = '$email';");
        $data = $re->fetch_assoc();
        // echo $re->fetch_assoc()['password']."ddd";
        $count = mysqli_num_rows($re);
        // echo $count;
        if ($count==0){
            $data['id']=0;
        }   
        else if ($hash==$data['password']){
            unset($data['password']);
        }else{
            unset($data);
            $data['id']=-1;
        }

        echo json_encode($data);
    }
}
else if (isset($_POST['signup'])){
    $stmt = $mysqli->prepare("INSERT INTO Persons (name,email,password,type) VALUES (?, ?, ?, ?);");
    $stmt->bind_param('ssss',$name, $email, $hash, $type);

    if (isset($_POST['signup'])){
        $name = isset($_POST['name'])? $_POST['name']:"";
        $email = isset($_POST['email'])? $_POST['email']:"";
        $password = isset($_POST['password'])? $_POST['password']:"";
        $type = isset($_POST['type'])? $_POST['type']:"";
        $hash = hash("sha512",$password);
    
        $re = mysqli_query($mysqli,"SELECT * FROM persons WHERE email='$email';");
        // echo $re->fetch_assoc()['name'];
        $count = mysqli_num_rows($re);
        if ($count==0){
            $stmt->execute();
            $status['val']=true;
        }   
        else{
            $status['val']=false;
        }
        echo json_encode($status);
    }
}
else if (isset($_POST['hosthome'])){ 

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

        foreach($_POST['box'] as $val){
            if ($val == 'ac'){
                $tv=1;
            }else if ($val == 'tv'){
                $ac=1;
            }else if ($val == 'net'){
                $net=1;
            }else if ($val == 'kit'){
                $kit=1;
            }
        }
    
        $stmnt->execute();
    
        $result = $mysqli->query("SELECT * FROM persons WHERE id = '$id';");
        $result = $result->fetch_assoc();
        if ($result['host']=="no"){
            $mysqli->query("UPDATE persons SET host='yes' WHERE id = '$id';");
        }
        $data['val'] = "true";
    
        echo json_encode($data);
    
    }
}else if(isset($_POST['hosttour'])){
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

        $data['val'] = "true";
    
        echo json_encode($data);

    }
}
else if (isset($_POST['findplace'])){

    // $stmnt = $mysqli->prepare("INSERT INTO reservations (guest_id,place_id,start_date,end_date,price,total) VALUES(?,?,CAST(? AS DATE),CAST(? AS DATE),?,?);");
    // $stmnt->bind_param('iissii',$guest,$place,$sdate,$edate,$price,$total);

    if (isset($_POST['findhome'])){
        $sdate = isset($_POST['startdate'])? $_POST['startdate']:"";
        $edate = isset($_POST['enddate'])? $_POST['enddate']:"";
        $guest = isset($_POST['people'])? (int)$_POST['people']:0;

        $sdate = DateTime::createFromFormat('m/d/Y', $sdate);
        $edate = DateTime::createFromFormat('m/d/Y', $edate);
        $sdate = $sdate->format('Y-m-d');
        $edate = $edate->format('Y-m-d');
        
    
        $re = $mysqli->query("SELECT * FROM places WHERE maxpeople>='$guest';") or die($mysqli->error);
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
        
        // $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price/Night","Has","Booking");
        unset($data[count($data)-1]);
        $data = array_filter($data);
        $data = array_values($data);
        echo json_encode($data);
    }
}else if (isset($_POST['findtour'])){
    // $stmnt = $mysqli->prepare("INSERT INTO reservations (guest_id,place_id,start_date,end_date,price,total) VALUES(?,?,CAST(? AS DATE),CAST(? AS DATE),?,?);");
    // $stmnt->bind_param('iissii',$guest,$place,$sdate,$edate,$price,$total);


    if (isset($_POST['tour'])){
        $sdate = isset($_POST['startdate'])? $_POST['startdate']:"";
        $edate = isset($_POST['enddate'])? $_POST['enddate']:"";
        $tourist = isset($_POST['people'])? (int)$_POST['people']:0;

       
        $sdate = DateTime::createFromFormat('m/d/Y', $sdate);
        $edate = DateTime::createFromFormat('m/d/Y', $edate);
        $sdate = $sdate->format('Y-m-d');
        $edate = $edate->format('Y-m-d');


        $re = $mysqli->query("SELECT * FROM experiences WHERE max_persons>='$tourist';") or die($mysqli->error);
       
        $count = mysqli_num_rows($re);
        if ($count!=0){
            $data = array();
            while($data[] = $re->fetch_assoc());
            foreach($data as $index=>$single){
                $id = $single['id'];
                // echo "a";
                $reSD = $mysqli->query("SELECT * FROM reserviences WHERE experience_id='$id' AND '$sdate' BETWEEN start_date AND end_date;") or die($mysqli->error);
                $reED = $mysqli->query("SELECT * FROM reserviences WHERE experience_id='$id' AND '$edate' BETWEEN start_date AND end_date;") or die($mysqli->error);
                if (mysqli_num_rows($reSD) || mysqli_num_rows($reED)){
                    $data[$index]=null;
                }   
            }
        }
        
        // $headings = array("No.","Name","Type","Max People","days","Location","Price","Booking");
        unset($data[count($data)-1]);
        $data = array_filter($data);
        $data = array_values($data);

        echo json_encode($data);
    }
}else if (isset($_POST['booktour'])){
    if (isset($_POST['book'])){
        $userId = $_SESSION['id'];
        $price = isset($_POST['price'])?(int)$_POST['price']:0;
        $id = isset($_POST['id'])?(int)$_POST['id']:0;
        $sdate = isset($_POST['sdate'])? $_POST['sdate']:"";
        $edate = isset($_POST['edate'])? $_POST['edate']:"";
        $days = strtotime($edate) - strtotime($sdate);
        $days = round($days/86400);
        $total = (int)$days * $price;
        // $mysqli->query("UPDATE places SET is_active=1 WHERE id='$id';") or die($mysqli->error);
        
        $mysqli->query("INSERT INTO reserviences (tourist_id,experience_id,start_date,end_date,price,total) VALUES ('$userId','$id','$sdate','$edate','$price','$total');");
        // header("location: ./dashboard/tables.php?reserviences");
        $data['val'] = "true";
    
        echo json_encode($data);
    }
}else if (isset($_POST['bookplace'])){
    if (isset($_POST['book'])){
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
        // header("location: ./dashboard/tables.php?reservations");
        $data['val'] = "true";
    
        echo json_encode($data);
    }
}else if (isset($_POST['useractions'])){


    // $re = $mysqli->query("SELECT * FROM persons WHERE id = '$id';") or die($mysqli->error);
    // $data = $re->fetch_assoc();
    // echo $re->fetch_assoc()['password']."ddd";
    // $count = mysqli_num_rows($re);

    // $name = $data['name'];
    // $email = $data['email'];
    // $host = $data['host'];

    // $nam = explode(" ",$name);

    if (isset($_POST['profile'])){
        $name = isset($_POST['name'])? $_POST['name']:"";
        $mysqli->query("UPDATE persons SET name='$name' WHERE id='$id'");
        // header("location: user.php");
        $data['val'] = "true";
    
        echo json_encode($data);
    }

    // else if (isset($_POST['delete'])){
    //     $iid= $_POST['id'];
    //     $x=$_SERVER['QUERY_STRING'];
    //     $mysqli->query("DELETE FROM '$x' WHERE id='$iid';");
    // }

    else if (isset($_POST['places'])){

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

            $data['val'] = "true";
        
            // echo json_encode($data);
            // header("location: tables.php?places");
        }

        $re = $mysqli->query("SELECT * FROM places WHERE host_id='$id';");
        $count = mysqli_num_rows($re);
        $data = array();
        while($data[]=$re->fetch_assoc());
        unset($data[count($data)-1]);
        $data = array_filter($data);
        $data = array_values($data);
    
        echo json_encode($data);
        
        // $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price($)/night","Has","Update","Delete");

    }else if (isset($_POST['experiences'])){
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

            // header("location: tables.php?experiences");
        }
        $re = $mysqli->query("SELECT * FROM experiences WHERE host_id='$id';");
        $count = mysqli_num_rows($re);
        $data = array();
        while($data[]=$re->fetch_assoc());
        unset($data[count($data)-1]);
        $data = array_filter($data);
        $data = array_values($data);
    
        echo json_encode($data);
        // $headings = array("No.","Name","Type","Max People","days","Location","Price ($)","Update","Delete");

    }else if (isset($_POST['reservations'])){
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
        echo json_encode($data);

        // $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price ($)/Night","Has","Checkin Date","Checkout Date","Total","Delete");

    }else if (isset($_POST['reserviences'])){
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
        // $headings = array("No.","Name","Type","Max People","days","Location","Price ($)","Start Date","End Date","Total","Delete");
        echo json_encode($data);


    }
}






$database->closeConnection();

?>