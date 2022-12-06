<?php

    
    $username="root";
    $password="";
    $server='localhost';
    $db= 'carent';


    $connection = mysqli_connect ($server,$username,$password,$db);
    
    if (mysqli_connect_errno())
    {
        echo "\n**********\nFailed to connect to MySQL: " . mysqli_connect_error()."\n**********";
    }
    else
    //echo "Success!!!";
    
?>