<?php
   //Session Started
    session_start();
    error_reporting(0);
  include("connection.php");
?>

<!--This is page for both user and agency but user can view user booked cars while registred agency will see All booked Cars-->
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

<!-- If Agency Logged in header will be Booked Cars-->
<?php if($_SESSION['type']=='agency'){?>
        <title>caRent || Booked Cars</title>
<!-- if user logged in header will be My booked cars-->
<?php } 
      elseif($_SESSION['type']=='user'){?>
        <title>caRent || My Booked Cars</title>
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

    <div id="index.html" class="header_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                  <!-- Different Values Same IN same page for  User and Agency-->
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


    <!-- our Main Body Section section start -->
    <div id="taxis" class="taxis_section layout_padding">

      <div class="container">

        <h1 class="our_text">Booked<span style="color: #f4db31;"> &nbsp;Rentals</span></h1>
        <div class="tablecar">
          

<table class="table table-striped table-dark" style="width:100%">
  <thead>
    <tr>
      <th scope="col" style="visibility: hidden;">Id</th>
      <th scope="col">Vehicle Model</th>
      <th scope="col">Vehicle Number</th>
      <th scope="col">Seating Capicity</th>
      <th scope="col">Rent Per Day (In Rs.)</th>
      <th scope="col">Date Opted</th>
      <th scope="col">Total Number of Days</th>
      <th scope="col">Customer Name</th>
    </tr>
  </thead>
  <tbody>
        <?php
          include 'connection.php';
          if($_SESSION['type']=='agency'){
          $selectquery="SELECT * from booked_vehicle natural join vehicle;";
          }
          if($_SESSION['type']=='user'){
          $username=$_SESSION['username'];
          $selectquery="SELECT * from booked_vehicle natural join vehicle where username='$username';";
          }
          $query=mysqli_query($connection, $selectquery);
          $num=mysqli_num_rows($query);
     
            while($res=mysqli_fetch_array($query)){
        ?>
     
    <tr>
      <td style="visibility: hidden"><?php echo $res["vehicle_id"];?></td>
      <td><?php echo $res["model"];?></td>
      <td><?php echo $res["vehicle_number"];?></td>
      <td><?php echo $res["capacity"];?></td>
      <td><?php echo $res["rent"];?></td>
      <td><?php echo $res["start_date"];?></td>
      <td><?php echo $res["days"];?></td>
      <td><?php echo $res["username"];?></td>

    </tr>

  </tbody>
        <?php 
            } 
        ?>
</table>

          
        </div>
      </div>
    </div>
    <!-- our Available Booked Rentals end -->


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