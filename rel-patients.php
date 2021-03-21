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
            
            @$AccountPatientSend = $_POST["AccountPatientSend"];
            @$AccountPatientDelete = $_POST["AccountPatientDelete"];
            @$AccountPatientUpdate = $_POST["AccountPatientUpdate"];
            @$AccountPatientSelect = $_POST["AccountPatientSelect"];
            @$AccountPatientShow = $_POST["AccountPatientShow"];
            @$AppointmentsPatientSend = $_POST["AppointmentsPatientSend"];
            @$AppointmentsPatientDelete = $_POST["AppointmentsPatientDelete"];
            @$AppointmentsPatientUpdate = $_POST["AppointmentsPatientUpdate"];
            @$AppointmentsPatientSelect = $_POST["AppointmentsPatientSelect"];
            @$AppointmentsPatientShow = $_POST["AppointmentsPatientShow"];
            @$DoctorPatientSend = $_POST["DoctorPatientSend"];
            @$DoctorPatientDelete = $_POST["DoctorPatientDelete"];
            @$DoctorPatientUpdate = $_POST["DoctorPatientUpdate"];
            @$DoctorPatientSelect = $_POST["DoctorPatientSelect"];
            @$DoctorPatientShow = $_POST["DoctorPatientShow"];
            @$PatientRoomSend = $_POST["PatientRoomSend"];
            @$PatientRoomDelete = $_POST["PatientRoomDelete"];
            @$PatientRoomUpdate = $_POST["PatientRoomUpdate"];
            @$PatientRoomSelect = $_POST["PatientRoomSelect"];
            @$PatientRoomShow = $_POST["PatientRoomShow"];
            if(isset($AccountPatientSend)){
                $AccountName = $_POST["Account_Name"];
                $PatientName = $_POST["Patient_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT a.acc_id ,p.patient_id FROM accounts a, patient p where a.acc_name = '$AccountName' and p.patient_name = '$PatientName'");
                $n = mysql_num_rows($q);
                if($n != 0){
                    $AccountId = mysql_result($q,0,"acc_id");
                    $PatientId = mysql_result($q,0,"patient_id");
                }
                else{
                    $AccountId = "" ;
                    $PatientId = "" ;
                }
                mysql_close($con);
                $Repeat = CheckRepeat($AccountId,$PatientId,"relation_accounts_and_patient");
                if($Repeat == true){
                    if($AccountId != "" && $PatientId != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into relation_accounts_and_patient(acc_id,patient_id) values ('$AccountId','$PatientId')");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";
                }
        if(isset($AccountPatientDelete)){
            $AccountName = $_POST["Account_Name"];
            $PatientName = $_POST["Patient_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$AccountName'");
            $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $AccountId = mysql_result($q,0,"acc_id");
            }
            else{
                $AccountId = "" ;
             }
            if($x != 0){
                    $PatientId = mysql_result($e,0,"patient_id");
                }
                else{
                    $PatientId = "" ;
                }
            mysql_close($con);
            if($AccountId == "" && $PatientId == "")
                echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
            
            elseif($AccountId != "" && $PatientId == ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_accounts_and_patient where acc_id = '$AccountId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data added successfuly');</script>";
            }
            elseif($AccountId == "" && $PatientId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_accounts_and_patient where patient_id = '$PatientId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data added successfuly');</script>";
            }
            elseif($AccountId != "" && $PatientId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_accounts_and_patient where acc_id = '$AccountId' and patient_id = '$PatientId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data added successfuly');</script>";
            }  
        }
        elseif(isset($AccountPatientUpdate)){
               $AccountName = $_POST["Account_Name"];
                $PatientName = $_POST["Patient_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$AccountName'");
                $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $AccountId = mysql_result($q,0,"acc_id");
                }
                else{
                    $AccountId = "" ;
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
                if($Update == "AccountId"){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($q,0,"acc_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                        if($AccountId == "" || $PatientId == "" || $BeforeUpdate =="")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("UPDATE relation_accounts_and_patient set acc_id = '$AccountId' where
                            patient_id = '$PatientId' and acc_id = '$BeforeUpdate'");
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
                        if($AccountId == "" || $PatientId == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("UPDATE relation_accounts_and_patient set patient_id = '$PatientId' where
                            acc_id = '$AccountId' and patient_id = '$BeforeUpdate'");
                            mysql_close($con);
                        } 
                    }
                }
        function RelationAccountsAndPatientShow(){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM accounts a, patient p, relation_accounts_and_patient r where r.acc_id = a.acc_id and r.patient_id = p.patient_id");
                    $n = mysql_num_rows($q);

                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $AccId = mysql_result($q,$i,"acc_id");
                            $AccName = mysql_result($q,$i,"acc_name");
                            $AccPhone = mysql_result($q,$i,"acc_phone");
                            $AccAddress = mysql_result($q,$i,"acc_address");
                            $PatientId = mysql_result($q,$i,"patient_id");
                            $PatientName = mysql_result($q,$i,"patient_name");
                            $Patientphone = mysql_result($q,$i,"patient_phone");
                            $PatientAddress = mysql_result($q,$i,"patient_address");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AccId</td> <td style='border: 2px solid #ddd; padding:10px'>$AccName</td> <td style='border: 2px solid #ddd; padding:10px'>$AccPhone</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$AccAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$Patientphone</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td> </tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }

                    mysql_close($con);
                }
        function RelationAccountsAndPatientSelect(){
                    $AccountName = $_POST["Account_Name"];
                    $PatientName = $_POST["Patient_Name"];
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$AccountName'");
                    $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
                    $n = mysql_num_rows($q);
                    $x = mysql_num_rows($e);
                    if($n != 0){
                        $AccountId = mysql_result($q,0,"acc_id");
                    }
                    else{
                        $AccountId = "" ;
                     }
                    if($x != 0){
                            $PatientId = mysql_result($e,0,"patient_id");
                        }
                        else{
                            $PatientId = "" ;
                        }
                    mysql_close($con);
                    if($AccountId == "" && $PatientId == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($AccountId != "" && $PatientId == ""){
                            $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM accounts a, patient p, relation_accounts_and_patient r where r.acc_id = a.acc_id and r.patient_id =p.patient_id and r.acc_id = '$AccountId'");
                        }  
                        elseif($AccountId == "" && $PatientId != ""){
                            $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM accounts a, patient p, relation_accounts_and_patient r where r.acc_id = a.acc_id and r.patient_id =p.patient_id and r.patient_id = '$PatientId'");
                        }
                        elseif($AccountId != "" && $PatientId != ""){
                            $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address FROM accounts a, patient p, relation_accounts_and_patient r where r.acc_id = a.acc_id and r.patient_id =p.patient_id and r.acc_id = '$AccountId' and r.patient_id = '$PatientId'");
                        }
                        $n = mysql_num_rows($q);
                        if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                        else{
                            echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>acc_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $AccId = mysql_result($q,$i,"acc_id");
                            $AccName = mysql_result($q,$i,"acc_name");
                            $AccPhone = mysql_result($q,$i,"acc_phone");
                            $AccAddress = mysql_result($q,$i,"acc_address");
                            $PatientId = mysql_result($q,$i,"patient_id");
                            $PatientName = mysql_result($q,$i,"patient_name");
                            $Patientphone = mysql_result($q,$i,"patient_phone");
                            $PatientAddress = mysql_result($q,$i,"patient_address");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AccId</td> <td style='border: 2px solid #ddd; padding:10px'>$AccName</td> <td style='border: 2px solid #ddd; padding:10px'>$AccPhone</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$AccAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$Patientphone</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td> </tr>";
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

                    }
    if(isset($PatientRoomSend)){
        $RoomName = $_POST["Room_Name"];
        $PatientName = $_POST["Patient_Name"];
        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
        $db = mysql_select_db("project")or die("error to connect to database");
        $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
        $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
        $n = mysql_num_rows($q);
        $x = mysql_num_rows($e);
        if($n != 0){
            $RoomId = mysql_result($q,0,"room_id");
        }
        else{
             $RoomId = "" ;
        }
        if($x != 0){
             $PatientId = mysql_result($e,0,"patient_id");
        }
        else{
            $PatientId = "" ;
        }
        mysql_close($con);
        $Repeat = CheckRepeat($PatientId,$RoomId,"relation_patient_and_room");
        if($Repeat == true){
            if($PatientId != "" && $RoomId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("insert into relation_patient_and_room(patient_id,room_id)
                values('$PatientId','$RoomId')");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data added successfuly');</script>";
            }
            else{echo "<script type='text/javascript'>alert('error in input data');</script>";} 
        }
        else
            echo "<script type='text/javascript'>alert('error data repeat');</script>";
    }
    elseif(isset($PatientRoomDelete)){
        $RoomName = $_POST["Room_Name"];
        $PatientName = $_POST["Patient_Name"];
        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
        $db = mysql_select_db("project")or die("error to connect to database");
        $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
        $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
        $n = mysql_num_rows($q);
        $x = mysql_num_rows($e);
        if($n != 0){
            $RoomId = mysql_result($q,0,"room_id");
        }
        else{
             $RoomId = "" ;
        }
        if($x != 0){
             $PatientId = mysql_result($e,0,"patient_id");
        }
        else{
            $PatientId = "" ;
        }
        mysql_close($con);
        if($PatientId == "" && $RoomId == "")
            echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
        elseif($PatientId != "" && $RoomId == ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_patient_and_room where patient_id = '$PatientId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }
        elseif($PatientId == "" && $RoomId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_patient_and_room where room_id = '$RoomId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }
        elseif($PatientId != "" && $RoomId != ""){
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("delete from relation_patient_and_room where patient_id = '$PatientId' and 
            room_id = '$RoomId'");
            mysql_close($con);
            echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
        }   
    }
    elseif(isset($PatientRoomUpdate)){
            $RoomName = $_POST["Room_Name"];
            $PatientName = $_POST["Patient_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
            $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $RoomId = mysql_result($q,0,"room_id");
            }
            else{
                 $RoomId = "" ;
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
            if($Update == "PatientId"){
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
                    if($PatientId == "" || $RoomId == "" || $BeforeUpdate == "")
                        echo "<script type='text/javascript'>alert('error');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("UPDATE relation_patient_and_room set patient_id = '$PatientId' where
                        room_id = '$RoomId' and patient_id = '$BeforeUpdate'");
                        mysql_close($con);
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
                    if($RoomId == "" || $PatientId == "" || $BeforeUpdate == "")
                        echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("UPDATE relation_patient_and_room set room_id = '$RoomId' where
                        patient_id = '$PatientId' and room_id = '$BeforeUpdate'");
                        mysql_close($con);
                    } 
                }
            }
    function RelationPatientAndRoomShow(){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address , room.room_id ,room.room_name , room.room_place ,room.room_type FROM patient p, room , relation_patient_and_room r where r.patient_id = p.patient_id and r.room_id = room.room_id");
                $n = mysql_num_rows($q);
                if($n == 0)
                    echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                else{
                    echo"<div style='overflow-y:auto; height:300px'>";
                    echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                    margin-left:20%'>";
                    echo"<tr>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                    echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                    echo"</tr>";
                    
                    
                    for($i=0;$i<$n;$i++){
                        $PatientId = mysql_result($q,$i,"patient_id");
                        $PatientName = mysql_result($q,$i,"patient_name");
                        $Patientphone = mysql_result($q,$i,"patient_phone");
                        $PatientAddress = mysql_result($q,$i,"patient_address");
                        $RoomId = mysql_result($q,$i,"room_id");
                        $RoomName = mysql_result($q,$i,"room_name");
                        $RoomPlace = mysql_result($q,$i,"room_place");
                        $RoomType = mysql_result($q,$i,"room_type");
                        echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$Patientphone</td> 
                        <td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td><td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td><td style='border: 2px solid #ddd; padding:10px'>$RoomType</td></tr>";
                    }
                    
                    echo"</table>";
                    echo"</div>";
                }
                
                mysql_close($con);
            }
    function RelationPatientAndRoomSelect(){
                $RoomName = $_POST["Room_Name"];
                $PatientName = $_POST["Patient_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $e = mysql_query("SELECT patient_id FROM patient where patient_name = '$PatientName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $RoomId = mysql_result($q,0,"room_id");
                }
                else{
                     $RoomId = "" ;
                }
                if($x != 0){
                     $PatientId = mysql_result($e,0,"patient_id");
                }
                else{
                    $PatientId = "" ;
                }
                mysql_close($con);
                if($PatientId == "" && $RoomId == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                else{
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    if($PatientId != "" && $RoomId == ""){
                        $q = mysql_query("SELECT p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address , room.room_id ,room.room_name , room.room_place ,room.room_type FROM patient p, room , relation_patient_and_room r where r.patient_id = p.patient_id and r.room_id = room.room_id and r.patient_id = '$PatientId'");
                    }  
                    elseif($PatientId == "" && $RoomId != ""){
                        $q = mysql_query("SELECT p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address , room.room_id ,room.room_name , room.room_place ,room.room_type FROM patient p, room , relation_patient_and_room r where r.patient_id = p.patient_id and r.room_id = room.room_id and r.room_id = '$RoomId'");
                    }
                    elseif($PatientId != "" && $RoomId != ""){
                        $q = mysql_query("SELECT p.patient_id ,p.patient_name , p.patient_phone ,p.patient_address , room.room_id ,room.room_name , room.room_place ,room.room_type FROM patient p, room , relation_patient_and_room r where r.patient_id = p.patient_id and r.room_id = room.room_id and r.patient_id = '$PatientId' and 
                        r.room_id = '$RoomId'");
                    }
                    $n = mysql_num_rows($q);
                    if($n == 0)
                        echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                    else{
                        echo"<div style='overflow-y:auto; height:300px'>";
                        echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                        margin-left:20%'>";
                        echo"<tr>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_phone</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>patient_address</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                        echo"</tr>";
                    
                    
                        for($i=0;$i<$n;$i++){
                            $PatientId = mysql_result($q,$i,"patient_id");
                            $PatientName = mysql_result($q,$i,"patient_name");
                            $Patientphone = mysql_result($q,$i,"patient_phone");
                            $PatientAddress = mysql_result($q,$i,"patient_address");
                            $RoomId = mysql_result($q,$i,"room_id");
                            $RoomName = mysql_result($q,$i,"room_name");
                            $RoomPlace = mysql_result($q,$i,"room_place");
                            $RoomType = mysql_result($q,$i,"room_type");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$PatientId</td> <td style='border: 2px solid #ddd; padding:10px'>$PatientName</td> <td style='border: 2px solid #ddd; padding:10px'>$Patientphone</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$PatientAddress</td><td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td><td style='border: 2px solid #ddd; padding:10px'>$RoomType</td></tr>";
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
                if($Table == "relation_accounts_and_patient"){
                    $q = mysql_query("select * from relation_accounts_and_patient where acc_id = '$FirstId' and patient_id = '$SecondId'");
                }
                elseif($Table == "relation_appointments_and_patient"){
                    $q = mysql_query("select * from relation_appointments_and_patient where app_id = '$FirstId' and patient_id = '$SecondId'");
                }
                elseif($Table == "relation_doctor_and_patient"){
                    $q = mysql_query("select * from relation_doctor_and_patient where doc_id = '$FirstId' and patient_id = '$SecondId'");
                }
                else{
                    $q = mysql_query("select * from relation_patient_and_room where patient_id = '$FirstId' and room_id = '$SecondId'");
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
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel3()">Show Rel 3</button>
            <button type="button" class="btn btn-outline-info btn-lg" onclick="showRel4()">Show Rel 4</button>

        </div>
        <!-- button -->
        
        
        
        
        
        
        
        
        
        <!-- ============= form 1, 2 ============= -->
        <div class="form-info">
            <div class="container">
                
                <!-- ============= form1 ============= -->
                <form id="form-1" action="rel-patients.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Account Name</label> 
                            <input type="text" name="Account_Name" class="form-control">
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
                            <button type="submit" name="AccountPatientSelect" class="btn btn-primary btn-lg col">Select</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AccountPatientShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="AccountPatientUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AccountPatientSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AccountPatientDelete" class="btn btn-danger btn-lg col">Remove</button>
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
                                <option value="AccountId" selected>AccountName</option>
                                <option value="PatientId">PatientName</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                    
                    <?php
                        if(isset($AccountPatientShow)){
                            RelationAccountsAndPatientShow();
                        }
                        elseif(isset($AccountPatientSelect)){
                            RelationAccountsAndPatientSelect();
                        }
                    ?>
                </form>
                
                
                
                <!-- ============= form2 ============= -->
                <form id="form-2" action="rel-patients.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Appointment Date</label> 
                            <input type="date" name="Appointments_Date" class="form-control">
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
                            <button type="submit" name="AppointmentsPatientSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AppointmentsPatientDelete" class="btn btn-danger btn-lg col">Remove</button>
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
        <!-- ============= form 1, 2 ============= -->
        
                
         

        
        
        
        
        
        
        
        <!-- ============= form 3, 4 ============= -->
        <div class="form-info">
            <div class="container">
                
                <!-- ============= form3 ============= -->
                <form id="form-3" action="rel-patients.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
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
                            <label>Patient Care</label>
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
                            <button type="submit" name="DoctorPatientSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorPatientDelete" class="btn btn-danger btn-lg col">Remove</button>
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
                <form id="form-4" action="rel-patients.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Patient Name</label>
                            <input type="text" name="Patient_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Room Name</label> 
                            <input type="text" name="Room_Name" class="form-control">
                        </div>
                    </div>
                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="PatientRoomSelect" class="btn btn-primary btn-lg col">Select</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="PatientRoomShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="PatientRoomUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="PatientRoomSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="PatientRoomDelete" class="btn btn-danger btn-lg col">Remove</button>
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
                                <option value="PatientId" selected>Patient Name</option>
                                <option value="room_id">Room Name</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                   
                    <?php
                        if(isset($PatientRoomShow)){
                            RelationPatientAndRoomShow();
                        }
                        elseif(isset($PatientRoomSelect)){
                            RelationPatientAndRoomSelect();
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
        
      