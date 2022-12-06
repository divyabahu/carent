<?php
    error_reporting(0);
    session_start();
  include("connection.php");
      
      $vehicle_id=$_GET['vehicle_id'];
        $sq="SELECT * from vehicle where vehicle_id={$vehicle_id}";
  $row=mysqli_query($connection , $sq);
  $res=mysqli_fetch_array($row);
      if(isset($_POST['submit'])){
        
        
        $model=$_POST['model'];
        $vehicle_number=$_POST['vehicle_number'];
        $capacity=$_POST['capacity'];
        $rent=$_POST['rent'];
        $query = "UPDATE `vehicle` SET `model`='$model',`vehicle_number`='$vehicle_number',`capacity`='$capacity',`rent`='$rent' WHERE vehicle_id=$vehicle_id";


        $query_run=mysqli_query($connection, $query);

        if($query_run){
            echo '<script type="text/javascript">alert("Data Saved")</script>';
            header("location: availrent.php");  
        }else{
            echo '<script type="text/javascript">>alert("Data Not Saved")</script>';
        }
    }

?>
<!-- This page is accesible only to agency-->
<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<?php if($_SESSION['type']=='agency'){?>
        <title>caRent || Update Your Vehicle</title>
<!-- if user logged in header will be My booked cars-->
<?php } 
      elseif($_SESSION['type']=='user'){?>
        <title>caRent || Agecny service</title>
<?php } 
else{?>
  <title>caRent || Agency Service</title>
<?php } ?>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content=""> 
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets --> 
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>

<body>
    <!--header section start -->
<!--header section start -->
    <div id="index.html" class="header_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                        <?php if($_SESSION['type']=='agency' || $_SESSION['type']=='user'){?>
                            <div class="logo"><a href="index.php?id=<?php echo $_SESSION["username"];?>"><img src="images/logo.png"></a></div>

                        <?php } else { ?>
                            <div class="logo"><a href="index.php"><img src="images/logo.png"></a></div>
                          <?php } ?>
                    
                </div>
                <div class="col-sm-6 col-lg-9">
                    <div class="menu_text">
                        <ul>
                          <?php if($_SESSION['type']=='agency' || $_SESSION['type']=='user'){?>
                            <li><a href="index.php?id=<?php echo $_SESSION["username"];?>">Home</a></li>

                          <?php } else { ?>
                            <li><a href="index.php">Home</a></li>
                          <?php } ?>

                          <?php 
                                if($_SESSION['type'] == 'user'){ ?>
                            <li><a href="availrent.php?id=<?php echo $_SESSION["username"];?>">Available Cars</a></li>
                          <?php } else if($_SESSION['type']=='agency') { ?>
                            <li><a href="availrent.php?id=<?php echo $_SESSION["username"];?>">Added Cars</a></li>
                            <?php } else{ ?>
                             <li>
                              <div class="dropdown">
                                  <a class="dropbtn">Registration</a>
                                  <div class="dropdown-content">
                                        <a href="agencyreg.php">Agency</a>
                                        <a href="userreg.php">User</a>
                                  </div>
                                </div>
                            </li>
                           <?php } ?>

                            <?php if($_SESSION['type']=='agency'){?>
                              <li><a href="bookedcar.php?id=<?php echo $_SESSION["username"];?>">Booked Cars</a></li>
                            <?php }
                            if($_SESSION['type']=='user'){?>
                             <li><a href="bookedcar.php?id=<?php echo $_SESSION["username"];?>">My Booked Cars</a></li>
                            <?php }?>

                            <?php 
                                if($_SESSION['type']=='agency' || $_SESSION['type'] == 'user'){ ?>
                            <li>
                              <div class="dropdown">
                                  <a class="dropbtn"><a href="#" style="border: 1px solid yellow;"> <?php echo $_SESSION["username"];?></a>
                                  <div class="dropdown-content">
                                        <a href="logout.php">LogOut</a>
                                        
                                  </div>
                                </div>
                            </li>
                          <?php } 
                          else { ?>

                          <li><a href="login.php">LOGIN</a></li>
                          <?php } ?>

                            
                
                </div>  
                </li>
                        </ul>
                    </div>
            </div>
        </div>
    </div>
    <!-- header section end -->

    <div id="taxis" class="taxis_section layout_padding">

      <div class="container" style="padding: 6%;">
     
        <h1 class="our_text">Update<span style="color: #f4db31;"> &nbsp;Car Information</span></h1>
        <div class="taxis_section_2" >
          

<form method="post" action="" style="padding: 20px; border: 2px solid yellow;">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Vechicle Model</label>
      <input type="text" class="form-control"  value="<?php echo $res['model'];?>" name="model"required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Vehicle Number</label>
      <input type="text" class="form-control"  value="<?php echo $res['vehicle_number'];?>" name="vehicle_number"required>
    </div>
   <div class="form-group col-md-6">
      <label for="inputEmail4">Seating Capacity</label>
      <input type="number" class="form-control"  value="<?php echo $res['capacity'];?>" name="capacity" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Rent Per Day (in Rs.)</label>
      <input type="number" class="form-control" value="<?php echo $res['rent'];?>"  name="rent" required>
    </div>
  </div>

  <center><button type="submit" class="btn btn-warning" style="width:20%" name="submit">Update information</button></center>
</form>

          
        </div>
      </div>
    </div>



     <!-- section footer start -->
     <div class="section_footer ">
      <div class="container"> 
          <div class="footer_section_2">
            <center><div class="text" style="color:white; font-style: oblique; font-size:20px">Created By Shubh Sinha &#128515;</div></center>
          </div>
          </div>
      </div>
  <!-- section footer end -->
  <!-- copyright section start -->
  <div class="copyright_section">
    <div class="container">
      
    </div>
  </div>

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript --> 
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
    $(document).ready(function(){
    $(".fancybox").fancybox({
    openEffect: "none",
    closeEffect: "none"
    });
       
    $(".zoom").hover(function(){
         
    $(this).addClass('transition');
    }, function(){
         
    $(this).removeClass('transition');
    });
    });
    </script> 
    <script>
    function openNav() {
    document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
   document.getElementById("myNav").style.width = "0%";
   }
</script>   
</body>
</html>
