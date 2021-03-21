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
            @$DoctorNurseSend = $_POST["DoctorNurseSend"];
            @$DoctorNurseDelete = $_POST["DoctorNurseDelete"];
            @$DoctorNurseUpdate = $_POST["DoctorNurseUpdate"];
            @$DoctorNurseSelect = $_POST["DoctorNurseSelect"];
            @$DoctorNurseShow = $_POST["DoctorNurseShow"];
            @$DoctorPatientSend = $_POST["DoctorPatientSend"];
            @$DoctorPatientDelete = $_POST["DoctorPatientDelete"];
            @$DoctorPatientUpdate = $_POST["DoctorPatientUpdate"];
            @$DoctorPatientSelect = $_POST["DoctorPatientSelect"];
            @$DoctorPatientShow = $_POST["DoctorPatientShow"];
            @$DoctorRoomSend = $_POST["DoctorRoomSend"];
            @$DoctorRoomDelete = $_POST["DoctorRoomDelete"];
            @$DoctorRoomUpdate = $_POST["DoctorRoomUpdate"];
            @$DoctorRoomSelect = $_POST["DoctorRoomSelect"];
            @$DoctorRoomShow = $_POST["DoctorRoomShow"];
            if(isset($AppointmentsDoctorSend)){
                $DoctorName = $_POST["Doctor_Name"];
                $AppointmentsDate = $_POST["Appointments_Date"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT d.doc_id ,a.app_id FROM doctor d, appointments a where d.doc_name = '$DoctorName' and a.app_date = '$AppointmentsDate'");
                $n = mysql_num_rows($q);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                    $AppointmentsId = mysql_result($q,0,"app_id");
                }
                else{
                    
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
            echo "<script type='text/javascript'>alert('data added successfuly');</script>";
        }
        elseif($AppointmentsId == "" && $DoctorId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_doctor where doc_id = '$DoctorId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data added successfuly');</script>";
        }
        elseif($AppointmentsId != "" && $DoctorId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_appointments_and_doctor where app_id = '$AppointmentsId' and 
            doc_id = '$DoctorId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data added successfuly');</script>";
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
                        @$con = mysql_connect("sql109.eb2a.com","eb2a_24078768","")or die("error in connect to server");
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
                    echo"<div style='overflow-y:auto; height:300px ;' class='d-flex justify-content-center'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                    justify-content-center'>";
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
                        echo"<div style='overflow-y:auto; height:300px ;' class='d-flex justify-content-center'>";
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
        if(isset($DoctorNurseSend)){
            $DoctorName = $_POST["Doctor_Name"];
            $NurseName = $_POST["Nurse_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
            $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
            }
            else{
                $DoctorId = "" ;
             }
            if($x != 0){
                $NurseId = mysql_result($e,0,"nur_id");
            }
            else{
                $NurseId = "" ;
            }
            mysql_close($con);
            $Repeat = CheckRepeat($DoctorId,$NurseId,"relation_doctors_nursess");
            if($Repeat == true){
                if($DoctorId != "" && $NurseId != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("insert into relation_doctors_nursess(doc_id,nur_id)
                    values('$DoctorId','$NurseId')");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                }
                else{echo "<script type='text/javascript'>alert('error in input data');</script>";} 
            }
        else
            echo "<script type='text/javascript'>alert('error data repeat');</script>";   
        }
        elseif(isset($DoctorNurseDelete)){
            $DoctorName = $_POST["Doctor_Name"];
            $NurseName = $_POST["Nurse_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
            $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
            }
            else{
                $DoctorId = "" ;
             }
            if($x != 0){
                $NurseId = mysql_result($e,0,"nur_id");
            }
            else{
                $NurseId = "" ;
            }
            mysql_close($con);
            if($DoctorId == "" && $NurseId == "")
                echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
            elseif($DoctorId != "" && $NurseId == ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_doctors_nursess where doc_id = '$DoctorId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
            }
            elseif($DoctorId == "" && $NurseId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_doctors_nursess where nur_id = '$NurseId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
            }
            elseif($DoctorId != "" && $NurseId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_doctors_nursess where doc_id = '$DoctorId' and 
                nur_id = '$NurseId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
            }  
        }
        elseif(isset($DoctorNurseUpdate)){
                $DoctorName = $_POST["Doctor_Name"];
                $NurseName = $_POST["Nurse_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                }
                else{
                    $DoctorId = "" ;
                 }
                if($x != 0){
                    $NurseId = mysql_result($e,0,"nur_id");
                }
                else{
                    $NurseId = "" ;
                }
                mysql_close($con);
                $Update = $_POST["Update"];
                $BeforeUpdate = $_POST["BeforeUpdate"];
                if($Update == "DoctorId"){
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
                        if($DoctorId == "" || $NurseId == "" || $BeforeUpdate == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("UPDATE relation_doctors_nursess set doc_id = '$DoctorId' where
                            nur_id = '$NurseId' and doc_id = '$BeforeUpdate'");
                            mysql_close($con); 
                        }     
                    }
                elseif($Update == "NurseId"){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($e,0,"nur_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                        if($DoctorId == "" || $NurseId == "" || $BeforeUpdate == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("UPDATE relation_doctors_nursess set nur_id = '$NurseId' where
                            doc_id = '$DoctorId' and nur_id = '$BeforeUpdate'");
                            mysql_close($con); 
                        } 
                    }
                }
        function RelationDoctorAndNurseShow(){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id");
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px ;' class='d-flex justify-content-center'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        '>";
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
        function RelationDoctorAndNurseSelect(){
                    $DoctorName = $_POST["Doctor_Name"];
                    $NurseName = $_POST["Nurse_Name"];
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                    $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
                    $n = mysql_num_rows($q);
                    $x = mysql_num_rows($e);
                    if($n != 0){
                        $DoctorId = mysql_result($q,0,"doc_id");
                    }
                    else{
                        $DoctorId = "" ;
                     }
                    if($x != 0){
                        $NurseId = mysql_result($e,0,"nur_id");
                    }
                    else{
                        $NurseId = "" ;
                    }
                    mysql_close($con);
                    if($DoctorId == "" && $NurseId == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($DoctorId != "" && $NurseId == ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and r.doc_id = '$DoctorId'");
                        }  
                        elseif($DoctorId == "" && $NurseId != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and r.nur_id = '$NurseId'");
                        }
                        elseif($DoctorId != "" && $NurseId != ""){
                            $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,n.nur_id , n.nur_name ,n.nur_specialty,n.nur_degree ,n.nur_phone  FROM doctor d, nursess n , relation_doctors_nursess r where r.doc_id = d.doc_id and r.nur_id = n.nur_id and r.doc_id = '$DoctorId' and 
                            r.nur_id = '$NurseId'");
                        }
                        $n = mysql_num_rows($q);
                        if($n == 0)
                            echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                        else{
                            echo"<div style='overflow-y:auto; height:300px;' class='d-flex justify-content-center'>";
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
        if(isset($DoctorPatientSend)){
            $DoctorName = $_POST["Doctor_Name"];
            $PatientName = $_POST["Patient_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT d.doc_id ,p.patient_id FROM doctor d, patient p where d.doc_name = '$DoctorName' and p.patient_name = '$PatientName'");
            $n = mysql_num_rows($q);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
                $PatientId = mysql_result($q,0,"patient_id");
            }
            else{
                $DoctorId = "" ;
                $PatientId = "" ;
            }
            mysql_close($con);
            $Date = $_POST["Date"];
            $Diagnosis = $_POST["Diagnosis"];
            $PatientCure = $_POST["Patient_Cure"];
            $Repeat = CheckRepeat($DoctorId,$PatientId,"relation_doctor_and_patient");
            if($Repeat == true){
                if($DoctorId != "" && $PatientId != "" && $Date != "" && $Diagnosis != "" && $PatientCure != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("insert into relation_doctor_and_patient(doc_id,patient_id,date,diagnosis,patient_cure)
                    values('$DoctorId','$PatientId','$Date','$Diagnosis','$PatientCure')");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                }
            else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
            }
            else
                echo "<script type='text/javascript'>alert('error data repeat');</script>";   
        }
        elseif(isset($DoctorPatientDelete)){
            $DoctorName = $_POST["Doctor_Name"];
            $PatientName = $_POST["Patient_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
            $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $DoctorId = mysql_result($q,0,"doc_id");
            }
            else{
                $DoctorId = "" ;
             }
            if($x != 0){
                $PatientId = mysql_result($e,0,"patient_id");
            }
            else{
                $PatientId = "" ;
            }
            mysql_close($con);
            $Date = $_POST["Date"];
            if($DoctorId == "" && $PatientId == "" && $Date == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
            elseif($DoctorId != "" && $PatientId == "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where doc_id = '$DoctorId'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId == "" && $PatientId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where patient_id = '$PatientId'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId == "" && $PatientId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId != "" && $PatientId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where doc_id = '$DoctorId' and patient_id = '$PatientId'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId != "" && $PatientId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where doc_id = '$DoctorId' and date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId == "" && $PatientId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where patient_id = '$PatientId' and date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId != "" && $PatientId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctor_and_patient where doc_id = '$DoctorId' and patient_id = '$PatientId' 
                        and date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }   
        }
        elseif(isset($DoctorPatientUpdate)){
                $DoctorName = $_POST["Doctor_Name"];
                $PatientName = $_POST["Patient_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                }
                else{
                    $DoctorId = "" ;
                 }
                if($x != 0){
                    $PatientId = mysql_result($e,0,"patient_id");
                }
                else{
                    $PatientId = "" ;
                }
                mysql_close($con);
                $Date = $_POST["Date"];
                $Diagnosis = $_POST["Diagnosis"];
                $PatientCure = $_POST["Patient_Cure"];
                $Update = $_POST["Update"];
                if($Update == "DoctorId"){
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
                        if($DoctorId == "" || $PatientId == "" && $Date == "" && $Diagnosis == "" && $PatientCure == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($PatientId != "" && $Date == "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date != "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date == "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date == "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date != "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date == "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date == "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date != "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where date = '$Date' and
                                diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date != "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where date = '$Date' and
                                patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date == "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date != "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and date = '$Date' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date != "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and date = '$Date' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date == "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId == "" && $Date != "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where date = '$Date' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($PatientId != "" && $Date != "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set doc_id = '$DoctorId' where patient_id = '$PatientId' and date = '$Date' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
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
                        if($PatientId == "" || $DoctorId == "" && $Date == "" && $Diagnosis == "" && $PatientCure == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($DoctorId != "" && $Date == "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date != "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date == "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date == "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date != "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date == "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date == "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date != "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where date = '$Date' and
                                diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date != "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where date = '$Date' and
                                patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date == "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date != "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and date = '$Date' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date != "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and date = '$Date' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date == "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date != "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where date = '$Date' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date != "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_id = '$PatientId' where doc_id = '$DoctorId' and date = '$Date' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                        } 
                    }
                elseif($Update == "Date"){
                        if($Date == "" || $DoctorId == "" && $PatientId == "" && $Diagnosis == "" && $PatientCure == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($DoctorId != "" && $PatientId == "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Diagnosis == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Diagnosis != "" && $PatientCure == ""){;
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where patient_id = '$PatientId' and
                                diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where patient_id = '$PatientId' and
                                patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Diagnosis != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and patient_id = '$PatientId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Diagnosis == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and patient_id = '$PatientId' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where patient_id = '$PatientId' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Diagnosis != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set date = '$Date' where doc_id = '$DoctorId' and patient_id = '$PatientId' and diagnosis = '$Diagnosis' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                        } 
                    }
                elseif($Update == "Diagnosis"){
                        if($Diagnosis == "" || $DoctorId == "" && $PatientId == "" && $Date == "" && $PatientCure == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($DoctorId != "" && $PatientId == "" && $Date == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Date != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where
                                date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Date == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date == "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Date != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Date == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where patient_id = '$PatientId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where patient_id = '$PatientId' and
                                patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Date != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where 
                                date = '$Date' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date != "" && $PatientCure == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and patient_id = '$PatientId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date == "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and patient_id = '$PatientId' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Date != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and date = '$Date' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where patient_id = '$PatientId' and date = '$Date' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date != "" && $PatientCure != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set diagnosis = '$Diagnosis' where doc_id = '$DoctorId' and patient_id = '$PatientId' and date = '$Date' and patient_cure = '$PatientCure'");
                                mysql_close($con);
                            }
                        } 
                    }
                elseif($Update == "PatientCure"){
                        if($PatientCure == "" || $DoctorId == "" && $PatientId == "" && $Date == "" && $Diagnosis == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($DoctorId != "" && $PatientId == "" && $Date == "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date == "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Date != "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where
                                date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Date == "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where 
                                diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date == "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and patient_id = '$PatientId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Date != "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Date == "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date != "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where patient_id = '$PatientId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date == "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where patient_id = '$PatientId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId == "" && $Date != "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where 
                                date = '$Date' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date != "" && $Diagnosis == ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and patient_id = '$PatientId' and date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date == "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and patient_id = '$PatientId' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId == "" && $Date != "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and date = '$Date' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != "" && $Date != "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where patient_id = '$PatientId' and date = '$Date' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != "" && $Date != "" && $Diagnosis != ""){
                                $q = mysql_query("UPDATE relation_doctor_and_patient set patient_cure = '$PatientCure' where doc_id = '$DoctorId' and patient_id = '$PatientId' and date = '$Date' and diagnosis = '$Diagnosis'");
                                mysql_close($con);
                            }
                        } 
                    }

                }
        function RelationDoctorAndPatientShow(){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id = p.patient_id");
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px' class='d-flex justify-content-center'>";
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
        function RelationDoctorAndPatientSelect(){
                    $DoctorName = $_POST["Doctor_Name"];
                    $PatientName = $_POST["Patient_Name"];
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                    $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
                    $n = mysql_num_rows($q);
                    $x = mysql_num_rows($e);
                    if($n != 0){
                        $DoctorId = mysql_result($q,0,"doc_id");
                    }
                    else{
                        $DoctorId = "" ;
                     }
                    if($x != 0){
                        $PatientId = mysql_result($e,0,"patient_id");
                    }
                    else{
                        $PatientId = "" ;
                    }
                    mysql_close($con);
                    $Date = $_POST["Date"];
                    if($DoctorId == "" && $PatientId == "" && $Date == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                    elseif($DoctorId != "" && $PatientId == "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and 
                        r.doc_id = '$DoctorId'");
                        mysql_close($con);
                    }
                    elseif($DoctorId == "" && $PatientId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and 
                        r.patient_id = '$PatientId'");
                        mysql_close($con);
                    }
                    elseif($DoctorId == "" && $PatientId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and r.date = '$Date'");
                        mysql_close($con);
                    }
                    elseif($DoctorId != "" && $PatientId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and 
                        r.doc_id = '$DoctorId' and r.patient_id = '$PatientId'");
                        mysql_close($con);
                    }
                    elseif($DoctorId != "" && $PatientId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and 
                        r.doc_id = '$DoctorId' and r.date = '$Date'");
                        mysql_close($con);
                    }
                    elseif($DoctorId == "" && $PatientId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and r.patient_id = '$PatientId' and r.date = '$Date'");
                        mysql_close($con);
                    }
                    elseif($DoctorId != "" && $PatientId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address ,r.date ,r.diagnosis ,r.patient_cure FROM doctor d, patient p , relation_doctor_and_patient r where r.doc_id = d.doc_id and r.patient_id =p.patient_id and r.doc_id = '$DoctorId' and r.patient_id = '$PatientId' and r.date = '$Date'");
                        mysql_close($con);
                    }
                        $n = mysql_num_rows($q);
                        if($n == 0)
                            echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                        else{
                            echo"<div style='overflow-y:auto; height:300px' class='d-flex justify-content-center'>";
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

                    }
            if(isset($DoctorRoomSend)){
                $DoctorName = $_POST["Doctor_Name"];
                $RoomName = $_POST["Room_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                $e = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                }
                else{
                    $DoctorId = "" ;
                 }
                if($x != 0){
                    $RoomId = mysql_result($e,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                }
                mysql_close($con);
            $Date = $_POST["Date"];
            $Repeat = CheckRepeat($DoctorId,$RoomId,"relation_doctors_room");
            if($Repeat == true){
                if($DoctorId != "" && $RoomId != "" && $Date != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("insert into relation_doctors_room(Doctor_id,Room_id,Date)
                    values('$DoctorId','$RoomId','$Date')");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                }
            else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
            }
            else
                echo "<script type='text/javascript'>alert('error data repeat');</script>";   
        }
        elseif(isset($DoctorRoomDelete)){
            $DoctorName = $_POST["Doctor_Name"];
                $RoomName = $_POST["Room_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                $e = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                }
                else{
                    $DoctorId = "" ;
                 }
                if($x != 0){
                    $RoomId = mysql_result($e,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                }
                mysql_close($con);
            $Date = $_POST["Date"];
            if($DoctorId == "" && $RoomId == "" && $Date == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
            elseif($DoctorId != "" && $PatientId == "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctors_room where Doctor_id = '$DoctorId'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId == "" && $RoomId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctors_room where Room_id = '$RoomId'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId == "" && $RoomId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctors_room where Date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId != "" && $RoomId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctors_room where Doctor_id = '$DoctorId' and Room_id = '$RoomId'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId != "" && $RoomId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from room where Doctor_id = '$DoctorId' and Date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId == "" && $RoomId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctors_room where Room_id = '$RoomId' and Date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }
            elseif($DoctorId != "" && $RoomId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("delete from relation_doctors_room where Doctor_id = '$DoctorId' and Room_id = '$RoomId' 
                        and Date = '$Date'");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                    }   
        }
        elseif(isset($DoctorRoomUpdate)){
                $DoctorName = $_POST["Doctor_Name"];
                $RoomName = $_POST["Room_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                $e = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                }
                else{
                    $DoctorId = "" ;
                 }
                if($x != 0){
                    $RoomId = mysql_result($e,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                }
                mysql_close($con);
                $Date = $_POST["Date"];
                $Update = $_POST["Update"];
                $BeforeUpdate = $_POST["BeforeUpdate"];
                if($Update == "DoctorId"){
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
                        if($DoctorId == "" || $RoomId == "" && $Date == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($RoomId != "" && $Date == ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Doctor_id = '$DoctorId' where Room_id = '$RoomId'");
                                mysql_close($con);
                            }
                            elseif($RoomId == "" && $Date != ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Doctor_id = '$DoctorId' where Date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($RoomId != "" && $Date != ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Doctor_id = '$DoctorId' where Room_id = '$RoomId' and Date = '$Date'");
                                mysql_close($con);
                            }
                        }
                    }
                elseif($Update == "RoomId"){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $e = mysql_query("SELECT room_id FROM room where room_name = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($e,0,"room_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                        if($RoomId == "" || $DoctorId == "" && $Date == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($DoctorId != "" && $Date == ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Room_id = '$RoomId' where Doctor_id = '$DoctorId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $Date != ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Room_id = '$RoomId' where Date = '$Date'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $Date != ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Room_id = '$RoomId' where Doctor_id = '$DoctorId' and Date = '$Date'");
                                mysql_close($con);
                            }
                        }
                }
                
                elseif($Update == "Date"){
                        if($Date == "" || $DoctorId == "" && $PatientId == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($DoctorId != "" && $PatientId == ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Date = '$Date' where Doctor_id = '$DoctorId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId == "" && $PatientId != ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Date = '$Date' where Room_id = '$RoomId'");
                                mysql_close($con);
                            }
                            elseif($DoctorId != "" && $PatientId != ""){
                                $q = mysql_query("UPDATE relation_doctors_room set Date = '$Date' where Doctor_id = '$DoctorId' and Room_id = '$RoomId'");
                                mysql_close($con);
                            }
                        } 
                    }
                }
        function RelationDoctorAndRoomShow(){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id");
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px' class='d-flex justify-content-center'>";
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
        function RelationDoctorAndRoomSelect(){
                    $DoctorName = $_POST["Doctor_Name"];
                $RoomName = $_POST["Room_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT doc_id FROM doctor where doc_name = '$DoctorName'");
                $e = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $DoctorId = mysql_result($q,0,"doc_id");
                }
                else{
                    $DoctorId = "" ;
                 }
                if($x != 0){
                    $RoomId = mysql_result($e,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                }
                mysql_close($con);
                    $Date = $_POST["Date"];
                    if($DoctorId == "" && $RoomId == "" && $Date == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                    elseif($DoctorId != "" && $RoomId == "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Doctor_id = '$DoctorId'");
                        mysql_close($con);
                    }
                    elseif($DoctorId == "" && $RoomId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Room_id = '$RoomId'");
                        mysql_close($con);
                    }
                    elseif($DoctorId == "" && $RoomId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Date = '$Date'");
                        mysql_close($con);
                    }
                    elseif($DoctorId != "" && $RoomId != "" && $Date == ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Doctor_id = '$DoctorId' and r.Room_id = '$RoomId'");
                        mysql_close($con);
                    }
                    elseif($DoctorId != "" && $RoomId == "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Doctor_id = '$DoctorId' and r.Date = '$Date'");
                        mysql_close($con);
                    }
                    elseif($DoctorId == "" && $RoomId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Room_id = '$RoomId' and r.Date = '$Date'");
                        mysql_close($con);
                    }
                    elseif($DoctorId != "" && $RoomId != "" && $Date != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT d.doc_id , d.doc_name , d.doc_specialty , d.doc_phone ,d.doc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type ,r.Date FROM doctor d, room , relation_doctors_room r where r.Doctor_id = d.doc_id and r.Room_id = room.room_id and r.Doctor_id = '$DoctorId' and r.Room_id = '$RoomId' and r.Date = '$Date'");
                        mysql_close($con);
                    }
                        $n = mysql_num_rows($q);
                        if($n == 0)
                            echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                        else{
                            echo"<div style='overflow-y:auto; height:300px' class='d-flex justify-content-center'>";
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
            function CheckRepeat($FirstId,$SecondId,$Table){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                if($Table == "relation_appointments_and_doctor"){
                    $q = mysql_query("select * from relation_appointments_and_doctor where app_id = '$FirstId' and doc_id = '$SecondId'");
                }
                elseif($Table == "relation_doctors_nursess"){
                    $q = mysql_query("select * from relation_doctors_nursess where doc_id = '$FirstId' and nur_id = '$SecondId'");
                }
                elseif($Table == "relation_doctor_and_patient"){
                    $q = mysql_query("select * from relation_doctor_and_patient where doc_id = '$FirstId' and patient_id = '$SecondId'");
                }
                else{
                    $q = mysql_query("select * from relation_doctors_room where Doctor_id = '$FirstId' and Room_id = '$SecondId'");
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

       
        
        
        
        
        <!-- button 
        <div class="rel d-flex justify-content-center">
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel1()">Show Rel 1</button>
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel2()">Show Rel 2</button>
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel3()">Show Rel 3</button>
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel4()">Show Rel 4</button>

        </div>
        <!-- button -->
        
        
        
        
        
        
        
        
        
        
        <!-- ============= form 1, 2 ============= -->
        <div class="form-info">
            <div class="container">
                
                <!-- ============= form1 ============= -->
                <form id="form-1" action="rel-doctors.php" method="post" style="border:2px solid #BBB;padding:20px;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Appointment date</label>
                            <input type="date" name="Appointments_Date" class="form-control">
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
                            <button type="submit" name="AppointmentsDoctorSelect" class="btn btn-primary btn-lg col">Select</button><br>
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
                            <button type="submit" name="AppointmentsDoctorSend" class="btn btn-success btn-lg col">Insert</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsDoctorDelete" class="btn btn-danger btn-lg col">Remove</button><br>
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
                <form id="form-2" action="rel-doctors.php" method="post" style="border:2px solid #BBB;padding:20px;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Doctor Name</label>
                            <input type="text" name="Doctor_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Nurse Name</label>
                            <input type="text" name="Nurse_Name" class="form-control">
                        </div>
                    </div>
                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorNurseSelect" class="btn btn-primary btn-lg col">Select</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorNurseShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="DoctorNurseUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorNurseSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorNurseDelete" class="btn btn-danger btn-lg col">Remove</button>
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
                                <option value="DoctorId" selected>DoctorName</option>
                                <option value="NurseId">NurseName</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->

                    <?php
                        if(isset($DoctorNurseShow)){
                            RelationDoctorAndNurseShow();
                        }
                        elseif(isset($DoctorNurseSelect)){
                            RelationDoctorAndNurseSelect();
                        }
                    ?>
                </form>      
            
            </div>
        </div>
        <!-- ============= form 1, 2 ============= -->
        
        
        
        
        
        
        
        
        <!-- ============= form 3,4 ============= -->
        <div class="form-info">
            <div class="container">
                
                <!-- ============= form3 ============= -->
                <form id="form-3" action="rel-doctors.php" method="post" style="border:2px solid #BBB;padding:20px;">
                    
                    <div class="form-row">
                        <div class="form-group col" class="form-control">
                            <label>Doctor Name</label>
                            <input type="text" name="Doctor_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Patient Name</label> 
                            <input type="text" name="Patient_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Date</label> 
                            <input type="date" name="Date" class="form-control">
                        </div>

                        <div class="form-group col">
                            <label>Diagnosis</label>
                            <input type="text" name="Diagnosis" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label>PatientCare</label> 
                            <input type="text" name="Patient_Cure" class="form-control">
                        </div>
                    </div>

                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientSelect" class="btn btn-primary btn-lg col">Select</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="DoctorPatientUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientSend" class="btn btn-success btn-lg col">Insert</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientDelete" class="btn btn-danger btn-lg col">Remove</button><br>
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
                                <option value="DoctorId" selected>DoctorName</option>
                                <option value="PatientId">PatientName</option>
                                <option value="Date">Date</option>
                                <option value="Diagnosis">Diagnosis</option>
                                <option value="PatientCure">PatientCure</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->

                    <?php
                        if(isset($DoctorPatientShow)){
                            RelationDoctorAndPatientShow();
                        }
                        elseif(isset($DoctorPatientSelect)){
                            RelationDoctorAndPatientSelect();
                        }
                    ?>
                </form>
                
                
               
                
                <!-- ============= form4 ============= -->
                <form id="form-4" action="rel-doctors.php" method="post" style="border:2px solid #BBB;padding:20px;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Doctor Name</label>
                            <input type="text" name="Doctor_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>RoomName</label>
                            <input type="text" name="Room_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Date</label>
                            <input type="date" name="Date" class="form-control">
                        </div>
                    </div>

                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomSelect" class="btn btn-primary btn-lg col">Select</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="DoctorRoomUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomSend" class="btn btn-success btn-lg col">Send</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomDelete" class="btn btn-danger btn-lg col">Delete</button><br>
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
                                <option value="DoctorId" selected>DoctorName</option>
                                <option value="RoomId">RoomName</option>
                                <option value="Date">Date</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->

                    <?php
                        if(isset($DoctorRoomShow)){
                            RelationDoctorAndRoomShow();
                        }
                        elseif(isset($DoctorRoomSelect)){
                            RelationDoctorAndRoomSelect();
                        }
                    ?>
                </form>      
            
            </div>
        </div>
        <!-- ============= form 3, 4 ============= -->
        
            
         
        
        

        
                
        
        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>        
        
        