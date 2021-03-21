<?php
session_start();
@$R = $_SESSION["Random"];
echo "<script type='text/javascript'>alert('the code random is $R');</script>";
if(isset($R)){
    @$C = $_POST['Code'];
    if(isset($C) && $R == $C){
        $FirstName = $_SESSION["FirstName"];
        $LastName = $_SESSION["LastName"];
        $Email = $_SESSION["Email"];
        $City = $_SESSION["City"];
        $State = $_SESSION["State"];
        $Zip = $_SESSION["Zip"];
        $Subject = $_SESSION["Subject"];
        $Message = $_SESSION["Message"];
        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
        @$db = mysql_select_db("project")or die("error to connect to database");
        $q = mysql_query("select * from contact where First_Name = '$FirstName' and Last_Name = '$LastName' and Email = '$Email' and 
        City = '$City' and State = '$State' and Zip = '$Zip' and Subject = '$Subject' and Message = '$Message'");
        $n = mysql_num_rows($q);
        if($n == 0){
            $query = mysql_query("insert into contact(First_Name,Last_Name,Email,City,State,Zip,Subject,Message) values ('$FirstName','$LastName','$Email','$City','$State','$Zip','$Subject','$Message')");
            mysql_close($con);
        }
        session_destroy();
        header('Location: index.php');
    }
}
else{
    $Subject = $_SESSION["Subject"];
    $Email = $_SESSION["Email"];
    $Random = rand(10000,99999);
    mail($Email , $Subject ,$Random);
    $_SESSION["Random"] = "$Random";
    echo "<script type='text/javascript'>alert('the code random is $Random');</script>";
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="UTF-8"/>
        <meta name="description" content="Welcome to Healthycare site"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <title>Healthy care</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/animate.css"/>
        <link rel="stylesheet" href="css/main.css" />
        

    </head>
    
<body>
    
    
            
        
        <!-- ==================== brand ====================  -->
        <div class="header-brand">
        <div class="container">
            <div class="row">
                
                <div class="col-md-7">
                    <a class="navbar-brand" href="index.php">
                        <img src="favicon2.png" width="100px" class="wow zoomInDown"/>
                        <span class="wow fadeInDownBig">Healthy Care</span>
                    </a>
                </div>
                            

                <div class="col-md-2 d-flex align-items-center wow bounceInRight">
                    <div class="phone">
                        
                        <!-- icon -->
                        <span class="icon"><i class="fa fa-phone fa-2x" aria-hidden="true"></i></span>
                        <!-- desc -->
                        <span class="desc">
                        <a href="#">111-222-333</a><br><a href="#">19-222-333</a>
                        </span>
                        
                    </div>
                </div>
                
                <div class="col-md-3 d-flex align-items-center wow bounceInRight" data-wow-delay=".4s">
                    <div class="phone">
                        
                        <!-- icon -->
                        <span class="icon"><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i></span>
                        <!-- desc -->
                        <span class="desc">
                            <a href="#">35 Salah-Salem Street,</a><br> <a href="#">Tower Building 6rd floor</a>     
                        </span>
                        
                    </div>
                </div>
                
            </div>
        </div>
        </div>
        <!-- ==================== brand ====================  -->

        
        
        <!-- ==================== Start Navbar ====================  -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <div class="row">
                
                
                    <!-- Dropdown -->
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                    <!-- Navigation -->
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">


                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                        </li>

                        
                        <li class="nav-item">
                        <a class="nav-link" href="doctors.html">Doctors</a>
                        </li>
                        
                        
                        <li class="nav-item">
                        <a class="nav-link" href="services.html">Services</a>
                        </li>

                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="departments.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Departments
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="Surgery-department.html">Surgery Department</a>
                          <a class="dropdown-item" href="orthopedic-department.html">Orthopedic Department</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="dental-department.html">Dental Department</a>
                        </div>
                        </li>
                          
                        <li class="nav-item">
                        <a class="nav-link" href="appointments.html">Appointment</a>
                        </li>
                        
                        <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                  
                    </ul>
                  </div>
                    
                </div>
                                
            </div>
        </nav>
        <!-- ==================== End Navbar ====================  -->

    
    
    
    <!-- ========== form ========== -->
    <div class="form-info" style="margin-top:100px;">
        <div class="container d-flex justify-content-center">
            
            <form action="SendMessage.php" method="post" class="col-md-6" style="border:1px solid #DDD;background-color:#f0f5f8;border-radius:15px;">
                
                <div class="form-row">
                        <strong class="col" style="font-size:24px;color:rgba(0, 0, 0, 0.5);border-bottom:2px solid #DDD;padding:20px 0;">Confirmation Code</strong>
                </div>
                                
                <div class="form-row" style="padding:50px 0 20px 0;">
                    <div class="form-group col-10">
                        <label>Enter The Code Send To Your Email</label>
                        <input type="text" placeholder="Confirmation Code" name="Code" class="col form-control form-control-sm">
                    </div>
                </div>                
                
                <div class="form-row justify-content-center">
                    <div class="form-group col-4">
                        <button type="submit" class="btn btn-success btn-lg btn col">Send</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <!-- ========== form ========== -->

      
    
    
    
    

        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>new WOW().init();</script>
        <script src="js/main.js"></script>

    </body>
</html>