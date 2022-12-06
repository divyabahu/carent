<?php 
  error_reporting(0);
  session_start();
  include("connection.php");

  if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql="SELECT * FROM user where username='".$username."' AND password='".$password."'";
    $result=mysqli_query($connection, $sql);
    $count=mysqli_num_rows($result);
    if($count>0){
      $row=mysqli_fetch_assoc($result);
      $_SESSION['type']=$row['type'];
      $_SESSION['IS_LOGIN']='yes';
      if($row['type'] == 'agency'){
        $_SESSION["username"]=$username;
      header("location:availrent.php?id=$username");

      }
      elseif($row['type'] == 'user'){
        $_SESSION["username"]=$username;
      header("location:availrent.php?id=$username");

      }
          else{
      echo "<script>alert('Wrong Credintals')</script>";
    }
    }
    else{
      echo "<script>alert('Wrong Credintals')</script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carRent || Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>caRent</title>
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


<body style="background-image: url('images/background.gif'); background-repeat: no-repeat; background-size: cover;">
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
    <!-- header section end -->

    <div class="login-dark">
        <form action="" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="username" required></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="login">Log In</button></div><a href="#" class="forgot">Forgot your email or password?</a></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>