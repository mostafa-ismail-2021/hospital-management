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
            @$Send = $_POST["Send"];
            @$Show = $_POST["Show"];
            @$Select = $_POST["Select"];
            @$Delete = $_POST["Delete"];
            if(isset($Send)){
                $Email = $_POST["Email"];
                $Text = $_POST["Text"];
                if($Email == "" || $Text == ""){
                    echo"error you must full the fields";
                }
                else{
                    $Email = $_POST["Email"];
                    $Text = $_POST["Text"];
                    mail($Email , "HEALTHYCARE" ,$Text);
                }
            }
            elseif(isset($Delete)){
                        $Id = $_POST["Id"];
                        if($Id == "")
                            echo"error you must full the id input";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("delete from contact where id = '$Id'");
                            mysql_close($con);
                            echo"data deleted successfuly";
                        }
            }

            function show(){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("select * from contact");
                        $n = mysql_num_rows($q);
                        if($n == 0)
                            echo"sorry no record in this table";
                        else{
                            echo"<div style='overflow-y:auto; height:300px'>";
                            echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                            margin-left:35%'>";
                            echo"<tr>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>id</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>First_Name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>Last_Name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>Email</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>City</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>State</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>Zip</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>Subject</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>Message</th>";
                            echo"</tr>";


                            for($i=0;$i<$n;$i++){
                                $id = mysql_result($q,$i,"id");
                                $First_Name = mysql_result($q,$i,"First_Name");
                                $Last_Name = mysql_result($q,$i,"Last_Name");
                                $Email = mysql_result($q,$i,"Email");
                                $City = mysql_result($q,$i,"City");
                                $State = mysql_result($q,$i,"State");
                                $Zip = mysql_result($q,$i,"Zip");
                                $Subject = mysql_result($q,$i,"Subject");
                                $Message = mysql_result($q,$i,"Message");
                                echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td><td style='border: 2px solid #ddd; padding:10px'>$First_Name</td><td style='border: 2px solid #ddd; padding:10px'>$Last_Name</td><td style='border: 2px solid #ddd; padding:10px'>$Email</td><td style='border: 2px solid #ddd; padding:10px'>$City</td><td style='border: 2px solid #ddd; padding:10px'>$State</td> <td style='border: 2px solid #ddd; padding:10px'>$Zip</td> <td style='border: 2px solid #ddd; padding:10px'>$Subject</td> 
                                <td style='border: 2px solid #ddd; padding:10px'>$Message</td>";
                            }

                            echo"</table>";
                            echo"</div>";
                        }

                        mysql_close($con);
                        unset($Show);
            }
            function select(){
                        $Email = $_POST["Email"];
                        if($Email == "")
                            echo"error you must full the Email input";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("select * from contact where Email = '$Email'");
                            $n = mysql_num_rows($q);
                            if($n == 0)
                                echo"sorry no record in this table";
                            else{
                                echo"<div style='overflow-y:auto; height:300px'>";
                                echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                                margin-left:35%'>";
                                echo"<tr>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>id</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>First_Name</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>Last_Name</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>Email</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>City</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>State</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>Zip</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>Subject</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>Message</th>";
                                echo"</tr>";


                                for($i=0;$i<$n;$i++){
                                    $id = mysql_result($q,$i,"id");
                                    $First_Name = mysql_result($q,$i,"First_Name");
                                    $Last_Name = mysql_result($q,$i,"Last_Name");
                                    $Email = mysql_result($q,$i,"Email");
                                    $City = mysql_result($q,$i,"City");
                                    $State = mysql_result($q,$i,"State");
                                    $Zip = mysql_result($q,$i,"Zip");
                                    $Subject = mysql_result($q,$i,"Subject");
                                    $Message = mysql_result($q,$i,"Message");
                                    echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td><td style='border: 2px solid #ddd; padding:10px'>$First_Name</td><td style='border: 2px solid #ddd; padding:10px'>$Last_Name</td><td style='border: 2px solid #ddd; padding:10px'>$Email</td><td style='border: 2px solid #ddd; padding:10px'>$City</td><td style='border: 2px solid #ddd; padding:10px'>$State</td> <td style='border: 2px solid #ddd; padding:10px'>$Zip</td> <td style='border: 2px solid #ddd; padding:10px'>$Subject</td> 
                                    <td style='border: 2px solid #ddd; padding:10px'>$Message</td>";
                                }

                                echo"</table>";
                                echo"</div>";
                            }

                        mysql_close($con);
                        unset($Select);
                    }
            }
        ?>

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

    
    


        <!-- =========== form =========== -->
        <div class="form-info">
            <div class="container">
                <form action="f-contact.php" method="post">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Email</label>
                            <input type="email" name="Email" class="form-control" placeholder="Your email address">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>The Text</label>
                            <input type="text" name="Text" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-row justify-content-md-center">
                        <div class="form-group col-2">
                            <button type="submit" name="Select" class="btn btn-primary btn-lg">Select</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" name="Show" class="btn btn-dark btn-lg">Show</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" name="Send" class="btn btn-success btn-lg">Insert</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" name="Delete" class="btn btn-danger btn-lg col">Remove</button>
                        </div>
                        <div class="form-group col-2">
                            <input type="text" name="Id" placeholder="The id want to delete" class="form-control" style="box-shadow:0 0 0 0.1rem #dc3545;border:none;">
                                <small> use only with remove button</small>
                        </div>
                            <?php
                                    if(isset($Show)){
                                        show();
                                    }
                                    elseif(isset($Select)){
                                        select();
                                    }
                                ?>

                            
                        
                    </div>
                    

                </form>
            </div>
    </div>
        <!-- =========== form =========== -->    


    
    
        
                

        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>new WOW().init();</script>
        <script src="js/main.js"></script>

    </body>
</html>