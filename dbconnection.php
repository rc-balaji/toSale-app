<?php

    $dbcon = mysqli_connect('localhost','root','#Balaji@2003','olx');

    if($dbcon==false)
    {
        echo "Database is not Connected!";
    }
   
?>