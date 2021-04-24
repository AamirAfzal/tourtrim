<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color:whitesmoke">
    <?php
        // session_start();
        // if(!isset($_SESSION['id'])){
        //     header("location: ./index.php");
        // }

        // include("database/connection.php");
                
        // $database = Database::getInstance();
        // $mysqli = $database->getConnection();

        // $result=$mysqli->query("SELECT * FROM places WHERE is_active=0;");

        // // $data[]=array();
        // while($data[] = $result->fetch_assoc());
        // unset($data[count($data)-1]);

        // $headings = array("No.","Name","Type","Bed Rooms","Bath Rooms","Max People","Location","Price/Night","Has","Booking");

        // if (isset($_POST['book'])){
        //     $id = isset($_POST['id'])?(int)$_POST['id']:0;
        //     $mysqli->query("UPDATE places SET is_active=1 WHERE id='$id';") or die($mysqli->error);

        // }

        // include("database/booktour.php");
        include("database/findtour.php");


    ?>
    <div class="" style="margin: 20px;">
        <input class="form-control form-control-lg" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Type or Location" title="Type in a name">
        <table style="margin-top: 20px;" id="myTable" class="table table-hover table-responsive-md">
            <thead>
                <tr>
                    <?php
                        foreach($headings as $heading){
                            echo "<th>$heading</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if (count($data)!=0){
                    foreach($data as $index=>$single){?>
                        <tr>
                            <td><?php echo $index+1; ?></td>
                            <td><?php $var = $single['name']; echo $var; ?></td>
                            <td><?php $var = $single['experience_type']; echo $var; ?></td>
                            <td><?php $var = $single['max_persons']; echo $var; ?></td>
                            <td><?php $var = $single['days']; echo $var; ?></td>
                            <td><?php $var = $single['place']; echo $var; ?></td>
                            <td><?php $var = $single['price']; echo $var; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="price" value=<?php echo $single['price']; ?>>
                                    <input type="hidden" name="id" value=<?php echo $single['id']; ?>>
                                    <input type="hidden" name="sdate" value=<?php echo $sdate; ?>>
                                    <input type="hidden" name="edate" value=<?php echo $edate; ?>>
                                    <input name="book" class="btn btn-outline-dark btn-block" type=submit value="Book Me">
                                </form>
                            </td>
                        </tr>
                <?php }}
                //else{ ?>
                <!-- <tr style="font-size: 40px;width:100%"> No Data Found</tr> -->
                <?php //} ?>
            </tbody>
        </table>
    </div>

    <script>
        function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            arr = tr[i].getElementsByTagName("td");
            td1 = arr[2];
            td2 = arr[5];
            if (td1 || td2) {
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        }
        }
    </script>
</body>
</html>