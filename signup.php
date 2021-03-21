<?php
    @$LogIn = $_POST['LogIn'];
    if(isset($LogIn)){
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
        $db = mysql_select_db("project")or die("error to connect to database");                                         
        $q =mysql_query("select * from admin where Email = '$Email' and Password = '$Password'");
        $n = mysql_num_rows($q);
        if($n != 0){
            $Email = mysql_result($q,0,"Email");
            $admin_type = mysql_result($q,0,"admin_type");
            session_start();
            $_SESSION["Email"] = "$Email";
            $_SESSION["admin_type"] = "$admin_type";
            header('Location: index.php');
        }
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
    
    <body style="perspective: none;background-image:url(images/sign.jpg);
                 background-repeat:no-repeat;background-blend-mode: overlay;
                 background-color: #212427;overflow:hidden;">

        
       <div> 
        
        
        
        <!-- ==================== brand ====================  -->
        <div class="signup-brand">
        <div class="header-brand">
            <div class="container">
                <div class="row">

                    <div class="col-md-7">
                    <a class="navbar-brand" href="index.php">
                            <img src="favicon2.png" width="100px" class="wow zoomInDown"/>
                            <span class="wow fadeInDownBig">Healthy Care</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <!-- ==================== brand ====================  -->


        
        <!-- ==================== signup-form ====================  -->
        <div class="signup-form">

            <form action="signup.php" method="post">

                <div class="form-row wow bounceInLeft" data-wow-delay="1s">
                    <div class="form-group form-group-field col">
                        <!-- <label>Email</label> -->
                        <i class="fa fa-user"></i>
                        <input type="email" class="form-control" id="" placeholder="Email " name="Email">
                    </div>
                </div>


                <div class="form-row wow bounceInRight" data-wow-delay="1s">
                    <div class="form-group form-group-field col">
                        <!-- <label>Password</label> -->
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="" placeholder="Password" name="Password">
                    </div>
                </div>



                <div class="form-row wow bounceInUp" data-wow-delay="1.5s">
                    <div class="form-group form-group-submit col">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="LogIn">Login</button>
                    </div>
                </div>
            </form>       

        </div>
        
        
        <!-- ==================== signup-form ====================  -->
        
        
        

        </div>

        
        
        
        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>new WOW().init();</script>

    </body>
</html>        