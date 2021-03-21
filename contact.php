<?php 
@$Random = $_POST['Random'];
@$Code = $_POST['Code'];
@$FirstName = $_POST['FirstName'];
@$LastName = $_POST['LastName'];
@$Email = $_POST['Email'];
@$City = $_POST['City'];
@$State = $_POST['State'];
@$Zip = $_POST['Zip'];
@$Subject = $_POST['Subject'];
@$Message = $_POST['Message'];
if(isset($Random) && isset($Code) && $Random == $Code && $FirstName != "" && $LastName != "" && $City != "" && $State != "" 
   && $Zip != "" && $Subject != "" && $Message != ""){
    session_start();
    $_SESSION["FirstName"] = "$FirstName";
    $_SESSION["LastName"] = "$LastName";
    $_SESSION["Email"] =    "$Email";
    $_SESSION["City"] =     "$City";
    $_SESSION["State"] = "$State";
    $_SESSION["Zip"] = "$Zip";
    $_SESSION["Subject"] = "$Subject";
    $_SESSION["Message"] = "$Message";
    header('Location: SendMessage.php');
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

        <div>
        
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



        
        
        <!-- ==================== start contact-slider ====================  -->        
        <div class="contact-slider">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="container">
                        <h1 class="wow fadeInDown" data-wow-delay="1s"> Contact<span> US</span></h1>
                        <h3 class="wow slideInLeft" data-wow-delay="1.5s">Tell us about your issue so we can help you more quickly.</h3>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- ==================== End contact-slider ====================  -->

        
        <!-- ==================== start contact-info ====================  -->        
        <div class="contact-info">
            <div class="container">
                
                <div class="row">
                    <h2 class="col wow fadeInDown" data-wow-offset="250"> Contact Information </h2>
                </div>
                
                <div class="row">
                    <ul class=" col contact-info-icons">
                        <li class="wow fadeInLeft" data-wow-delay="1.2s">
                            <i class="fa fa-location-arrow fa-1x" aria-hidden="true"></i> &nbsp;
                            <span>291 South 21th Street </span> 
                        </li>
                        <li class="wow fadeInLeft" data-wow-delay=".9s">
                            <i class="fa fa-map-marker fa-1x" aria-hidden="true"></i> &nbsp;
                            <span>www.healthycare.com</span>
                        </li>
                        <li class="wow fadeInLeft" data-wow-delay=".6s">
                            <i class="fa fa-phone fa-1x" aria-hidden="true"></i> &nbsp;
                            <span> + 1235 2355 98</span>
                        </li>
                        <li class="wow fadeInLeft" data-wow-delay=".3s">
                            <i class="fa fa-envelope fa-1x" aria-hidden="true"></i> &nbsp;
                            <!-- <a href="#">info@healthycare.com</a>  -->
                            <span> info@healthycare.com</span>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        <!-- ==================== End contact-info ====================  -->
        
            
            
            
        <!-- ==================== start form-info ====================  -->        
        <div class="form-info">
            <div class="container">
                    
                <form class="col" action="contact.php" method="post">


                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>First Name</label>
                          <input type="text" class="form-control" id="inputfirstname4" placeholder="Your first name" name="FirstName">
                        </div>
                        <div class="form-group col-md-6">
                          <label>Last Name</label>
                          <input type="text" class="form-control" id="inputlastname4" placeholder="Your last name" name="LastName">
                        </div>
                    </div>
                    
                    <div class="form-row ">
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Your email address" name="Email">
                        </div>
                    </div>
        
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label>City</label>
                          <input type="text" class="form-control" placeholder="Your city" name="City">
                        </div>
                        <div class="form-group col-md-4">
                          <label>State</label>
                            <input type="text" class="form-control" placeholder="Your state" name="State">
                        </div>
                        <div class="form-group col-md-2">
                          <label>Zip</label>
                          <input type="text" class="form-control" placeholder="Your zip" name="Zip">
                        </div>
                    </div>
                    
                    <div class="form-row ">
                        <div class="form-group col-md-6">
                            <label>Captcha Code</label>
                            <input type="text" class="form-control" disabled value='<?php $n = rand(10000,99999);echo"$n"; ?>'>
                            <input type="text" class="form-control" style="display:none" value='<?php echo"$n"; ?>' name="Random">
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label>Enter Captcha Code</label>
                            <input type="text" class="form-control" placeholder="Enter the code you see in the left" name="Code">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Subject</label>
                            <input type="text" class="form-control" id="inputsubject4" placeholder="Your subject of this Message" name="Subject">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Message</label>
                            <textarea class="form-control" id="Textarea4" rows="10" placeholder="Write your message . . ." name="Message"></textarea>
                        </div>
                    </div>
                    
                    
                    <div class="form-row justify-content-center">
                        <div class="form-group col-3">
                            <button type="submit" class="btn btn-success btn-lg btn" name="Contact">Send Message</button>
                        </div>
                    </div>

                        
               </form>
      
            </div>
        </div>
        <!-- ==================== End form-info ====================  -->
        
        
        
        <!-- ==================== start team-show ====================  -->
        <div class="team-show">    
            <div class="container-fluid wow fadeInUp" data-wow-duration="1.5s" data-wow-offset="250">
                <div class="row">

                    <img src="images/home/team2.png"/>

                </div>
            </div>
        </div>
        <!-- ==================== End team-show ====================  -->
        
        
        <!-- ==================== start footer ====================  -->
        <footer>
            <div class="container-fluid">
                <div class="row justify-content-between">
                    
                    <div class="footer-info col-md-4">
                        <h2><a class="footer-brand" href="#"><span>Healthy</span><span>Care</span></a></h2>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                    </div>
                    
                    <div class="footer-contact col-md-3">
                        <h2>Contact</h2>
                        <div class="contact-desc">
                            <i class="fa fa-location-arrow fa-1x" aria-hidden="true"></i>
                            <span>291 South 21th Street </span> <br>
                            <i class="fa fa-map-marker fa-1x" aria-hidden="true"></i>
                            <span>www.healthycare.com</span> <br>
                            <i class="fa fa-phone fa-1x" aria-hidden="true"></i>
                            <span>+98 229 2355</span> <br>
                            <i class="fa fa-envelope fa-1x" aria-hidden="true"></i>
                             <a href="#">info@healthycare.com</a>  
                        </div>

                    </div>

                    <div class="footer-form col-md-4">
                        <h2>Make an Appointment</h2>
                        <div class="appointment-message">                        
                            
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                      <input type="text" class="form-control" id="inputfirstname4" placeholder="Name">
                                    </div>
                                </div>

                                <div class="form-row ">
                                    <div class="form-group col-md-10">
                                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <textarea class="form-control" id="Textarea4" rows="4" cols="60" placeholder="Message"></textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <button type="button" class="btn btn-outline-success">Send Message</button>
                                    </div>
                                </div>
                           </form>
                            
                        </div>
                    </div>


                </div>
            </div>
        </footer>
        <!-- ==================== End footer ====================  -->

        
        
        
        <!-- ==================== start copyright ====================  -->
        <div class="copyright">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <h5>Copyright &copy; 2019 All rights reserved </h5>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <a class="youtube" href="www.youtube.com">
                        <i class="fa fa-youtube-play fa-2x" aria-hidden="true"></i>
                        </a>
                        <a class="facebook" href="www.facebook.com">
                        <i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
                        </a>
                        <a class="twitter" href="www.twitter.com">
                        <i class="fa fa-twitter fa-2x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ==================== End copyright ====================  -->

        </div>

        
        

        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>new WOW().init();</script>
        <script src="js/main.js"></script>

    </body>
</html>