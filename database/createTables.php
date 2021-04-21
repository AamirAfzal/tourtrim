<?php 

require_once('connection.php');

$database = Database::getInstance();
$connect = $database->getConnection();

$tableCreateQueries[] = "CREATE TABLE Persons (
    id int(10) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    host varchar(255) NOT NULL,
    PRIMARY KEY (id)
);";

$tableCreateQueries[] = "CREATE TABLE Places (
    id int(10) NOT NULL AUTO_INCREMENT,
    host_id int(10) NOT NULL,
    home_type varchar(255) NOT NULL,
    bed_rooms int(10) NOT NULL,
    bath_rooms int(10) NOT NULL,
    name varchar(255),
    price int(11) NOT NULL,
    maxpeople int(11) NOT NULL,
    location varchar(255) NOT NULL,
    is_tv tinyint(1) NOT NULL DEFAULT '0',
    is_kitchen tinyint(1) NOT NULL DEFAULT '0',
    is_heating tinyint(1) NOT NULL DEFAULT '0',
    is_internet tinyint(1) NOT NULL DEFAULT '0',
    is_active tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (id),
    FOREIGN KEY (host_id) REFERENCES Persons(id) ON DELETE CASCADE
);";

$tableCreateQueries[] = "CREATE TABLE Reservations (
    id int(10) NOT NULL AUTO_INCREMENT,
    guest_id int(10) NOT NULL,
    place_id int(10) NOT NULL,
    start_date date NOT NULL,
    end_date date,
    price int(11),
    total int(11),
    PRIMARY KEY (id),
    FOREIGN KEY (guest_id) REFERENCES Persons(id) ON DELETE CASCADE,
    FOREIGN KEY (place_id) REFERENCES Places(id) ON DELETE CASCADE
);";

$tableCreateQueries[] = "CREATE TABLE Experiences (
    id int(10) NOT NULL AUTO_INCREMENT,
    host_id int(10) NOT NULL,
    experience_type varchar(255) NOT NULL,
    name varchar(255),
    place varchar(255),
    price int(11) NOT NULL,
    days int(11) NOT NULL,
    max_persons int(11) NOT NULL,
    is_active tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (id),
    FOREIGN KEY (host_id) REFERENCES Persons(id) ON DELETE CASCADE
    );";

$tableCreateQueries[] = "CREATE TABLE Reserviences (
    id int(10) NOT NULL AUTO_INCREMENT,
    tourist_id int(10) NOT NULL,
    experience_id int(10) NOT NULL,
    start_date date NOT NULL,
    end_date date NOT NULL,
    price int(11),
    total int(11),
    PRIMARY KEY (id),
    FOREIGN KEY (tourist_id) REFERENCES Persons(id) ON DELETE CASCADE,
    FOREIGN KEY (experience_id) REFERENCES Experiences(id) ON DELETE CASCADE
    );";



foreach($tableCreateQueries as $query){
    $connect->query($query);
}


$database->closeConnection();
?>