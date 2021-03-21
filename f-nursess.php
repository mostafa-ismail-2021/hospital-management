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
            @$NurseSend = $_POST["NurseSend"];
            @$NurseShow = $_POST["NurseShow"];
            @$NurseDelete = $_POST["NurseDelete"];
            @$NurseSelect = $_POST["NurseSelect"];
            @$NurseUpdate = $_POST["NurseUpdate"];
            if(isset($NurseSend)){
                $NurseName = $_POST["Nurse_Name"];
                $NurseSpeciality = $_POST["Nurse_Speciality"];
                $NurseDegree = $_POST["Nurse_Degree"];
                $NursePhone = $_POST["Nurse_Phone"];
                $NursePhone = CheckPhone($NursePhone);
                $Repeat = CheckRepeat($NurseName,$NurseSpeciality,$NurseDegree,$NursePhone);
                if($Repeat == true){
                    if($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into nursess(nur_name,nur_specialty,nur_degree,nur_phone) values ('$NurseName','$NurseSpeciality','$NurseDegree','$NursePhone')");
                        $id = GetId($NurseName,$NurseSpeciality,$NurseDegree,$NursePhone);
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data added successfuly and the id is $id');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
                
            }
            elseif(isset($NurseDelete)){
                $NurseName = $_POST["Nurse_Name"];
                $NurseSpeciality = $_POST["Nurse_Speciality"];
                $NurseDegree = $_POST["Nurse_Degree"];
                $NursePhone = $_POST["Nurse_Phone"];
                if($NurseName == "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_specialty = '$NurseSpeciality'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_degree = '$NurseDegree'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and nur_degree = '$NurseDegree'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and 
                    nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_specialty = '$NurseSpeciality' and
                    nur_degree = '$NurseDegree'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_specialty = '$NurseSpeciality' and
                    nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_degree = '$NurseDegree' and
                    nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' 
                    and nur_degree = '$NurseDegree'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' 
                    and nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and nur_degree = '$NurseDegree' 
                    and nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree' 
                    and nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
                elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from nursess where nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data deleted successfuly');</script>";
                }
            }
            elseif(isset($NurseUpdate)){
                $NurseName = $_POST["Nurse_Name"];
                $NurseSpeciality = $_POST["Nurse_Speciality"];
                $NurseDegree = $_POST["Nurse_Degree"];
                $NursePhone = $_POST["Nurse_Phone"];
                $Update = $_POST["Update"];
                if($Update == "NurseName"){
                    if($NurseName == "" || $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the name field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($NurseSpeciality != "" && $NurseDegree == "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where
                            nur_specialty = '$NurseSpeciality'");
                        }  
                        elseif($NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where
                            nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where
                            nur_phone = '$NursePhone'");
                        }
                        elseif($NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where
                            nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where
                            nur_specialty = '$NurseSpeciality' and nur_phone = '$NursePhone'");
                        }
                        elseif($NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where
                            nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                        }
                        elseif($NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_name = '$NurseName' where nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                        }
                        mysql_close($con);
                    }
                }
                
                elseif($Update == "NurseSpeciality"){
                    if($DoctorSpeciality == "" || $DoctorName == "" && $DoctorPhone == "" && $DoctorAddress == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Speciality field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorName != "" && $DoctorPhone == "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where
                            nur_name = '$NurseName'");
                        }  
                        elseif($DoctorName == "" && $DoctorPhone != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where
                            nur_degree = '$NurseDegree'");
                        }
                        elseif($DoctorName == "" && $DoctorPhone == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where
                            nur_phone = '$NursePhone'");
                        }
                        elseif($DoctorName != "" && $DoctorPhone != "" && $DoctorAddress == ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where
                            nur_name = '$NurseName' and nur_degree = '$NurseDegree'");
                        }
                        elseif($DoctorName != "" && $DoctorPhone == "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where
                            nur_name = '$NurseName' and nur_phone = '$NursePhone'");
                        }
                        elseif($DoctorName == "" && $DoctorPhone != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where
                            nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                        }
                        elseif($DoctorName != "" && $DoctorPhone != "" && $DoctorAddress != ""){
                            $q = mysql_query("UPDATE nursess set nur_specialty = '$NurseSpeciality' where 
                            nur_name = '$NurseName' and nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "NurseDegree"){
                    if($NurseDegree == "" || $NurseName == "" && $NurseSpeciality == "" && $NursePhone == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Degree field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($NurseName != "" && $NurseSpeciality == "" && $NursePhone == ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree'' where
                            nur_name = '$NurseName'");
                        }  
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NursePhone == ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree' where
                            nur_specialty = '$NurseSpeciality'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality == "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree' where
                            nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NursePhone == ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree' where
                            nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality == "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree' where
                            nur_name = '$NurseName' and nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree' where
                            nur_specialty = '$NurseSpeciality' and nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NursePhone != ""){
                            $q = mysql_query("UPDATE nursess set nur_degree = '$NurseDegree' where 
                            nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' and nur_phone = '$NursePhone'");
                        }
                        mysql_close($con);
                    }
                }
                elseif($Update == "NursePhone"){
                    if($NursePhone == "" || $NurseName == "" && $NurseSpeciality == "" && $NurseDegree == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the Phone field and one field at least of other');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($NurseName != "" && $NurseSpeciality == "" && $NurseDegree == ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where
                            nur_name = '$NurseName'");
                        }  
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where
                            nur_specialty = '$NurseSpeciality'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where
                            nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where
                            nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where
                            nur_name = '$NurseName' and nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where
                            nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != ""){
                            $q = mysql_query("UPDATE nursess set nur_phone = '$NursePhone' where 
                            nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree'");
                        }
                        mysql_close($con);
                    }
                }
            }
            function show(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from nursess");
                $n = mysql_num_rows($q);
                
                if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                else{
                    echo"<div style='overflow-y:auto; height:300px'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                    margin-left:35%'>";
                    echo"<tr>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>nur_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>nur_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>nur_specialty</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>nur_degree</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>nur_phone</th>";
                    echo"</tr>";
                    
                    
                    for($i=0;$i<$n;$i++){
                        $id = mysql_result($q,$i,"nur_id");
                        $name = mysql_result($q,$i,"nur_name");
                        $specialty = mysql_result($q,$i,"nur_specialty");
                        $degree = mysql_result($q,$i,"nur_degree");
                        $phone = mysql_result($q,$i,"nur_phone");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$name</td> <td style='border: 2px solid #ddd; padding:10px'>$specialty</td> 
                        <td style='border: 2px solid #ddd; padding:10px'>$degree</td> <td style='border: 2px solid #ddd; padding:10px'>$phone</td> </tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
            }
            function select(){
                $NurseName = $_POST["Nurse_Name"];
                $NurseSpeciality = $_POST["Nurse_Speciality"];
                $NurseDegree = $_POST["Nurse_Degree"];
                $NursePhone = $_POST["Nurse_Phone"];
                if($NurseName == "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($NurseName != "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_specialty = '$NurseSpeciality'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_degree = '$NurseDegree'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and 
                        nur_specialty = '$NurseSpeciality'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and nur_degree = '$NurseDegree'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and 
                        nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_specialty = '$NurseSpeciality' and
                        nur_degree = '$NurseDegree'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_specialty = '$NurseSpeciality' and
                        nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_degree = '$NurseDegree' and
                        nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' 
                        and nur_degree = '$NurseDegree'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and nur_specialty = '$NurseSpeciality' 
                        and nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and nur_degree = '$NurseDegree' 
                        and nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_specialty = '$NurseSpeciality' and 
                        nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                    }
                    elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                        $q = mysql_query("select * from nursess where nur_name = '$NurseName' and 
                        nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                    }
                    $n = mysql_num_rows($q);
                    if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse; width:100px; height:100px;
                        margin-left:35%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_degree</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_phone</th>";
                        echo"</tr>";
                        
                    
                        for($i=0;$i<$n;$i++){
                            $id = mysql_result($q,$i,"nur_id");
                            $name = mysql_result($q,$i,"nur_name");
                            $specialty = mysql_result($q,$i,"nur_specialty");
                            $degree = mysql_result($q,$i,"nur_degree");
                            $phone = mysql_result($q,$i,"nur_phone");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$id</td> <td style='border: 2px solid #ddd; padding:10px'>$name</td> <td style='border: 2px solid #ddd; padding:10px'>$specialty</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$degree</td> <td style='border: 2px solid #ddd; padding:10px'>$phone</td> </tr>";
                        }
                        
                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
        function CheckRepeat($NurseName,$NurseSpeciality,$NurseDegree,$NursePhone){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("select * from nursess where nur_name = '$NurseName' and 
                nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                $n = mysql_num_rows($q);
                if($n == 0)
                    return true;
                else
                    return false;
            }
        function GetId($NurseName,$NurseSpeciality,$NurseDegree,$NursePhone){
                $q = mysql_query("select nur_id from nursess where nur_name = '$NurseName' and 
                nur_specialty = '$NurseSpeciality' and nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                $id = mysql_result($q,0,"nur_id");
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
                    
                <form class="col" action="f-nursess.php" method="post">
                    
                    
                    <!-- search -->
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Nurse Name</label>
                          <input type="text" class="form-control" id="" placeholder="Nurse name" name="Nurse_Name">
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Nurse Speciality</label>
                          <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" 
                                  name="Nurse_Speciality">
                            <option selected value="">Choose ...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Nurse Degree</label>
                          <input type="text" class="form-control" id="" placeholder="Nurse degree" name="Nurse_Degree">
                        </div>
                    </div>


                    
                    
                    
                    <div class="form-row">
                        <div class="form-group col">
                          <label>Nurse Phone</label>
                          <input type="text" class="form-control" id="" placeholder="Nurse phone" name="Nurse_Phone">
                        </div>
                    </div>
       
                    
                    
                    
                    
                    <div class="form-row justify-content-md-center">
                        
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-primary btn-lg btn " name="NurseSelect">Select</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-dark btn-lg" name="NurseShow">Show</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-success btn-lg" name="NurseSend">Insert</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-danger btn-lg" name="NurseDelete">Remove</button>
                        </div>
                        <div class="form-group col-2">
                            <button type="submit" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-group col-2 offset-9">
                            <select name="Update" class="custom-select">
                                <option value="NurseName" selected>NurseName</option>
                                <option value="NurseSpeciality">NurseSpeciality</option>
                                <option value="NurseDegree">NurseDegree</option>
                                <option value="NursePhone">NursePhone</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                </form>
      
            </div>
        </div>
        <?php
            if(isset($NurseShow)){
                show();
            }
            elseif(isset($NurseSelect)){
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
                src="rel-nurses.php">
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