<?php

    include("connection.php");

    if(isset($_GET['vehicle_id'])) {
         $vehicle_id=$_GET['vehicle_id'];

         $sq="DELETE FROM bookedvehicle where vehicle_id=$vehicle_id ";
         $sql="DELETE FROM vehicle where vehicle_id=$vehicle_id ";

         $res=mysqli_query($connection, $sql);
         $result=mysqli_query($connection, $sql);
         if($result){
            echo '<script type="text/javascript">alert("Data deleted")</script>';
            sleep(0.2);
            
            header("location: availrent.php");

         }
         else{
            echo '<script type="text/javascript">alert("Data Not deleted")</script>';

         }
     }

    ?>
<!--This page is made for deleting the Car list. Once the car is deleted by agency user booking the same car will also be deleted-->
