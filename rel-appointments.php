<!DOCTYPE html>
<html>
    <head>


        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>H-care</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
        <link rel="stylesheet" href="css/main.css" />
        <?php
            @$AppointmentsDoctorSend = $_POST["AppointmentsDoctorSend"];
            @$AppointmentsDoctorDelete = $_POST["AppointmentsDoctorDelete"];
            @$AppointmentsDoctorUpdate = $_POST["AppointmentsDoctorUpdate"];
            @$AppointmentsDoctorSelect = $_POST["AppointmentsDoctorSelect"];
            @$AppointmentsDoctorShow = $_POST["AppointmentsDoctorShow"];
            @$AppointmentsPatientSend = $_POST["AppointmentsPatientSend"];
            @$AppointmentsPatientDelete = $_POST["AppointmentsPatientDelete"];
            @$AppointmentsPatientUpdate = $_POST["AppointmentsPatientUpdate"];
            @$AppointmentsPatientSelect = $_POST["AppointmentsPatientSelect"];
            @$AppointmentsPatientShow = $_POST["AppointmentsPatientShow"];
            if(isset($AppointmentsDoctorSend)){
                $DoctorName = $_POST["Doctor_Name"];
                $AppointmentsName = $_POST["Appointments_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT d.doc_id ,a.app_id FROM doctor d, appointments a where d.doc_name = '$DoctorName' and a.app_date = '$AppointmentsName'");
                $n = mysql_num_rows($q);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                    $AppointmentsId = mysql_result($q,0,"app_id");
                }
                else{
                    $DoctorId = "" ;
                    $AppointmentsId = "" ;
                }
                mysql_close($con);
                $Repeat = CheckRepeat($AppointmentsId,$DoctorId,"relation_appointments_and_doctor");
                if($Repeat == true){
                    if($AppointmentsId != "" && $DoctorId != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into relation_appointments_and_doctor(app_id,doc_id) values ('$AppointmentsId','$DoctorId')");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";} 
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
            }
    elseif(isset($AppointmentsDoctorDelete)){
            $DoctorName = $_POST["Doctor_Name"];
            $AppointmentsName = $_POST["Appointments_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
            $e = mysql_query("SELECT app_id FROM appointments where app_date = '$AppointmentsName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
            }
            else{
                $DoctorId = "" ;
             }
            if($x != 0){
                $AppointmentsId = mysql_result($e,0,"app_id");
            }
            else{
                $AppointmentsId = "" ;
            }
            mysql_close($con);
        if($AppointmentsId == "" && $DoctorId == "")
            echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
        elseif($AppointmentsId != "" && $DoctorId == ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_doctor where app_id = '$AppointmentsId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }
        elseif($AppointmentsId == "" && $DoctorId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_doctor where doc_id = '$DoctorId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }
        elseif($AppointmentsId != "" && $DoctorId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_doctor where app_id = '$AppointmentsId' and 
            doc_id = '$DoctorId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }    
    }
    elseif(isset($AppointmentsDoctorUpdate)){
            $DoctorName = $_POST["Doctor_Name"];
            $AppointmentsName = $_POST["Appointments_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
            $e = mysql_query("SELECT app_id FROM appointments where app_date = '$AppointmentsName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
            }
            else{
                $DoctorId = "" ;
             }
            if($x != 0){
                $AppointmentsId = mysql_result($e,0,"app_id");
            }
            else{
                $AppointmentsId = "" ;
            }
            mysql_close($con);
            $Update = $_POST["Update"];
            $BeforeUpdate = $_POST["BeforeUpdate"];
            if($Update == "AppointmentsId"){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $e = mysql_query("SELECT app_id FROM appointments where app_date '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($e,0,"app_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                    if($AppointmentsId == "" || $DoctorId == "" || $BeforeUpdate == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("UPDATE relation_appointments_and_doctor set app_id = '$AppointmentsId' where
                        doc_id = '$DoctorId' and app_id = '$BeforeUpdate'");
                        mysql_close($con);
                    }     
                }
            elseif($Update == "DoctorId"){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $e = mysql_query("SELECT doc_id FROM doctor where doc_name = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($e,0,"doc_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                    if($AppointmentsId == "" || $DoctorId == "" || $BeforeUpdate == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("UPDATE relation_appointments_and_doctor set doc_id = '$DoctorId' where
                        app_id = '$AppointmentsId' and doc_id = '$BeforeUpdate'");
                        mysql_close($con);
                    } 
                }
            }
    function RelationAppointmentsAndDoctorShow(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id");
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
    function RelationAppointmentsAndDoctorSelect(){
                $DoctorName = $_POST["Doctor_Name"];
            $AppointmentsName = $_POST["Appointments_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
            $e = mysql_query("SELECT app_id FROM appointments where app_date = '$AppointmentsName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
            }
            else{
                $DoctorId = "" ;
             }
            if($x != 0){
                $AppointmentsId = mysql_result($e,0,"app_id");
            }
            else{
                $AppointmentsId = "" ;
            }
            mysql_close($con);
                if($AppointmentsId == "" && $DoctorId == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($AppointmentsId != "" && $DoctorId == ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and r.app_id = '$AppointmentsId'");
                    }  
                    elseif($AppointmentsId == "" && $DoctorId != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and r.doc_id = '$DoctorId'");
                    }
                    elseif($AppointmentsId != "" && $DoctorId != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,d.doc_id ,d.doc_name , d.doc_specialty ,d.doc_phone , d.doc_address FROM appointments a, doctor d , relation_appointments_and_doctor r where r.app_id = a.app_id and r.doc_id = d.doc_id and r.app_id = '$AppointmentsId' and 
                        r.doc_id = '$DoctorId'");
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
    if(isset($AppointmentsPatientSend)){
        $AppointmentsDate = $_POST["Appointments_Date"];
        $PatientName = $_POST["Patient_Name"];
        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
        $db = mysql_select_db("project")or die("error to connect to database");
        $q = mysql_query("SELECT a.app_id ,p.patient_id FROM appointments a, patient p where a.app_date = '$AppointmentsDate' and p.patient_name = '$PatientName'");
        $n = mysql_num_rows($q);
        if($n != 0){
            $AppointmentsId = mysql_result($q,0,"app_id");
            $PatientId = mysql_result($q,0,"patient_id");
        }
        else{
            $AppointmentsId = "" ;
            $PatientId = "" ;
        }
        mysql_close($con);
        $Repeat = CheckRepeat($AppointmentsId,$PatientId,"relation_appointments_and_patient");
        if($Repeat == true){
            if($AppointmentsId != "" && $PatientId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("insert into relation_appointments_and_patient(app_id,patient_id)
                values('$AppointmentsId','$PatientId')");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data added successfuly');</script>";
            }
            else{echo "<script type='text/javascript'>alert('error in input data');</script>";} 
        }
        else
            echo "<script type='text/javascript'>alert('error data repeat');</script>";
    }
    elseif(isset($AppointmentsPatientDelete)){
        $AppointmentsDate = $_POST["Appointments_Date"];
        $PatientName = $_POST["Patient_Name"];
        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
        $db = mysql_select_db("project")or die("error to connect to database");
        $q = mysql_query("SELECT app_id FROM appointments where app_date = '$AppointmentsDate'");
        $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
        $n = mysql_num_rows($q);
        $x = mysql_num_rows($e);
        if($n != 0){
            $AppointmentsId = mysql_result($q,0,"app_id");
        }
        else{
            $AppointmentsId = "" ;
         }
        if($x != 0){
            $PatientId = mysql_result($e,0,"patient_id");
        }
        else{
            $PatientId = "" ;
        }
        mysql_close($con);
        if($AppointmentsId == "" && $PatientId == "")
            echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
        elseif($AppointmentsId != "" && $PatientId == ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_patient where app_id = '$AppointmentsId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }
        elseif($AppointmentsId == "" && $PatientId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_patient where patient_id = '$PatientId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }
        elseif($AppointmentsId != "" && $PatientId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_patient where app_id = '$AppointmentsId' and 
            patient_id = '$PatientId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        } 
    }
    elseif(isset($AppointmentsPatientUpdate)){
            $AppointmentsDate = $_POST["Appointments_Date"];
            $PatientName = $_POST["Patient_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT app_id FROM appointments where app_date = '$AppointmentsDate'");
            $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $AppointmentsId = mysql_result($q,0,"app_id");
            }
            else{
                $AppointmentsId = "" ;
             }
            if($x != 0){
                $PatientId = mysql_result($e,0,"patient_id");
            }
            else{
                $PatientId = "" ;
            }
            mysql_close($con);
            $Update = $_POST["Update"];
            $BeforeUpdate = $_POST["BeforeUpdate"];
            if($Update == "AppointmentsId"){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT app_id FROM appointments where app_date = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($q,0,"app_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                    if($AppointmentsId == "" || $PatientId == "" || $BeforeUpdate == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("UPDATE relation_appointments_and_patient set app_id = '$AppointmentsId' where
                        patient_id = '$PatientId' and app_id = '$BeforeUpdate'");
                        mysql_close($con);
                    }     
                }
            elseif($Update == "PatientId"){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($e,0,"patient_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                    if($AppointmentsId == "" || $PatientId == "" || $BeforeUpdate == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("UPDATE relation_appointments_and_patient set patient_id = '$PatientId' where
                        app_id = '$AppointmentsId' and patient_id = '$BeforeUpdate'");
                        mysql_close($con);
                    } 
                }
            }
    function RelationAppointmentsAndPatientShow(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM appointments a, patient p , relation_appointments_and_patient r where r.app_id = a.app_id and r.patient_id = p.patient_id");
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
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                    echo"</tr>";
                    

                    for($i=0;$i<$n;$i++){
                        $AppId = mysql_result($q,$i,"app_id");
                        $AppDate = mysql_result($q,$i,"app_date");
                        $AppType = mysql_result($q,$i,"app_type");
                        $AppDoctors = mysql_result($q,$i,"app_doctors");
                        $PatientId = mysql_result($q,$i,"patient_id");
                        $PatientName = mysql_result($q,$i,"patient_name");
                        $PatientPhone = mysql_result($q,$i,"patient_phone");
                        $PatientAddress = mysql_result($q,$i,"patient_address");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AppId</td> <td style='border: 2px solid #ddd; padding:10px'>$AppDate</td> <td style='border: 2px solid #ddd; padding:10px'>$AppType</td> 
                        <td style='border: 2px solid #ddd; padding:10px'>$AppDoctors</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td></tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
            }
    function RelationAppointmentsAndPatientSelect(){
                $AppointmentsDate = $_POST["Appointments_Date"];
                $PatientName = $_POST["Patient_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT app_id FROM appointments where app_date = '$AppointmentsDate'");
                $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $AppointmentsId = mysql_result($q,0,"app_id");
                }
                else{
                    $AppointmentsId = "" ;
                 }
                if($x != 0){
                    $PatientId = mysql_result($e,0,"patient_id");
                }
                else{
                    $PatientId = "" ;
                }
                mysql_close($con);
                if($AppointmentsId == "" && $PatientId == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($AppointmentsId != "" && $PatientId == ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM appointments a, patient p , relation_appointments_and_patient r where r.app_id = a.app_id and r.patient_id = p.patient_id and r.app_id = '$AppointmentsId'");
                    }  
                    elseif($AppointmentsId == "" && $PatientId != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM appointments a, patient p , relation_appointments_and_patient r where r.app_id = a.app_id and r.patient_id = p.patient_id and r.patient_id = '$PatientId'");
                    }
                    elseif($AppointmentsId != "" && $PatientId != ""){
                        $q = mysql_query("SELECT a.app_id , a.app_date , a.app_type , a.app_doctors ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM appointments a, patient p , relation_appointments_and_patient r where r.app_id = a.app_id and r.patient_id = p.patient_id and r.app_id = '$AppointmentsId' and 
                        r.patient_id = '$PatientId'");
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
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"</tr>";
                    
                    
                        for($i=0;$i<$n;$i++){
                            $AppId = mysql_result($q,$i,"app_id");
                            $AppDate = mysql_result($q,$i,"app_date");
                            $AppType = mysql_result($q,$i,"app_type");
                            $AppDoctors = mysql_result($q,$i,"app_doctors");
                            $PatientId = mysql_result($q,$i,"patient_id");
                            $PatientName = mysql_result($q,$i,"patient_name");
                            $PatientPhone = mysql_result($q,$i,"patient_phone");
                            $PatientAddress = mysql_result($q,$i,"patient_address");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AppId</td> <td style='border: 2px solid #ddd; padding:10px'>$AppDate</td> <td style='border: 2px solid #ddd; padding:10px'>$AppType</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$AppDoctors</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td></tr>";
                        }
                    
                        echo"</table>";
                        echo"</div>";
                    }
                
                    mysql_close($con);
                }
            }
            function CheckRepeat($FirstId,$SecondId,$Table){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                if($Table == "relation_appointments_and_doctor"){
                    $q = mysql_query("select * from relation_appointments_and_doctor where app_id = '$FirstId' and doc_id = '$SecondId'");
                }
                else{
                    $q = mysql_query("select * from relation_appointments_and_patient where app_id = '$FirstId' and patient_id = '$SecondId'");
                }
                $n = mysql_num_rows($q);
                mysql_close($con);
                if($n == 0)
                    return true;
                else
                    return false;
                }
        ?>
    </head>
    <body style="background-color:#f0f5f8;">


        
        
        
        <!-- button -->
        <div class="rel d-flex justify-content-center">
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel1()">Show Rel 1</button>
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel2()">Show Rel 2</button>
        </div>
        <!-- button -->
        
        
        
        
        
        
        <!-- ============= form 1, 2 ============= -->
        <div class="form-info">
            <div class="container">
                
                <!-- ============= form1 ============= -->
                <form id="form-1" action="rel-appointments.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Appointment Date</label>
                          <input type="date" class="form-control" id="" placeholder="Appointment date" name="Appointments_Name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Doctor Name</label>
                            <input type="text" name="Doctor_Name" class="form-control">
                        </div>
                    </div>
                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorSelect" class="btn btn-primary btn-lg col">Select</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="AppointmentsDoctorUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorDelete" class="btn btn-danger btn-lg col">Remove</button>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" name="BeforeUpdate" placeholder="Value before update" class="form-control">
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row3 -->
                    <div class="form-row">
                        <div class="form-group col-6 offset-6">
                            <select name="Update" class="custom-select">
                                <option value="AppointmentsId" selected>AppointmentsDate</option>
                                <option value="DoctorId">DoctorName</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                    
                    <?php
                        if(isset($AppointmentsDoctorShow)){
                            RelationAppointmentsAndDoctorShow();
                        }
                        elseif(isset($AppointmentsDoctorSelect)){
                            RelationAppointmentsAndDoctorSelect();
                        }
                    ?>
                </form>
                
                

            
            
            
                <!-- ============= form2 ============= -->
                <form id="form-2" action="rel-appointments.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Appointment Date</label>
                          <input type="date" class="form-control" id="" placeholder="Appointment date" name="Appointments_Date">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Patient Name</label>
                            <input type="text" name="Patient_Name" class="form-control">
                        </div>
                    </div>
                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsPatientSelect" class="btn btn-primary btn-lg col">Select</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsPatientShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="AppointmentsPatientUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsPatientSend" class="btn btn-success btn-lg col">Insert</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsPatientDelete" class="btn btn-danger btn-lg col">Remove</button><br>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" name="BeforeUpdate" placeholder="Value before update" class="form-control">
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row3 -->
                    <div class="form-row">
                        <div class="form-group col-6 offset-6">
                            <select name="Update" class="custom-select">
                                <option value="AppointmentsId" selected>AppointmentsId</option>
                                <option value="PatientId">PatientName</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                    
                    <?php
                        if(isset($AppointmentsPatientShow)){
                            RelationAppointmentsAndPatientShow();
                        }
                        elseif(isset($AppointmentsPatientSelect)){
                            RelationAppointmentsAndPatientSelect();
                        }
                    ?>
                </form>
       
            
            </div>
        </div>
        
        
        

                
        
        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>        
        
        