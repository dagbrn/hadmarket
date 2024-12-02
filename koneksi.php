<?php


    $connect = mysqli_connect("localhost","root","","hadmarket");

    if(mysqli_connect_errno()){
        echo "failed to connect to database: " . mysqli_connect_error();
        exit();
    }
?>