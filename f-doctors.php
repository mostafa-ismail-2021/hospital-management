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
            @$DoctorSend = $_POST["DoctorSend"];
            @$DoctorShow = $_POST["DoctorShow"];
            @$DoctorDelete = $_POST["DoctorDelete"];
            @$DoctorSelect = $_POST["DoctorSelect"];
            @$DoctorUpdate = $_POST["DoctorUpdate"];
            if(isset($DoctorSend)){
                $DoctorName = $_POST["Doctor_Name"];
                $DoctorSpeciality = $_POST["Doctor_Speciality"];
                $DoctorPhone = $_POST["Doctor_Phone"];
                $DoctorAddress = $_POST["Doctor_Address"];
                $DoctorEmail = $_POST["Doctor_Email"];
                $DoctorPassword = $_POST["Doctor_Password"];
                $DoctorPhone = CheckPhone($DoctorPhone);
                $Repeat = CheckRepeat($DoctorName,$DoctorSpeciality,$DoctorPhone,$DoctorAddress,$DoctorEmail,$DoctorPassword);
                if($Repeat == true){
                    if($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress != "" && $DoctorEmail != "" && $DoctorPassword != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into doctor(doc_name,doc_specialty,doc_phone,doc_address,doc_Email,doc_Password) values ('$DoctorName','$DoctorSpeciality','$DoctorPhone','$DoctorAddress','$DoctorEmail','$DoctorPassword')");
                        $id = GetId($DoctorName,$DoctorSpeciality,$DoctorPhone,$DoctorAddress,$DoctorEmail,$DoctorPassword);
                        $FirstName = devide1($DoctorName);
                        $LastName = devide2($DoctorName);
                        $q = mysql_query("insert into admin(First_Name,Last_Name,Email,Password,Address,admin_type) values ('$FirstName','$LastName','$DoctorEmail','$DoctorPassword','$DoctorAddress','d')");
                        mysql_close($con);
                        
                        echo "<script type='text/javascript'>alert('data added successfuly and the id is $id');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
            }
            elseif(isset($DoctorDelete)){
                $DoctorName = $_POST["Doctor_Name"];
                $DoctorSpeciality = $_POST["Doctor_Speciality"];
                $DoctorPhone = $_POST["Doctor_Phone"];
                $DoctorAddress = $_POST["Doctor_Address"];
                $DoctorEmail = $_POST["Doctor_Email"];
                $DoctorPassword = $_POST["Doctor_Password"];
                if($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress == "" && $DoctorEmail != "" && $DoctorPassword != "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_specialty = '$DoctorSpeciality'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_phone = '$DoctorPhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and doc_phone = '$DoctorPhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and 
                    doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_specialty = '$DoctorSpeciality' and
                    doc_phone = '$DoctorPhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_specialty = '$DoctorSpeciality' and
                    doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_phone = '$DoctorPhone' and
                    doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' 
                    and doc_phone = '$DoctorPhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' 
                    and doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and doc_phone = '$DoctorPhone' 
                    and doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone' 
                    and doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' 
                    and doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorEmail != "" && $DoctorPassword == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_Email = '$DoctorEmail'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorEmail == "" && $DoctorPassword != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_Password = '$DoctorPassword'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($DoctorEmail != "" && $DoctorPassword != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from doctor where doc_Email = '$DoctorEmail' and doc_Password = '$DoctorPassword'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
            }
            elseif(isset($DoctorUpdate)){
                $DoctorName = $_POST["Doctor_Name"];
                $DoctorSpeciality = $_POST["Doctor_Speciality"];
                $DoctorPhone = $_POST["Doctor_Phone"];
                $DoctorAddress = $_POST["Doctor_Address"];
                $DoctorEmail = $_POST["Doctor_Email"];
                $DoctorPassword = $_POST["Doctor_Password"];
                $Update = $_POST["Update"];
                if($Update == "DoctorName"){
                    if($DoctorName == "" || $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the name field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where
                            doc_specialty = '$DoctorSpeciality'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }  
                        elseif($DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where
                            doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where
                            doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where
                            doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where
                            doc_specialty = '$DoctorSpeciality' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where
                            doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_name = '$DoctorName' where doc_specialty = '$DoctorSpeciality' 
                            and doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }
                        
                        
                }
                elseif($Update == "DoctorSpeciality"){
                    if($DoctorSpeciality == "" || $DoctorName == "" && $DoctorPhone == "" && $DoctorAddress == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Speciality field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorName != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where
                            doc_name = '$DoctorName'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }  
                        elseif($DoctorName == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where
                            doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where
                            doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where
                            doc_name = '$DoctorName' and doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where
                            doc_name = '$DoctorName' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where
                            doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_specialty = '$DoctorSpeciality' where 
                            doc_name = '$DoctorName' and doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "DoctorPhone"){
                    if($DoctorPhone == "" || $DoctorName == "" && $DoctorSpeciality == "" && $DoctorAddress == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Phone field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorName != "" && $DoctorSpeciality == "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where
                            doc_name = '$DoctorName'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }  
                        elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where
                            doc_specialty = '$DoctorSpeciality'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where
                            doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where
                            doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where
                            doc_name = '$DoctorName' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where
                            doc_specialty = '$DoctorSpeciality' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE doctor set doc_phone = '$DoctorPhone' where 
                            doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' and doc_address = '$DoctorAddress'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "DoctorAddress"){
                    if($DoctorAddress == "" || $DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Address field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone == ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where
                            doc_name = '$DoctorName'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }  
                        elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone == ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where
                            doc_specialty = '$DoctorSpeciality'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone != ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where
                            doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone == ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where
                            doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone != ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where
                            doc_name = '$DoctorName' and doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone != ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where
                            doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone != ""){
                            $q = mysql_query("UPDATE doctor set doc_address = '$DoctorAddress' where 
                            doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "DoctorEmail"){
                    if($DoctorEmail == "" || $DoctorPhone == "" && $DoctorPassword == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Email field and one field at least of Phone or Password');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorPhone != "" && $DoctorPassword == ""){
                            $q = mysql_query("UPDATE doctor set doc_Email = '$DoctorEmail' where
                            doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorPhone == "" && $DoctorPassword != ""){
                            $q = mysql_query("UPDATE doctor set doc_Email = '$DoctorEmail' where
                            doc_Password = '$DoctorPassword'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorPhone != "" && $DoctorPassword != ""){
                            $q = mysql_query("UPDATE doctor set doc_Email = '$DoctorEmail' where
                            doc_phone = '$DoctorPhone' and doc_Password = '$DoctorPassword'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "DoctorPassword"){
                    if($DoctorPassword == "" || $DoctorEmail == "" && $DoctorPhone == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Password field and one field at least of Phone or Email');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorEmail != "" && $DoctorPhone == ""){
                            $q = mysql_query("UPDATE doctor set doc_Password = '$DoctorPassword' where
                            doc_Email = '$DoctorEmail'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorEmail == "" && $DoctorPhone != ""){
                            $q = mysql_query("UPDATE doctor set doc_Password = '$DoctorPassword' where
                            doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        elseif($DoctorEmail != "" && $DoctorPhone != ""){
                            $q = mysql_query("UPDATE doctor set doc_Password = '$DoctorPassword' where
                            doc_Email = '$DoctorEmail' and doc_phone = '$DoctorPhone'");
                            echo "<script type='text/javascript'>alert('data update successfuly');</script>";
                        }
                        mysql_close($con);
                    }   
                }
            }
            function show(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from doctor");
                $n = mysql_num_rows($q);
                
                if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                else{
                    echo"<div style='overflow-y:auto; height:300px' class='d-flex justify-content-center'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                    '>";
                    echo"<tr>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_Email</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_Password</th>";
                    echo"</tr>";
                    
                    
                    for($i=0;$i<$n;$i++){
                        $id = mysql_result($q,$i,"doc_id");
                        $name = mysql_result($q,$i,"doc_name");
                        $specialty = mysql_result($q,$i,"doc_specialty");
                        $phone = mysql_result($q,$i,"doc_phone");
                        $address = mysql_result($q,$i,"doc_address");
                        $Email = mysql_result($q,$i,"doc_Email");
                        $Password = mysql_result($q,$i,"doc_Password");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$name</td> <td style='border: 2px solid #ddd; padding:10px'>$specialty</td> 
                        <td style='border: 2px solid #ddd; padding:10px'>$phone</td> <td style='border: 2px solid #ddd; padding:10px'>$address</td><td style='border: 2px solid #ddd; padding:10px'>$Email</td><td style='border: 2px solid #ddd; padding:10px'>$Password</td> </tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
            }
            function select(){
                $DoctorName = $_POST["Doctor_Name"];
                $DoctorSpeciality = $_POST["Doctor_Speciality"];
                $DoctorPhone = $_POST["Doctor_Phone"];
                $DoctorAddress = $_POST["Doctor_Address"];
                $DoctorEmail = $_POST["Doctor_Email"];
                $DoctorPassword = $_POST["Doctor_Password"];
                if($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress == "" && $DoctorEmail == "" && $DoctorPassword == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_specialty = '$DoctorSpeciality'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_phone = '$DoctorPhone'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and doc_phone = '$DoctorPhone'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and 
                        doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_specialty = '$DoctorSpeciality' and
                        doc_phone = '$DoctorPhone'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_specialty = '$DoctorSpeciality' and
                        doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_phone = '$DoctorPhone' and
                        doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' 
                        and doc_phone = '$DoctorPhone'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' 
                        and doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and doc_phone = '$DoctorPhone' 
                        and doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName == "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone' 
                        and doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorName != "" && $DoctorSpeciality != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                        $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and doc_specialty = '$DoctorSpeciality' 
                        and doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress'");
                    }
                    elseif($DoctorEmail != "" && $DoctorPassword == ""){
                        $q = mysql_query("select * from doctor where doc_Email = '$DoctorEmail'");
                    }
                    elseif($DoctorEmail == "" && $DoctorPassword != ""){
                        $q = mysql_query("select * from doctor where doc_Password = '$DoctorPassword'");
                    }
                    elseif($DoctorEmail != "" && $DoctorPassword != ""){
                        $q = mysql_query("select * from doctor where doc_Email = '$DoctorEmail' and doc_Password = '$DoctorPassword'");
                    }   
                    $n = mysql_num_rows($q);
                    if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px' class='d-flex justify-content-center'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                        '>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_Email</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_Password</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $id = mysql_result($q,$i,"doc_id");
                            $name = mysql_result($q,$i,"doc_name");
                            $specialty = mysql_result($q,$i,"doc_specialty");
                            $phone = mysql_result($q,$i,"doc_phone");
                            $address = mysql_result($q,$i,"doc_address");
                            $Email = mysql_result($q,$i,"doc_Email");
                            $Password = mysql_result($q,$i,"doc_Password");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$name</td> <td style='border: 2px solid #ddd; padding:10px'>$specialty</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$phone</td> <td style='border: 2px solid #ddd; padding:10px'>$address</td><td style='border: 2px solid #ddd; padding:10px'>$Email</td><td style='border: 2px solid #ddd; padding:10px'>$Password</td> </tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
        function CheckRepeat($DoctorName,$DoctorSpeciality,$DoctorPhone,$DoctorAddress,$DoctorEmail,$DoctorPassword){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from doctor where doc_name = '$DoctorName' and 
                doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress' and doc_Email = '$DoctorEmail' and doc_Password = '$DoctorPassword'");
                $n = mysql_num_rows($q);
                if($n == 0)
                    return true;
                else
                    return false;
            }
        function GetId($DoctorName,$DoctorSpeciality,$DoctorPhone,$DoctorAddress,$DoctorEmail,$DoctorPassword){
                $q = mysql_query("select doc_id from doctor where doc_name = '$DoctorName' and 
                doc_specialty = '$DoctorSpeciality' and doc_phone = '$DoctorPhone' and doc_address = '$DoctorAddress' and doc_Email = '$DoctorEmail' and doc_Password = '$DoctorPassword'");
                $id = mysql_result($q,0,"doc_id");
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
            function devide1($DoctorName){
                $FirstName = "";
                $l = strlen($DoctorName);
                for($i = 0 ; $i < $l ; $i++){
                    if($DoctorName[$i] == " "){
                        
                        for($s = 0 ; $s < $i ; $s++){
                            $FirstName .= $DoctorName[$s];
                        }
                        return $FirstName;
                    }
                }
            }
            function devide2($DoctorName){
                $LastName = "";
                $l = strlen($DoctorName);
                for($i = 0 ; $i < $l ; $i++){
                    if($DoctorName[$i] == " "){
                        for($t = $i + 1 ; $t < $l ; $t++){
                            $LastName .= $DoctorName[$t];
                        }
                        return $LastName;
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
                    
                <form class="col" action="f-doctors.php" method="post">
                    
                    
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
                          <label>Doctor Name</label>
                          <input type="text" class="form-control" placeholder="Doctor name" name="Doctor_Name">
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Doctor Speciality</label>
                          <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="Doctor_Speciality">
                            <option selected value="">Choose ...</option>
                            <option value="cardiologist">cardiologist</option>
                            <option value="orthopidicsurgeon">orthopidic surgeon</option>
                            <option value="nepherologist">nepherologist</option>
                            <option value="pediatrician">pediatrician</option>
                            <option value="surgeon">surgeon</option>
                            <option value="radiologist">radiologist</option>
                          </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Doctors Phone</label>
                          <input type="text" class="form-control" placeholder="Doctor Phone" name="Doctor_Phone">
                        </div>
                    </div>
       
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Doctors Address</label>
                          <input type="text" class="form-control" placeholder="Doctor Address" name="Doctor_Address">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Doctor Email</label>
                            <input type="email" name="Doctor_Email" class="form-control" placeholder="Doctor email">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Doctor Password</label>
                            <input type="password" name="Doctor_Password" class="form-control" placeholder="Doctor password">
                        </div>
                    </div>

                    
                    
                    
                    <div class="form-row justify-content-md-center">
                        
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-primary btn-lg" name="DoctorSelect">Select</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-dark btn-lg" name="DoctorShow">Show</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-success btn-lg" name="DoctorSend">Insert</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-danger btn-lg" name="DoctorDelete">Remove</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-warning btn-lg col" name="DoctorUpdate">Update</button>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-2 offset-9">
                            <select name="Update" class="custom-select">
                                <option value="DoctorName" selected>DoctorName</option><option value="DoctorPhone">DoctorPhone</option><option value="DoctorSpeciality">DoctorSpeciality</option><option value="DoctorAddress">DoctorAddress</option><option value="DoctorEmail">DoctorEmail</option><option value="DoctorPassword">DoctorPassword</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    
                    
               </form>
      
            </div>
        </div>
        <?php
            if(isset($DoctorShow)){
                show();
            }
            elseif(isset($DoctorSelect)){
                select();
            }
        ?>
        <!-- ==================== End form-info ====================  -->
        
        
            
            
            
            
        <!-- ======================================== iframe ========================================  -->
        <div class="container-fluid" style="padding:0;">    
        <!-- i-frame -->
        <iframe id="inlineFrameExample"
                title="Inline Frame Example"
                width="100%"
                height="2500px"
                src="rel-doctors.php">
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