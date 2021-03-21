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
            @$AccountRoomSend = $_POST["AccountRoomSend"];
            @$AccountRoomDelete = $_POST["AccountRoomDelete"];
            @$AccountRoomUpdate = $_POST["AccountRoomUpdate"];
            @$AccountRoomSelect = $_POST["AccountRoomSelect"];
            @$AccountRoomShow = $_POST["AccountRoomShow"];
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
                    $PatientId = mysql_result($q,0,"patient_id");
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
                            @$con = mysql_connect("sql109.eb2a.com","eb2a_24078768","")or die("error in connect to server");
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
                            $PatientId = mysql_result($q,0,"patient_id");
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
        if(isset($AccountRoomSend)){
            $AccountName = $_POST["Account_Name"];
            $RoomName = $_POST["Room_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT a.acc_id ,r.room_id FROM accounts a, room r where a.acc_name = '$AccountName' and r.room_name = '$RoomName'");
            $n = mysql_num_rows($q);
            if($n != 0){
                $AccountId = mysql_result($q,0,"acc_id");
                $RoomId = mysql_result($q,0,"room_id");
            }
            else{
                $AccountId = "" ;
                $RoomId = "" ;
            }
            mysql_close($con);
            $Repeat = CheckRepeat($AccountId,$RoomId,"relation_accounts_and_room");
            if($Repeat == true){
                if($AccountId != "" && $RoomId != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("insert into relation_accounts_and_room(acc_id,room_id) values ('$AccountId','$RoomId')");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                }
                else{echo "<script type='text/javascript'>alert('error in input data');</script>";}   
            }
            else
                echo "<script type='text/javascript'>alert('error data repeat');</script>";
            }
        elseif(isset($AccountRoomDelete)){
            $AccountName = $_POST["Account_Name"];
            $RoomName = $_POST["Room_Name"];
            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
            $db = mysql_select_db("project")or die("error to connect to database");
            $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$AccountName'");
            $e = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
            $n = mysql_num_rows($q);
            $x = mysql_num_rows($e);
            if($n != 0){
                $AccountId = mysql_result($q,0,"acc_id");
            }
            else{
                $AccountId = "" ;
                }
            if($x != 0){
                    $RoomId = mysql_result($q,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                }
            mysql_close($con);
            if($AccountId == "" && $RoomId == "")
                 echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
            elseif($AccountId != "" && $RoomId == ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_accounts_and_room where acc_id = '$AccountId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
            }
            elseif($AccountId == "" && $RoomId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_accounts_and_room where room_id = '$RoomId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
            }
            elseif($AccountId != "" && $RoomId != ""){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("delete from relation_accounts_and_room where acc_id = '$AccountId' and room_id = '$RoomId'");
                mysql_close($con);
                echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
            }   
        }
        elseif(isset($AccountRoomUpdate)){
                $AccountName = $_POST["Account_Name"];
                $RoomName = $_POST["Room_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$AccountName'");
                $e = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $AccountId = mysql_result($q,0,"acc_id");
                }
                else{
                    $AccountId = "" ;
                 }
                if($x != 0){
                        $RoomId = mysql_result($e,0,"room_id");
                    }
                    else{
                        $RoomId = "" ;
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
                        if($AccountId == "" || $RoomId == "" || $BeforeUpdate =="")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("UPDATE relation_accounts_and_room set acc_id = '$AccountId' where
                            room_id = '$RoomId' and acc_id = '$BeforeUpdate'");
                            mysql_close($con);
                        }     
                    }
                elseif($Update == "RoomId"){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT room_id FROM room where room_name = '$BeforeUpdate'");
                    if($n != 0){
                        $BeforeUpdate = mysql_result($q,0,"room_id");
                    }
                    else{
                        $BeforeUpdate = "" ;
                    }
                    mysql_close($con);
                        if($AccountId == "" || $RoomId == "")
                            echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            $q = mysql_query("UPDATE relation_accounts_and_room set room_id = '$RoomId' where
                            acc_id = '$AccountId' and room_id = '$BeforeUpdate'");
                            mysql_close($con);

                        } 
                    }
                }
        function RelationAccountsAndRoomShow(){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type FROM accounts a, room , relation_accounts_and_room r where r.acc_id = a.acc_id and r.room_id = room.room_id");
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
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                        echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                        echo"</tr>";


                        for($i=0;$i<$n;$i++){
                            $AccId = mysql_result($q,$i,"acc_id");
                            $AccName = mysql_result($q,$i,"acc_name");
                            $AccPhone = mysql_result($q,$i,"acc_phone");
                            $AccAddress = mysql_result($q,$i,"acc_address");
                            $RoomId = mysql_result($q,$i,"room_id");
                            $RoomName = mysql_result($q,$i,"room_name");
                            $RoomPlace = mysql_result($q,$i,"room_place");
                            $RoomType = mysql_result($q,$i,"room_type");
                            echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AccId</td> <td style='border: 2px solid #ddd; padding:10px'>$AccName</td> <td style='border: 2px solid #ddd; padding:10px'>$AccPhone</td> 
                            <td style='border: 2px solid #ddd; padding:10px'>$AccAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomType</td> </tr>";
                        }

                        echo"</table>";
                        echo"</div>";
                    }

                    mysql_close($con);
                }
        function RelationAccountsAndRoomSelect(){
                    $AccountName = $_POST["Account_Name"];
                    $RoomName = $_POST["Room_Name"];
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT acc_id FROM accounts where acc_name = '$AccountName'");
                    $e = mysql_query("SELECT room_id FROM room where room_name = '$PatientName'");
                    $n = mysql_num_rows($q);
                    $x = mysql_num_rows($e);
                    if($n != 0){
                        $AccountId = mysql_result($q,0,"acc_id");
                    }
                    else{
                        $AccountId = "" ;
                        }
                    if($x != 0){
                            $RoomId = mysql_result($q,0,"room_id");
                        }
                        else{
                            $RoomId = "" ;
                        }
                    mysql_close($con);
                    if($AccountId == "" && $RoomId == "")
                        echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                    else{
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        if($AccountId != "" && $RoomId == ""){
                            $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type FROM accounts a, room , relation_accounts_and_room r where r.acc_id = a.acc_id and r.room_id = room.room_id and r.acc_id = '$AccountId'");
                        }  
                        elseif($AccountId == "" && $RoomId != ""){
                            $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type FROM accounts a, room , relation_accounts_and_room r where r.acc_id = a.acc_id and r.room_id = room.room_id and r.room_id = '$RoomId'");
                        }
                        elseif($AccountId != "" && $RoomId != ""){
                            $q = mysql_query("SELECT a.acc_id , a.acc_name , a.acc_phone , a.acc_address ,room.room_id ,room.room_name , room.room_place ,room.room_type FROM accounts a, room , relation_accounts_and_room r where r.acc_id = a.acc_id and r.room_id = room.room_id and r.acc_id = '$AccountId' and r.room_id = '$RoomId'");
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
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                            echo"</tr>";


                            for($i=0;$i<$n;$i++){
                                $AccId = mysql_result($q,$i,"acc_id");
                                $AccName = mysql_result($q,$i,"acc_name");
                                $AccPhone = mysql_result($q,$i,"acc_phone");
                                $AccAddress = mysql_result($q,$i,"acc_address");
                                $RoomId = mysql_result($q,$i,"room_id");
                                $RoomName = mysql_result($q,$i,"room_name");
                                $RoomPlace = mysql_result($q,$i,"room_place");
                                $RoomType = mysql_result($q,$i,"room_type");
                                echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$AccId</td> <td style='border: 2px solid #ddd; padding:10px'>$AccName</td> <td style='border: 2px solid #ddd; padding:10px'>$AccPhone</td> 
                                <td style='border: 2px solid #ddd; padding:10px'>$AccAddress</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomType</td> </tr>";
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
                else{
                    $q = mysql_query("select * from relation_accounts_and_room where acc_id = '$FirstId' and room_id = '$SecondId'");
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
                <form id="form-1" action="rel-accounts.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
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
                            <button type="submit" name="AccountPatientSelect" class="btn btn-primary btn-lg col">Select</button>
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
                            <button type="submit" name="AccountPatientDelete" class="btn btn-danger btn-lg col">Remove</button><br>
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
                                <option value="AccountId" selected>AccountId</option>
                                <option value="PatientId">PatientId</option>
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
                <form id="form-2" action="rel-accounts.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Account Name</label>
                            <input type="text" name="Account_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Room Name</label>
                            <input type="text" name="Room_Name"  class="form-control">
                        </div>
                    </div>
                    
                    <!-- row 1 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AccountRoomSelect" class="btn btn-primary btn-lg col">Select</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AccountRoomShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="AccountRoomUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="AccountRoomSend" class="btn btn-success btn-lg col">Insert</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AccountRoomDelete" class="btn btn-danger btn-lg col">Delete</button><br>
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
                                <option value="RoomId">RoomName</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                   
                    <?php
                        if(isset($AccountRoomShow)){
                            RelationAccountsAndRoomShow();
                        }
                        elseif(isset($AccountRoomSelect)){
                            RelationAccountsAndRoomSelect();
                        }
                    ?>
                </form>
                
                
            </div>
        </div>
        <!-- ============= form 1, 2 ============= -->
        
        
        
        

        
                
        
        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>        