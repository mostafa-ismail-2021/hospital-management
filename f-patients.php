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
            
        
            @$PatientSend = $_POST["PatientSend"];
            @$PatientShow = $_POST["PatientShow"];
            @$PatientDelete = $_POST["PatientDelete"];
            @$PatientSelect = $_POST["PatientSelect"];
            @$PatientUpdate = $_POST["PatientUpdate"];
            if(isset($PatientSend)){
                $PatientName = $_POST["Patient_Name"];
                $PatientPhone = $_POST["Patient_Phone"];
                $PatientAddress = $_POST["Patient_Address"];
                $PatientPhone = CheckPhone($PatientPhone);
                $Repeat = CheckRepeat($PatientName,$PatientPhone,$PatientAddress);
                if($Repeat == true){
                if($PatientName != "" && $PatientPhone != "" && $PatientAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("insert into patient(patient_name,patient_phone,patient_address) values ('$PatientName','$PatientPhone','$PatientAddress')");
                    $id = GetId($PatientName,$PatientPhone,$PatientAddress);
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data added successfuly and the id is $id');</script>";
                }
                else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
            }
            elseif(isset($PatientDelete)){
                $PatientName = $_POST["Patient_Name"];
                $PatientPhone = $_POST["Patient_Phone"];
                $PatientAddress = $_POST["Patient_Address"];
                if($PatientName == "" && $PatientPhone == "" && $PatientAddress == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                elseif($PatientName != "" && $PatientPhone == "" && $PatientAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_name = '$PatientName'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($PatientName == "" && $PatientPhone != "" && $PatientAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_phone = '$PatientPhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($PatientName == "" && $PatientPhone == "" && $PatientAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_address = '$PatientAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($PatientName != "" && $PatientPhone != "" && $PatientAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_name = '$PatientName' and patient_phone = '$PatientPhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($PatientName != "" && $PatientPhone == "" && $PatientAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_name = '$PatientName' and 
                    patient_address = '$PatientAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($PatientName == "" && $PatientPhone != "" && $PatientAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_phone = '$PatientPhone' and 
                    patient_address = '$PatientAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($PatientName != "" && $PatientPhone != "" && $PatientAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from patient where patient_name = '$PatientName' and patient_phone = '$PatientPhone' 
                    and patient_address = '$PatientAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
            }
            elseif(isset($PatientUpdate)){
                $PatientName = $_POST["Patient_Name"];
                $PatientPhone = $_POST["Patient_Phone"];
                $PatientAddress = $_POST["Patient_Address"];
                $Update = $_POST["Update"];
                if($Update == "PatientName"){
                    if($PatientName == "" || $PatientPhone == "" && $PatientAddress == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the name field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($PatientPhone != "" && $PatientAddress == ""){
                            $q = mysql_query("UPDATE patient set patient_name = '$PatientName' where
                            patient_phone = '$PatientPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($PatientPhone == "" && $PatientAddress != ""){
                            $q = mysql_query("UPDATE patient set patient_name = '$PatientName' where
                            patient_address = '$PatientAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($PatientPhone != "" && $PatientAddress != ""){
                            $q = mysql_query("UPDATE patient set patient_name = '$PatientName' where
                            patient_phone = '$PatientPhone' and patient_address = '$PatientAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }  
                }
                elseif($Update == "PatientPhone"){
                    if($PatientPhone == "" || $PatientName == "" && $PatientAddress == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Phone field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($PatientName != "" && $PatientAddress == ""){
                            $q = mysql_query("UPDATE patient set patient_phone = '$PatientPhone' where
                            patient_name = '$PatientName'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($PatientName == "" && $PatientAddress != ""){
                            $q = mysql_query("UPDATE patient set patient_phone = '$PatientPhone' where
                            patient_address = '$PatientAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($PatientName != "" && $PatientAddress != ""){
                            $q = mysql_query("UPDATE patient set patient_phone = '$PatientPhone' where
                            patient_name = '$PatientName' and patient_address = '$PatientAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "PatientAddress"){
                    if($PatientAddress == "" || $PatientName == "" && $PatientPhone == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Address field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($PatientName != "" && $PatientPhone == ""){
                            $q = mysql_query("UPDATE patient set patient_address = '$PatientAddress' where
                            patient_name = '$PatientName'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($PatientName == "" && $PatientPhone != ""){
                            $q = mysql_query("UPDATE patient set patient_address = '$PatientAddress' where
                            patient_phone = '$PatientPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($PatientName != "" && $PatientPhone != ""){
                            $q = mysql_query("UPDATE patient set patient_address = '$PatientAddress' where
                            patient_name = '$PatientName' and patient_phone = '$PatientPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }   
                }
            }
            function show(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from patient");
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
                        $id = mysql_result($q,$i,"patient_id");
                        $name = mysql_result($q,$i,"patient_name");
                        $phone = mysql_result($q,$i,"patient_phone");
                        $address = mysql_result($q,$i,"patient_address");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$name</td> <td style='border: 2px solid #ddd; padding:10px'>$phone</td> <td style='border: 2px solid #ddd; padding:10px'>$address</td> </tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
                }
            function select(){
                $PatientName = $_POST["Patient_Name"];
                $PatientPhone = $_POST["Patient_Phone"];
                $PatientAddress = $_POST["Patient_Address"];
                if($PatientName == "" && $PatientPhone == "" && $PatientAddress == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($PatientName != "" && $PatientPhone == "" && $PatientAddress == ""){
                        $q = mysql_query("select * from patient where patient_name = '$PatientName'");
                    }  
                    elseif($PatientName == "" && $PatientPhone != "" && $PatientAddress == ""){
                        $q = mysql_query("select * from patient where patient_phone = '$PatientPhone'");
                    }
                    elseif($PatientName == "" && $PatientPhone == "" && $PatientAddress != ""){
                        $q = mysql_query("select * from patient where patient_address = '$PatientAddress'");
                    }
                    elseif($PatientName != "" && $PatientPhone != "" && $PatientAddress == ""){
                        $q = mysql_query("select * from patient where patient_name = '$PatientName' and patient_phone = '$PatientPhone'");
                    }
                    elseif($PatientName != "" && $PatientPhone == "" && $PatientAddress != ""){
                        $q = mysql_query("select * from patient where patient_name = '$PatientName' and 
                        patient_address = '$PatientAddress'");
                    }
                    elseif($PatientName == "" && $PatientPhone != "" && $PatientAddress != ""){
                        $q = mysql_query("select * from patient where patient_phone = '$PatientPhone' and 
                        patient_address = '$PatientAddress'");
                    }
                    elseif($PatientName != "" && $PatientPhone != "" && $PatientAddress != ""){
                        $q = mysql_query("select * from patient where patient_name = '$PatientName' and 
                        patient_phone = '$PatientPhone' and patient_address = '$PatientAddress'");
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
                            $id = mysql_result($q,$i,"patient_id");
                            $name = mysql_result($q,$i,"patient_name");
                            $phone = mysql_result($q,$i,"patient_phone");
                            $address = mysql_result($q,$i,"patient_address");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$name</td> <td style='border: 2px solid #ddd; padding:10px'>$phone</td> <td style='border: 2px solid #ddd; padding:10px'>$address</td> </tr>";
                        }
                        
                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
            function CheckRepeat($PatientName,$PatientPhone,$PatientAddress){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from patient where patient_name = '$PatientName' and 
                    patient_phone = '$PatientPhone' and patient_address = '$PatientAddress'");
                $n = mysql_num_rows($q);
                if($n == 0)
                    return true;
                else
                    return false;
            }
            function GetId($PatientName,$PatientPhone,$PatientAddress){
                $q = mysql_query("select patient_id from patient where patient_name = '$PatientName' and 
                    patient_phone = '$PatientPhone' and patient_address = '$PatientAddress'");
                $id = mysql_result($q,0,"patient_id");
                return $id;
            }
            function CheckPhone($Field){
                $Len = strlen($Field);
                if($Len != 11){
                    echo "<script type='text/javascript'>alert('the phone must have 11 numbers');</script>";
                    return "";
                }
                else{
                
                    if($Field == ""){
                        return "";
                    }
                    else{
                        for($i = 0 ; $i < $Len ; $i++){
                            if($Field[$i] == "0"){}
                            
                            elseif($Field[$i] == "1"){}
                            
                            elseif($Field[$i] == "1"){}
                            
                            elseif($Field[$i] == "2"){}
                            
                            elseif($Field[$i] == "3"){}
                            
                            elseif($Field[$i] == "4"){}
                            
                            elseif($Field[$i] == "5"){}
                            
                            elseif($Field[$i] == "6"){}
                            
                            elseif($Field[$i] == "7"){}
                            
                            elseif($Field[$i] == "8"){}

                            elseif($Field[$i] == "9"){}
                            
                            else{
                                return "";
                            }
                        }
                    return $Field;
                    }
                }
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
                    
                <form class="col" action="f-patients.php" method="post">
                    
                    
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
                          <label>Patient Name</label>
                          <input type="text" class="form-control" id="" placeholder="Patient name" name="Patient_Name">
                        </div>
                    </div>
                    
                    
                    
                                        
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Patient Phone</label>
                          <input type="text" class="form-control" id="" placeholder="Patient phone" name="Patient_Phone">
                        </div>
                    </div>
       
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Patient Address</label>
                          <input type="text" class="form-control" id="" placeholder="Patient address" name="Patient_Address">
                        </div>
                    </div>

                    
                    
                    
                    <div class="form-row justify-content-center">
                        
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-primary btn-lg" name="PatientSelect">Select</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-dark btn-lg" name="PatientShow">Show</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-success btn-lg" name="PatientSend">Insert</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-danger btn-lg" name="PatientDelete">Remove</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-warning btn-lg col" name="PatientUpdate">Update</button>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-2 offset-9">
                            <select name="Update" class="custom-select">
                                <option value="PatientName" selected>PatientName</option><option value="PatientPhone">PatientPhone</option><option value="PatientAddress">PatientAddress</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    
               </form>
      
            </div>
        </div>
        <?php
            if(isset($PatientShow)){
                show();
            }
            elseif(isset($PatientSelect)){
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
                height="1157px"
                src="rel-patients.php">
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