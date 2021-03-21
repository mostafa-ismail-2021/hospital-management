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
            @$Delete = $_POST["Delete"];
            @$Select = $_POST["Select"];
            @$Update = $_POST["Update"];
            if(isset($Send)){
                $FirstName = $_POST["FirstName"];
                $LastName = $_POST["LastName"];
                $Email = $_POST["Email"];
                $Password = $_POST["Password"];
                $Address = $_POST["Address"];
                $Repeat = CheckRepeat($FirstName,$LastName,$Email,$Password,$Address);
                if($Repeat == true){
                    if($FirstName != "" && $LastName != "" && $Email != "" && $Password != "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into admin(First_Name,Last_Name,Email,Password,Address,admin_type) values ('$FirstName','$LastName','$Email','$Password','$Address','a')");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
            }
            elseif(isset($Delete)){
                $FirstName = $_POST["FirstName"];
                $LastName = $_POST["LastName"];
                $Email = $_POST["Email"];
                $Password = $_POST["Password"];
                $Address = $_POST["Address"];
                if($FirstName == "" && $LastName == "" && $Email == "" && $Password == "" && $Address != "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    if($Email != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Email = '$Email'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password == "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password == "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Last_Name = '$LastName'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName == "" && $Password != "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Password = '$Password'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName == "" && $Password == "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password == "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and Last_Name = '$LastName'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password != "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and Password = '$Password'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password == "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and 
                        Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password != "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Last_Name = '$LastName' and
                        Password = '$Password'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password == "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Last_Name = '$LastName' and
                        Address = '$Address''");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName == "" && $Password != "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Password = '$Password' and
                        Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password != "" && $Address == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and Last_Name = '$LastName' 
                        and Password = '$Password'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password == "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and Last_Name = '$LastName' 
                        and Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password != "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and Password = '$Password' 
                        and Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password != "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in conne$Addressct to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where Last_Name = '$LastName' and Password = '$Password' 
                        and Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password != "" && $Address != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from admin where First_Name = '$FirstName' and Last_Name = '$LastName' 
                        and Password = '$Password' and Address = '$Address'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                    }
                }
            }
            elseif(isset($Update)){
                $FirstName = $_POST["FirstName"];
                $LastName = $_POST["LastName"];
                $Email = $_POST["Email"];
                $Password = $_POST["Password"];
                $Address = $_POST["Address"];
                $AdminUpdate = $_POST["AdminUpdate"];
                if($AdminUpdate == "FirstName"){
                        if($FirstName == "" || $LastName == "" && $Email == "" && $Password == "" && $Address == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($LastName != "" && $Email == "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email != "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email == "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email == "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email != "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email == "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email == "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email != "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Email = '$Email' and
                                Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email != "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Email = '$Email' and
                                Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email == "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email != "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Email = '$Email' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email != "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Email = '$Email' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email == "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName == "" && $Email != "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Email = '$Email' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($LastName != "" && $Email != "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set First_Name = '$FirstName' where Last_Name = '$LastName' and Email = '$Email' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                        }     
                    }
                elseif($AdminUpdate == "LastName"){
                        if($LastName == "" || $FirstName == "" && $Email == "" && $Password == "" && $Address == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($FirstName != "" && $Email == "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email != "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email == "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email == "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email != "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email == "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email == "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email != "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Email = '$Email' and
                                Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email != "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Email = '$Email' and
                                Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email == "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email != "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Email = '$Email' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email != "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Email = '$Email' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email == "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $Email != "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where Email = '$Email' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $Email != "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Last_Name = '$LastName' where First_Name = '$FirstName' and Email = '$Email' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                        } 
                    }
                elseif($AdminUpdate == "Email"){
                        if($Email == "" || $FirstName == "" && $LastName == "" && $Password == "" && $Address == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($FirstName != "" && $LastName == "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Password == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Password != "" && $Address == ""){;
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Last_Name = '$LastName' and
                                Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Last_Name = '$LastName' and
                                Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Password != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Last_Name = '$LastName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Password == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Last_Name = '$LastName' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where Last_Name = '$LastName' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Password != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Email = '$Email' where First_Name = '$FirstName' and Last_Name = '$LastName' and Password = '$Password' and Address = '$Address'");
                                mysql_close($con);
                            }
                        } 
                    }
                elseif($AdminUpdate == "Password"){
                        if($Password == "" || $FirstName == "" && $LastName == "" && $Email == "" && $Address == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($FirstName != "" && $LastName == "" && $Email == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Email != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where
                                Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Email == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email == "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Email != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Email == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where Last_Name = '$LastName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where Last_Name = '$LastName' and
                                Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Email != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where 
                                Email = '$Email' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email != "" && $Address == ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Last_Name = '$LastName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email == "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Last_Name = '$LastName' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Email != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Email = '$Email' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where Last_Name = '$LastName' and Email = '$Email' and Address = '$Address'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email != "" && $Address != ""){
                                $q = mysql_query("UPDATE admin set Password = '$Password' where First_Name = '$FirstName' and Last_Name = '$LastName' and Email = '$Email' and Address = '$Address'");
                                mysql_close($con);
                            }
                        } 
                    }
                elseif($AdminUpdate == "Address"){
                        if($Address == "" || $FirstName == "" && $LastName == "" && $Email == "" && $Password == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($FirstName != "" && $LastName == "" && $Email == "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email == "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Email != "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where
                                Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Email == "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where 
                                Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email == "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Last_Name = '$LastName'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Email != "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Email == "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email != "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where Last_Name = '$LastName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email == "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where Last_Name = '$LastName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName == "" && $Email != "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where 
                                Email = '$Email' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email != "" && $Password == ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Last_Name = '$LastName' and Email = '$Email'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email == "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Last_Name = '$LastName' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName == "" && $Email != "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Email = '$Email' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName == "" && $LastName != "" && $Email != "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where Last_Name = '$LastName' and Email = '$Email' and Password = '$Password'");
                                mysql_close($con);
                            }
                            elseif($FirstName != "" && $LastName != "" && $Email != "" && $Password != ""){
                                $q = mysql_query("UPDATE admin set Address = '$Address' where First_Name = '$FirstName' and Last_Name = '$LastName' and Email = '$Email' and Password = '$Password'");
                                mysql_close($con);
                            }
                        } 
                    }

                }
            function show(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from admin");
                $n = mysql_num_rows($q);
                
                if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                else{
                    echo"<div style='overflow-y:auto; height:300px'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                    margin-left:35%'>";
                    echo"<tr>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>First_Name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>Last_Name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>Email</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>Password</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>Address</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>admin_type</th>";
                    echo"</tr>";
                    
                    
                    for($i=0;$i<$n;$i++){
                        $First_Name = mysql_result($q,$i,"First_Name");
                        $Last_Name = mysql_result($q,$i,"Last_Name");
                        $Email = mysql_result($q,$i,"Email");
                        $Password = mysql_result($q,$i,"Password");
                        $Address = mysql_result($q,$i,"Address");
                        $admin_type = mysql_result($q,$i,"admin_type");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$First_Name</td> <td style='border: 2px solid #ddd; padding:10px'>$Last_Name</td> <td style='border: 2px solid #ddd; padding:10px'>$Email</td> 
                        <td style='border: 2px solid #ddd; padding:10px'>$Password</td> <td style='border: 2px solid #ddd; padding:10px'>$Address</td><td style='border: 2px solid #ddd; padding:10px'>$admin_type</td></tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
            }
            function select(){
                $FirstName = $_POST["FirstName"];
                $LastName = $_POST["LastName"];
                $Email = $_POST["Email"];
                $Password = $_POST["Password"];
                $Address = $_POST["Address"];
                if($FirstName == "" && $LastName == "" && $Email == "" && $Password == "" && $Address == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($Email != ""){
                        $q = mysql_query("select * from admin where Email = '$Email'");
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password == "" && $Address == ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName'");
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password == "" && $Address == ""){
                        $q = mysql_query("select * from admin where Last_Name = '$LastName'");
                    }
                    elseif($FirstName == "" && $LastName == "" && $Password != "" && $Address == ""){
                        $q = mysql_query("select * from admin where Password = '$Password'");
                    }
                    elseif($FirstName == "" && $LastName == "" && $Password == "" && $Address != ""){
                        $q = mysql_query("select * from admin where Address = '$Address'");
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password == "" && $Address == ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and Last_Name = '$LastName'");
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password != "" && $Address == ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and Password = '$Password'");
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password == "" && $Address != ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and 
                        Address = '$Address'");
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password != "" && $Address == ""){
                        $q = mysql_query("select * from admin where Last_Name = '$LastName' and
                        Password = '$Password'");
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password == "" && $Address != ""){
                        $q = mysql_query("select * from admin where Last_Name = '$LastName' and
                        Address = '$Address'");
                    }
                    elseif($FirstName == "" && $LastName == "" && $Password != "" && $Address != ""){
                        $q = mysql_query("select * from admin where Password = '$Password' and
                        Address = '$Address'");
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password != "" && $Address == ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and Last_Name = '$LastName' 
                        and Password = '$Password'");
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password == "" && $Address != ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and Last_Name = '$LastName' 
                        and Address = '$Address'");
                    }
                    elseif($FirstName != "" && $LastName == "" && $Password != "" && $Address != ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and Password = '$Password' 
                        and Address = '$Address'");
                    }
                    elseif($FirstName == "" && $LastName != "" && $Password != "" && $Address != ""){
                        $q = mysql_query("select * from admin where Last_Name = '$LastName' and Password = '$Password' 
                        and Address = '$Address'");
                    }
                    elseif($FirstName != "" && $LastName != "" && $Password != "" && $Address != ""){
                        $q = mysql_query("select * from admin where First_Name = '$FirstName' and Last_Name = '$LastName' 
                        and Password = '$Password' and Address = '$Address'");
                    }   
                    $n = mysql_num_rows($q);
                    if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                        margin-left:35%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>First_Name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>Last_Name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>Email</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>Password</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>Address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>admin_type</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $First_Name = mysql_result($q,$i,"First_Name");
                            $Last_Name = mysql_result($q,$i,"Last_Name");
                            $Email = mysql_result($q,$i,"Email");
                            $Password = mysql_result($q,$i,"Password");
                            $Address = mysql_result($q,$i,"Address");
                            $admin_type = mysql_result($q,$i,"admin_type");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$First_Name</td> <td style='border: 2px solid #ddd; padding:10px'>$Last_Name</td> <td style='border: 2px solid #ddd; padding:10px'>$Email</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$Password</td> <td style='border: 2px solid #ddd; padding:10px'>$Address</td><td style='border: 2px solid #ddd; padding:10px'>$admin_type</td></tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
        function CheckRepeat($FirstName,$LastName,$Email,$Password,$Address){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from admin where First_Name = '$FirstName' and 
                Last_Name = '$LastName' and Email = '$Email' and Password = '$Password' and Address = '$Address'");
                $n = mysql_num_rows($q);
                if($n == 0)
                    return true;
                else
                    return false;
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



        
        
        <!-- ==================== start form-info ====================  -->        
        <div class="form-info">
            <div class="container">
                    
                <form class="col" action="Admin-new.php" method="post">
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
                        <div class="form-group col">
                            <label>Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Your email address" name="Email">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col">
                            <label>Password</label>
                            <input type="password" class="form-control" id="inputEmail4" placeholder="Your password" name="Password">
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col">
                            <label>Address</label>
                            <input type="text" class="form-control" id="inputEmail4" placeholder="Your address" name="Address">
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
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
                            <button type="submit" name="Update" class="btn btn-warning btn-lg">Update</button>
                            <select name="AdminUpdate" class="custom-select">
                                <option value="FirstName" selected>FirstName</option>
                                <option value="LastName">LastName</option>
                                <option value="Email">Email</option>
                                <option value="Password">Password</option>
                                <option value="Address">Address</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" name="Delete" class="btn btn-danger btn-lg">Remove</button>
                        </div>
                    </div>
               </form>
      
            </div>
        </div>
        <?php
            if(isset($Show)){
                show();
            }
            elseif(isset($Select)){
                select();
            }
        ?>
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
                    
                    <div class="footer-info col-md-4 col-sm-12">
                        <h2><a class="footer-brand" href="#"><span>Healthy</span><span>Care</span></a></h2>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                    </div>
                    
                    <div class="footer-contact col-md-3 col-sm-6">
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

                    <div class="footer-form col-md-4 col-sm-6">
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
                    <div class="col-md-8 col-sm-12 text-center text-sm-left">
                        <h5>Copyright &copy; 2019 All rights reserved </h5>
                    </div>

                    <div class="social-web col-md-4 col-sm-12 text-center text-sm-left">
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


        
                

        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script>new WOW().init();</script>
        <script src="js/main.js"></script>

    </body>
</html>