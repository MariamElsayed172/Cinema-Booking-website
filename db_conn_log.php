<?php

    $sname = "localhost";
    $uname = "root";
    $password = "";

    $db_name = "movie"; //// the name of the database

    $conn = mysqli_connect($sname, $uname, $password, $db_name);

    if(!$conn){
        echo "connection Failed";
    }
