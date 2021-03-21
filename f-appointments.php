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
        <?php
            @$AppointmentSend = $_POST["AppointmentSend"];
            @$AppointmentShow = $_POST["AppointmentShow"];
            @$AppointmentDelete = $_POST["AppointmentDelete"];
            @$AppointmentSelect = $_POST["AppointmentSelect"];
            @$AppointmentUpdate = $_POST["AppointmentUpdate"];
            if(isset($AppointmentSend)){
                $AppointmentDate = $_POST["Appointment_Date"];
                $AppointmentType = $_POST["Appointment_Type"];
                $AppointmentDoctor = $_POST["Appointment_Doctor"];
                $Repeat = CheckRepeat($AppointmentDate,$AppointmentType,$AppointmentDoctor);
                if($Repeat == true){
                    if($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into appointments(app_date,app_type,app_doctors) values ('$AppointmentDate','$AppointmentType','$AppointmentDoctor')");
                        $id = GetId($AppointmentDate,$AppointmentType,$AppointmentDoctor);
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data added successfuly and the id is $id');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
            }
            elseif(isset($AppointmentDelete)){
                $AppointmentDate = $_POST["Appointment_Date"];
                $AppointmentType = $_POST["Appointment_Type"];
                $AppointmentDoctor = $_POST["Appointment_Doctor"];
                if($AppointmentDate == "" && $AppointmentType == "" && $AppointmentDoctor == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                elseif($AppointmentDate != "" && $AppointmentType == "" && $AppointmentDoctor == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_date = '$AppointmentDate'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($AppointmentDate == "" && $AppointmentType != "" && $AppointmentDoctor == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_type = '$AppointmentType'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($AppointmentDate == "" && $AppointmentType == "" && $AppointmentDoctor != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_doctors = '$AppointmentDoctor'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_date = '$AppointmentDate' and 
                    app_type = '$AppointmentType'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($AppointmentDate != "" && $AppointmentType == "" && $AppointmentDoctor != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_date = '$AppointmentDate' and 
                    app_doctors = '$AppointmentDoctor'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($AppointmentDate == "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_type = '$AppointmentType' and 
                    app_doctors = '$AppointmentDoctor'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from appointments where app_date = '$AppointmentDate' and app_type = '$AppointmentType' 
                    and app_doctors = '$AppointmentDoctor'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
            }
            elseif(isset($AppointmentUpdate)){
                $AppointmentDate = $_POST["Appointment_Date"];
                $AppointmentType = $_POST["Appointment_Type"];
                $AppointmentDoctor = $_POST["Appointment_Doctor"];
                $Update = $_POST["Update"];
                if($Update == "AppointmentDate"){
                    if($AppointmentDate == "" || $AppointmentType == "" && $AppointmentDoctor == ""){
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Date field and one field at least of other');</script>";
                    }
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($AppointmentType != "" && $AppointmentDoctor == ""){
                            $q = mysql_query("UPDATE appointments set app_date = '$AppointmentDate' where
                            app_type = '$AppointmentType'");
                        }
                        elseif($AppointmentType == "" && $AppointmentDoctor != ""){
                            $q = mysql_query("UPDATE appointments set app_date = '$AppointmentDate' where
                            app_doctors = '$AppointmentDoctor'");
                        }
                        elseif($AppointmentType != "" && $AppointmentDoctor != ""){
                            $q = mysql_query("UPDATE appointments set app_date = '$AppointmentDate' where
                            app_type = '$AppointmentType' and app_doctors = '$AppointmentDoctor'");
                        }
                        mysql_close($con);
                    }
                        
                        
                }
                elseif($Update == "AppointmentType"){
                    if($AppointmentType == "" || $AppointmentDate == "" && $AppointmentDoctor == ""){
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Type field and one field at least of other');</script>";
                }
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($AppointmentDate != "" && $AppointmentDoctor == ""){
                            $q = mysql_query("UPDATE appointments set app_type = '$AppointmentType' where
                            app_date = '$AppointmentDate'");
                        }
                        elseif($AppointmentDate == "" && $AppointmentDoctor != ""){
                            $q = mysql_query("UPDATE appointments set app_type = '$AppointmentType' where
                            app_doctors = '$AppointmentDoctor'");
                        }
                        elseif($AppointmentDate != "" && $AppointmentDoctor != ""){
                            $q = mysql_query("UPDATE appointments set app_type = '$AppointmentType' where
                            app_date = '$AppointmentDate' and app_doctors = '$AppointmentDoctor'");
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "AppointmentDoctor"){
                    if($AppointmentDoctor == "" || $AppointmentDate == "" && $AppointmentType == ""){
                        echo"";
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Doctor field and one field at least of other');</script>";
                    }
                        
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($AppointmentDate != "" && $AppointmentType == ""){
                            $q = mysql_query("UPDATE appointments set app_doctors = '$AppointmentDoctor' where
                            app_date = '$AppointmentDate'");
                        }
                        elseif($AppointmentDate == "" && $AppointmentType != ""){
                            $q = mysql_query("UPDATE appointments set app_doctors = '$AppointmentDoctor' where
                            app_type = '$AppointmentType'");
                        }
                        elseif($AppointmentDate != "" && $AppointmentType != ""){
                            $q = mysql_query("UPDATE appointments set app_doctors = '$AppointmentDoctor' where
                            app_date = '$AppointmentDate' and app_type = '$AppointmentType'");
                        }
                        mysql_close($con);
                    }   
                }
            }
            function show(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from appointments");
                $n = mysql_num_rows($q);
                
                if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                else{
                    echo"<div style='overflow-y:auto; height:300px'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                    margin-left:35%'>";
                    echo"<tr>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                    echo"</tr>";
                    
                    
                    for($i=0;$i<$n;$i++){
                        $id = mysql_result($q,$i,"app_id");
                        $date = mysql_result($q,$i,"app_date");
                        $type = mysql_result($q,$i,"app_type");
                        $doctors = mysql_result($q,$i,"app_doctors");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$date</td> <td style='border: 2px solid #ddd; padding:10px'>$type</td> <td style='border: 2px solid #ddd; padding:10px'>$doctors</td> </tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
                }
            function select(){
                $AppointmentDate = $_POST["Appointment_Date"];
                $AppointmentType = $_POST["Appointment_Type"];
                $AppointmentDoctor = $_POST["Appointment_Doctor"];
                if($AppointmentDate == "" && $AppointmentType == "" && $AppointmentDoctor == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($AppointmentDate != "" && $AppointmentType == "" && $AppointmentDoctor == ""){
                        $q = mysql_query("select * from appointments where app_date = '$AppointmentDate'");
                    }  
                    elseif($AppointmentDate == "" && $AppointmentType != "" && $AppointmentDoctor == ""){
                        $q = mysql_query("select * from appointments where app_type = '$AppointmentType'");
                    }
                    elseif($AppointmentDate == "" && $AppointmentType == "" && $AppointmentDoctor != ""){
                        $q = mysql_query("select * from appointments where app_doctors = '$AppointmentDoctor'");
                    }
                    elseif($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor == ""){
                        $q = mysql_query("select * from appointments where app_date = '$AppointmentDate' and 
                        app_type = '$AppointmentType'");
                    }
                    elseif($AppointmentDate != "" && $AppointmentType == "" && $AppointmentDoctor != ""){
                        $q = mysql_query("select * from appointments where app_date = '$AppointmentDate' and 
                        app_doctors = '$AppointmentDoctor'");
                    }
                    elseif($AppointmentDate == "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                        $q = mysql_query("select * from appointments where app_type = '$AppointmentType' and 
                        app_doctors = '$AppointmentDoctor'");
                    }
                    elseif($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                        $q = mysql_query("select * from appointments where app_date = '$AppointmentDate' and 
                        app_type = '$AppointmentType' and app_doctors = '$AppointmentDoctor'");
                    }
                    $n = mysql_num_rows($q);
                    if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                        margin-left:35%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"</tr>";
                        
                    
                        for($i=0;$i<$n;$i++){
                            $id = mysql_result($q,$i,"app_id");
                            $date = mysql_result($q,$i,"app_date");
                            $type = mysql_result($q,$i,"app_type");
                            $doctors = mysql_result($q,$i,"app_doctors");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$date</td> <td style='border: 2px solid #ddd; padding:10px'>$type</td> <td style='border: 2px solid #ddd; padding:10px'>$doctors</td> </tr>";
                        }
                        
                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
            function CheckRepeat($AppointmentDate,$AppointmentType,$AppointmentDoctor){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from appointments where app_date = '$AppointmentDate' and 
                        app_type = '$AppointmentType' and app_doctors = '$AppointmentDoctor'");
                $n = mysql_num_rows($q);
                if($n == 0)
                    return true;
                else
                    return false;
            }
        function GetId($AppointmentDate,$AppointmentType,$AppointmentDoctor){
                $q = mysql_query("select app_id from appointments where app_date = '$AppointmentDate' and 
                    app_type = '$AppointmentType' and app_doctors = '$AppointmentDoctor'");
                $id = mysql_result($q,0,"app_id");
                return $id;
            }
        ?>

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



        
        <!-- ==================== start form-info ====================  -->        
        <div class="form-info">
            <div class="container">
                    
                <form class="col" action="f-appointments.php" method="post">

                    
                    
                    <!-- search -->
                    <div class="form-row  justify-content-md-end">
                        <div class="form-group">
                            
                            <div class="search-box">
                               <a href="#" class="col d-inline">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                               </a>
                               <input type="text" name="" class="search-txt col" placeholder="Search  . . ."/>
                            </div>
                            
                        </div>
                    </div>
                    
                    

                    <div class="form-row">
                        <div class="form-group col">
                          <label>Appointment Date</label>
                          <input type="date" class="form-control" id="" placeholder="Appointment date" name="Appointment_Date">
                        </div>
                    </div>
                    
                    
                    
                                        
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Appointment Type</label>
                          <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="Appointment_Type">
                            <option selected value="">Choose ...</option>
                            <option value="1">app1</option>
                            <option value="2">app2</option>
                          </select>
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Appointment Doctor</label>
                          <input type="text" class="form-control" id="" placeholder="Appointment doctor" name="Appointment_Doctor">
                        </div>
                    </div>

                    
                    
                    
       
                    
                    
                    <div class="form-row justify-content-md-center">
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-primary btn-lg" name="AppointmentSelect">Select</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-dark btn-lg" name="AppointmentShow">Show</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-success btn-lg" name="AppointmentSend">Insert</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-danger btn-lg" name="AppointmentDelete">Remove</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-warning btn-lg col" name="AppointmentUpdate">Update</button>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-2 offset-9">
                            <select name="Update" class="custom-select">
                                <option value="AppointmentDate" selected>AppointmentDate</option><option value="AppointmentType">AppointmentType</option><option value="AppointmentDoctor">AppointmentDoctor</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
               </form>
      
            </div>
        </div>
        <?php
            if(isset($AppointmentShow)){
                show();
            }
            elseif(isset($AppointmentSelect)){
                select();
            }
        ?>
        <!-- ==================== End form-info ====================  -->
        
        
            
            
            
        <!-- ======================================== iframe ========================================  -->
        <div class="container">    
        <!-- i-frame -->
        <iframe id="inlineFrameExample"
                title="Inline Frame Example"
                width="100%"
                height="557px"
                src="rel-appointments.php">
        </iframe>
        <!-- i-frame -->
        </div>
        <!-- ======================================== iframe ========================================  -->
            
            
            
        
        
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

    </body>
</html>