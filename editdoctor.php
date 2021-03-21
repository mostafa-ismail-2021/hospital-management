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
            @$AppointmentsDoctorSelect = $_POST["AppointmentsDoctorSelect"];
            @$AppointmentsDoctorShow = $_POST["AppointmentsDoctorShow"];
            @$DoctorNurseSelect = $_POST["DoctorNurseSelect"];
            @$DoctorNurseShow = $_POST["DoctorNurseShow"];
            @$DoctorPatientSelect = $_POST["DoctorPatientSelect"];
            @$DoctorPatientShow = $_POST["DoctorPatientShow"];
            @$DoctorRoomSelect = $_POST["DoctorRoomSelect"];
            @$DoctorRoomShow = $_POST["DoctorRoomShow"];
            session_start();
            $Email = $_SESSION["Email"];
            function RelationAppointmentsAndDoctorShow($Email){
                @$con = mysql_connect("sql109.eb2a.com","eb2a_24078768","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email'");
                $n = mysql_num_rows($q);
                
                if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                else{
                    echo"<div style='overflow-y:auto; height:300px'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                    margin-left:20%'>";
                    echo"<tr>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>app_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>app_date</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>app_type</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>app_doctors</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                    echo"</tr>";
                    
                    
                    for($i=0;$i<$n;$i++){
                        $AppId = mysql_result($q,$i,"app_id");
                        $AppDate = mysql_result($q,$i,"app_date");
                        $AppType = mysql_result($q,$i,"app_type");
                        $AppDoctors = mysql_result($q,$i,"app_doctors");
                        $DocId = mysql_result($q,$i,"doc_id");
                        $DocName = mysql_result($q,$i,"doc_name");
                        $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                        $DocPhone = mysql_result($q,$i,"doc_phone");
                        $DocAddress = mysql_result($q,$i,"doc_address");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AppId</td> <td style='border: 2px solid #ddd; padding:10px'>$AppDate</td> <td style='border: 2px solid #ddd; padding:10px'>$AppType</td> 
                        <td style='border: 2px solid #ddd; padding:10px'>$AppDoctors</td> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td><td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> </tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
            }
        function RelationAppointmentsAndDoctorSelect($Email){
                $AppointmentDate = $_POST["Appointment_Date"];
                $AppointmentType = $_POST["Appointment_Type"];
                $AppointmentDoctor = $_POST["Appointment_Doctor"];
                if($AppointmentDate == "" && $AppointmentType == "" && $AppointmentDoctor == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($AppointmentDate != "" && $AppointmentType == "" && $AppointmentDoctor == ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_date = '$AppointmentDate'");
                    }  
                    elseif($AppointmentDate == "" && $AppointmentType != "" && $AppointmentDoctor == ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_type = '$AppointmentType'");
                    }
                    elseif($AppointmentDate == "" && $AppointmentType == "" && $AppointmentDoctor != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_doctors = '$AppointmentDoctor'");
                    }
                    elseif($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor == ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_date = '$AppointmentDate' and a.app_type = '$AppointmentType'");
                    }
                    elseif($AppointmentDate != "" && $AppointmentType == "" && $AppointmentDoctor != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_date = '$AppointmentDate' and a.app_doctors = '$AppointmentDoctor'");
                    }
                    elseif($AppointmentDate == "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_type = '$AppointmentType' and a.app_doctors = '$AppointmentDoctor'");
                    }
                    elseif($AppointmentDate != "" && $AppointmentType != "" && $AppointmentDoctor != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and d.doc_Email = '$Email' and a.app_date = '$AppointmentDate' and a.app_type = '$AppointmentType' and a.app_doctors = '$AppointmentDoctor'");
                    }
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>app_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>app_date</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>app_type</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>app_doctors</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $AppId = mysql_result($q,$i,"app_id");
                            $AppDate = mysql_result($q,$i,"app_date");
                            $AppType = mysql_result($q,$i,"app_type");
                            $AppDoctors = mysql_result($q,$i,"app_doctors");
                            $DocId = mysql_result($q,$i,"doc_id");
                            $DocName = mysql_result($q,$i,"doc_name");
                            $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                            $DocPhone = mysql_result($q,$i,"doc_phone");
                            $DocAddress = mysql_result($q,$i,"doc_address");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AppId</td> <td style='border: 2px solid #ddd; padding:10px'>$AppDate</td> <td style='border: 2px solid #ddd; padding:10px'>$AppType</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$AppDoctors</td> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td><td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> </tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
            function RelationDoctorAndNurseShow($Email){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email'");
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_degree</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>nur_phone</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $DocId = mysql_result($q,$i,"doc_id");
                            $DocName = mysql_result($q,$i,"doc_name");
                            $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                            $DocPhone = mysql_result($q,$i,"doc_phone");
                            $DocAddress = mysql_result($q,$i,"doc_address");
                            $NurId = mysql_result($q,$i,"nur_id");
                            $NurName = mysql_result($q,$i,"nur_name");
                            $NurSpecialty = mysql_result($q,$i,"nur_specialty");
                            $NurDegree = mysql_result($q,$i,"nur_degree");
                            $NurPhone = mysql_result($q,$i,"nur_phone");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$NurId</td> <td style='border: 2px solid #ddd; padding:10px'>$NurName</td> <td style='border: 2px solid #ddd; padding:10px'>$NurSpecialty</td><td style='border: 2px solid #ddd; padding:10px'>$NurDegree</td>
                            <td style='border: 2px solid #ddd; padding:10px'>$NurPhone</td></tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }

                    mysql_close($con);
                }
        function RelationDoctorAndNurseSelect($Email){
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
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_specialty = '$NurseSpeciality'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and 
                            n.nur_specialty = '$NurseSpeciality'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and n.nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree == "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and 
                            nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_specialty = '$NurseSpeciality' and n.nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_specialty = '$NurseSpeciality' and
                            n.nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_degree = '$NurseDegree' and
                            n.nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and n.nur_specialty = '$NurseSpeciality' 
                            and n.nur_degree = '$NurseDegree'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree == "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and n.nur_specialty = '$NurseSpeciality' 
                            and n.nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality == "" && $NurseDegree != "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and n.nur_degree = '$NurseDegree' 
                            and n.nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName == "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_specialty = '$NurseSpeciality' and 
                            n.nur_degree = '$NurseDegree' and n.nur_phone = '$NursePhone'");
                        }
                        elseif($NurseName != "" && $NurseSpeciality != "" && $NurseDegree != "" && $NursePhone != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and d.doc_Email = '$Email' and n.nur_name = '$NurseName' and 
                            n.nur_specialty = '$NurseSpeciality' and n.nur_degree = '$NurseDegree' and nur_phone = '$NursePhone'");
                        }
                        $n = mysql_num_rows($q);
                        if($n == 0)
                            echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                        else{
                            echo"<div style='overflow-y:auto; height:300px'>";
                            echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                            margin-left:20%'>";
                            echo"<tr>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_id</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_specialty</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_degree</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_phone</th>";
                            echo"</tr>";


                            for($i=0;$i<$n;$i++){
                                $DocId = mysql_result($q,$i,"doc_id");
                                $DocName = mysql_result($q,$i,"doc_name");
                                $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                                $DocPhone = mysql_result($q,$i,"doc_phone");
                                $DocAddress = mysql_result($q,$i,"doc_address");
                                $NurId = mysql_result($q,$i,"nur_id");
                                $NurName = mysql_result($q,$i,"nur_name");
                                $NurSpecialty = mysql_result($q,$i,"nur_specialty");
                                $NurDegree = mysql_result($q,$i,"nur_degree");
                                $NurPhone = mysql_result($q,$i,"nur_phone");
                                echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> 
                                <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$NurId</td> <td style='border: 2px solid #ddd; padding:10px'>$NurName</td> <td style='border: 2px solid #ddd; padding:10px'>$NurSpecialty</td><td style='border: 2px solid #ddd; padding:10px'>$NurDegree</td>
                                <td style='border: 2px solid #ddd; padding:10px'>$NurPhone</td></tr>";
                            }

                            echo"</table>";
                            echo"</div>";
                        }

                        mysql_close($con);
                    }
            }
            function RelationDoctorAndRoomShow($Email){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email'");
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>date</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $DocId = mysql_result($q,$i,"doc_id");
                            $DocName = mysql_result($q,$i,"doc_name");
                            $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                            $DocPhone = mysql_result($q,$i,"doc_phone");
                            $DocAddress = mysql_result($q,$i,"doc_address");
                            $RoomId = mysql_result($q,$i,"room_id");
                            $RoomName = mysql_result($q,$i,"room_name");
                            $RoomPlace = mysql_result($q,$i,"room_place");
                            $RoomType = mysql_result($q,$i,"room_type");
                            $Date = mysql_result($q,$i,"date");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td><td style='border: 2px solid #ddd; padding:10px'>$RoomType</td>
                            <td style='border: 2px solid #ddd; padding:10px'>$Date</td></tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }

                    mysql_close($con);
                }
            function RelationDoctorAndRoomSelect($Email){
                        $RoomName = $_POST["Room_Name"];
                        $RoomPlace = $_POST["Room_Place"];
                        $RoomType = $_POST["Room_Type"];
                        if($RoomName == "" && $RoomPlace == "" && $RoomType == "")
                            echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($RoomName != "" && $RoomPlace == "" && $RoomType == ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' and room.room_name = '$RoomName'");
                            }  
                            elseif($RoomName == "" && $RoomPlace != "" && $RoomType == ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' and room.room_place = '$RoomPlace'");
                            }
                            elseif($RoomName == "" && $RoomPlace == "" && $RoomType != ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' and room.room_type = '$RoomType'");
                            }
                            elseif($RoomName != "" && $RoomPlace != "" && $RoomType == ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' and room.room_name = '$RoomName' and room.room_place = '$RoomPlace'");
                            }
                            elseif($RoomName != "" && $RoomPlace == "" && $RoomType != ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' and room.room_name = '$RoomName' and 
                                room.room_type = '$RoomType'");
                            }
                            elseif($RoomName == "" && $RoomPlace != "" && $RoomType != ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' and room.room_place = '$RoomPlace' and 
                                room.room_type = '$RoomType'");
                            }
                            elseif($RoomName != "" && $RoomPlace != "" && $RoomType != ""){
                                $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and d.doc_Email = '$Email' room.room_name = '$RoomName' and room.room_place = '$RoomPlace' and 
                                room.room_type = '$RoomType'");
                            }
                            $n = mysql_num_rows($q);
                            if($n == 0)
                                echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                            else{
                                echo"<div style='overflow-y:auto; height:300px'>";
                                echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                                margin-left:20%'>";
                                echo"<tr>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>date</th>";
                                echo"</tr>";


                                for($i=0;$i<$n;$i++){
                                    $DocId = mysql_result($q,$i,"doc_id");
                                    $DocName = mysql_result($q,$i,"doc_name");
                                    $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                                    $DocPhone = mysql_result($q,$i,"doc_phone");
                                    $DocAddress = mysql_result($q,$i,"doc_address");
                                    $RoomId = mysql_result($q,$i,"room_id");
                                    $RoomName = mysql_result($q,$i,"room_name");
                                    $RoomPlace = mysql_result($q,$i,"room_place");
                                    $RoomType = mysql_result($q,$i,"room_type");
                                    $Date = mysql_result($q,$i,"date");
                                    echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> 
                                    <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td><td style='border: 2px solid #ddd; padding:10px'>$RoomType</td>
                                    <td style='border: 2px solid #ddd; padding:10px'>$Date</td></tr>";
                                }

                                echo"</table>";
                                echo"</div>";
                            }

                            mysql_close($con);
                        }
            }
            function RelationDoctorAndPatientShow($Email){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email'");
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>date</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>diagnosis</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_cure</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $DocId = mysql_result($q,$i,"doc_id");
                            $DocName = mysql_result($q,$i,"doc_name");
                            $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                            $DocPhone = mysql_result($q,$i,"doc_phone");
                            $DocAddress = mysql_result($q,$i,"doc_address");
                            $PatientId = mysql_result($q,$i,"patient_id");
                            $PatientName = mysql_result($q,$i,"patient_name");
                            $PatientPhone = mysql_result($q,$i,"patient_phone");
                            $PatientAddress = mysql_result($q,$i,"patient_address");
                            $Date = mysql_result($q,$i,"date");
                            $Diagnosis = mysql_result($q,$i,"diagnosis");
                            $PatientCure = mysql_result($q,$i,"patient_cure");
                            
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientPhone</td><td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td>
                            <td style='border: 2px solid #ddd; padding:10px'>$Date</td><td style='border: 2px solid #ddd; padding:10px'>$Diagnosis</td><td style='border: 2px solid #ddd; padding:10px'>$PatientCure</td></tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }

                    mysql_close($con);
                }
            function RelationDoctorAndPatientSelect($Email){
                $PatientName = $_POST["Patient_Name"];
                $PatientPhone = $_POST["Patient_Phone"];
                $PatientAddress = $_POST["Patient_Address"];
                if($PatientName == "" && $PatientPhone == "" && $PatientAddress == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($PatientName != "" && $PatientPhone == "" && $PatientAddress == ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_name = '$PatientName'");
                    }  
                    elseif($PatientName == "" && $PatientPhone != "" && $PatientAddress == ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_phone = '$PatientPhone'");
                    }
                    elseif($PatientName == "" && $PatientPhone == "" && $PatientAddress != ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_address = '$PatientAddress'");
                    }
                    elseif($PatientName != "" && $PatientPhone != "" && $PatientAddress == ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_name = '$PatientName' and p.patient_phone = '$PatientPhone'");
                    }
                    elseif($PatientName != "" && $PatientPhone == "" && $PatientAddress != ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_name = '$PatientName' and 
                        p.patient_address = '$PatientAddress'");
                    }
                    elseif($PatientName == "" && $PatientPhone != "" && $PatientAddress != ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_phone = '$PatientPhone' and 
                        p.patient_address = '$PatientAddress'");
                    }
                    elseif($PatientName != "" && $PatientPhone != "" && $PatientAddress != ""){
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id and d.doc_Email = '$Email' and p.patient_name = '$PatientName' and 
                        p.patient_phone = '$PatientPhone' and p.patient_address = '$PatientAddress'");
                    }
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_specialty</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>doc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>date</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>diagnosis</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_cure</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $DocId = mysql_result($q,$i,"doc_id");
                            $DocName = mysql_result($q,$i,"doc_name");
                            $DocSpecialty = mysql_result($q,$i,"doc_specialty");
                            $DocPhone = mysql_result($q,$i,"doc_phone");
                            $DocAddress = mysql_result($q,$i,"doc_address");
                            $PatientId = mysql_result($q,$i,"patient_id");
                            $PatientName = mysql_result($q,$i,"patient_name");
                            $PatientPhone = mysql_result($q,$i,"patient_phone");
                            $PatientAddress = mysql_result($q,$i,"patient_address");
                            $Date = mysql_result($q,$i,"date");
                            $Diagnosis = mysql_result($q,$i,"diagnosis");
                            $PatientCure = mysql_result($q,$i,"patient_cure");
                            
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$DocId</td> <td style='border: 2px solid #ddd; padding:10px'>$DocName</td> <td style='border: 2px solid #ddd; padding:10px'>$DocSpecialty</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$DocPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$DocAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientPhone</td><td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td>
                            <td style='border: 2px solid #ddd; padding:10px'>$Date</td><td style='border: 2px solid #ddd; padding:10px'>$Diagnosis</td><td style='border: 2px solid #ddd; padding:10px'>$PatientCure</td></tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
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

        
        
        
        
        
        <!-- ===================================  form 1 ,4  =================================== -->
        <div class="form-info">
            <div class="container d-flex">
                
                <!-- ============= form1 ============= -->
                <form class="col-6" action="editdoctor.php" method="post" style="border:2px solid #BBB;padding:20px;margin-right:5px;">
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
                    <div class="form-row justify-content-center">
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorSelect" class="btn btn-primary btn-lg">Select</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorShow" class="btn btn-dark btn-lg">Show</button>
                        </div>
                    </div>
                    <?php
                        if(isset($AppointmentsDoctorShow)){
                            RelationAppointmentsAndDoctorShow($Email);
                        }
                        elseif(isset($AppointmentsDoctorSelect)){
                            RelationAppointmentsAndDoctorSelect($Email);
                        }
                ?>
                </form>
                
                
                
                <!-- ============= form4 ============= -->
                <form class="col-6" action="editdoctor.php" method="post" style="border:2px solid #BBB;padding:20px;">
                    <div class="form-row">
                        <div class="form-group col">
                    <label>Room Name</label>
                    <input type="text" class="form-control" id="" placeholder="Room name" name="Room_Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                    <label>Room Place</label>
                    <input type="text" class="form-control" id="" placeholder="Room place" name="Room_Place">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Room Type</label>
                            <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="Room_Type">
                                <option selected value="">Choose ...</option>
                                <option value="Low">Low</option>
                                <option value="Special">Special</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomSelect" class="btn btn-primary btn-lg">Select</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomShow"  class="btn btn-dark btn-lg">Show</button>
                        </div>
                    </div>
                    <?php
                        if(isset($DoctorRoomShow)){
                            RelationDoctorAndRoomShow($Email);
                        }
                        elseif(isset($DoctorRoomSelect)){
                            RelationDoctorAndRoomSelect($Email);
                        }
                    ?>
                </form>

            </div>
        </div>
        <!-- ===================================  form 1 ,4  =================================== -->
        


        <!-- ===================================  form 2 ,3  =================================== -->
        <div class="form-info">
            <div class="container d-flex">
                
        <!-- ============= form2 ============= -->
                <form class="col-6" action="editdoctor.php" method="post" style="border:2px solid #BBB;padding:20px;margin-right:5px;">
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
                    <div class="form-row justify-content-center">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorNurseSelect" class="btn btn-primary btn-lg">Select</button>
                        </div>
                        
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorNurseShow" class="btn btn-dark btn-lg">Show</button>
                        </div>
                    </div>
                    <?php
                        if(isset($DoctorNurseShow)){
                            RelationDoctorAndNurseShow($Email);
                        }
                        elseif(isset($DoctorNurseSelect)){
                            RelationDoctorAndNurseSelect($Email);
                        }
                    ?>
                </form>
                
                <!-- ============= form3 ============= -->
                <form class="col-6" action="editdoctor.php" method="post" style="border:2px solid #BBB;padding:20px;">
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
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientSelect" class="btn btn-primary btn-lg">Select</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientShow" class="btn btn-dark btn-lg">Show</button>
                        </div>
                    </div>
                    <?php
                        if(isset($DoctorPatientShow)){
                            RelationDoctorAndPatientShow($Email);
                        }
                        elseif(isset($DoctorPatientSelect)){
                            RelationDoctorAndPatientSelect($Email);
                        }
                    ?>
                </form>
                
                
                
            </div>
        </div>
        <!-- ===================================  form 2 ,3  =================================== -->





        
        
        
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