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
            @$AccountRoomSend = $_POST["AccountRoomSend"];
            @$AccountRoomDelete = $_POST["AccountRoomDelete"];
            @$AccountRoomUpdate = $_POST["AccountRoomUpdate"];
            @$AccountRoomSelect = $_POST["AccountRoomSelect"];
            @$AccountRoomShow = $_POST["AccountRoomShow"];
            @$NurseRoomSend = $_POST["NurseRoomSend"];
            @$NurseRoomDelete = $_POST["NurseRoomDelete"];
            @$NurseRoomUpdate = $_POST["NurseRoomUpdate"];
            @$NurseRoomSelect = $_POST["NurseRoomSelect"];
            @$NurseRoomShow = $_POST["NurseRoomShow"];
            @$PatientRoomSend = $_POST["PatientRoomSend"];
            @$PatientRoomDelete = $_POST["PatientRoomDelete"];
            @$PatientRoomUpdate = $_POST["PatientRoomUpdate"];
            @$PatientRoomSelect = $_POST["PatientRoomSelect"];
            @$PatientRoomShow = $_POST["PatientRoomShow"];
            @$DoctorRoomSend = $_POST["DoctorRoomSend"];
            @$DoctorRoomDelete = $_POST["DoctorRoomDelete"];
            @$DoctorRoomUpdate = $_POST["DoctorRoomUpdate"];
            @$DoctorRoomSelect = $_POST["DoctorRoomSelect"];
            @$DoctorRoomShow = $_POST["DoctorRoomShow"];
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
                if(isset($NurseRoomSend)){
                $RoomName = $_POST["Room_Name"];
                $NurseName = $_POST["Nurse_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $RoomId = mysql_result($q,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                 }
                if($x != 0){
                    $NurseId = mysql_result($e,0,"nur_id");
                }
                else{
                    $NurseId = "" ;
                }
                mysql_close($con);
                $Repeat = CheckRepeat($NurseId,$RoomId,"relation_nursess_and_room");
                if($Repeat == true){
                    if($NurseId != "" && $RoomId != ""){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("insert into relation_nursess_and_room(nursess_id,room_id)
                        values('$NurseId','$RoomId')");
                        mysql_close($con);
                        echo "<script type='text/javascript'>alert('data added successfuly');</script>";
                    }
                    else{echo "<script type='text/javascript'>alert('error in input data');</script>";}
                }
                else
                    echo "<script type='text/javascript'>alert('error data repeat');</script>";   
            }
            elseif(isset($NurseRoomDelete)){
                $RoomName = $_POST["Room_Name"];
                $NurseName = $_POST["Nurse_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $RoomId = mysql_result($q,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                 }
                if($x != 0){
                    $NurseId = mysql_result($e,0,"nur_id");
                }
                else{
                    $NurseId = "" ;
                }
                mysql_close($con);
                if($NurseId == "" && $RoomId == "")
                    echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                elseif($NurseId != "" && $RoomId == ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from relation_nursess_and_room where nursess_id = '$NurseId'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                }
                elseif($NurseId == "" && $RoomId != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from relation_nursess_and_room where room_id = '$RoomId'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                }
                elseif($NurseId != "" && $RoomId != ""){
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("delete from relation_nursess_and_room where nursess_id = '$NurseId' and 
                    room_id = '$RoomId'");
                    mysql_close($con);
                    echo "<script type='text/javascript'>alert('data delete successfuly');</script>";
                }  
            }
            elseif(isset($NurseRoomUpdate)){
                    $RoomName = $_POST["Room_Name"];
                    $NurseName = $_POST["Nurse_Name"];
                    @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                    $db = mysql_select_db("project")or die("error to connect to database");
                    $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                    $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
                    $n = mysql_num_rows($q);
                    $x = mysql_num_rows($e);
                    if($n != 0){
                        $RoomId = mysql_result($q,0,"room_id");
                    }
                    else{
                        $RoomId = "" ;
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
                    if($Update == "NurseId"){
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
                            if($NurseId == "" || $RoomId == "" || $BeforeUpdate == "")
                                echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                            else{
                                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                                $db = mysql_select_db("project")or die("error to connect to database");
                                $q = mysql_query("UPDATE relation_nursess_and_room set nursess_id = '$NurseId' where
                                room_id = '$RoomId' and nursess_id = '$BeforeUpdate'");
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
                            if($RoomId == "" || $NurseId == "" || $BeforeUpdate == "")
                                echo "<script type='text/javascript'>alert('error you must add a vlaue to the fields');</script>";
                            else{
                                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                                $db = mysql_select_db("project")or die("error to connect to database");
                                $q = mysql_query("UPDATE relation_nursess_and_room set room_id = '$RoomId' where
                                nursess_id = '$NurseId' and room_id = '$BeforeUpdate'");
                                mysql_close($con);
                            } 
                        }
                    }
            function RelationNurseAndRoomShow(){
                        @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                        $db = mysql_select_db("project")or die("error to connect to database");
                        $q = mysql_query("SELECT n.nur_id , n.nur_name, n.nur_specialty,n.nur_degree ,n.nur_phone , room.room_id ,room.room_name , room.room_place ,room.room_type FROM nursess n, room , relation_nursess_and_room r where r.nursess_id = n.nur_id and r.room_id = room.room_id");
                        $n = mysql_num_rows($q);
                        if($n == 0)
                            echo "<script type='text/javascript'>alert('sorry no record in this table');</script>";
                        else{
                            echo"<div style='overflow-y:auto; height:300px'>";
                            echo"<table style='border: 2px solid #ddd; border-collapse: collapse;
                            margin-left:20%'>";
                            echo"<tr>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_id</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_specialty</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_degree</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>nur_phone</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                            echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                            echo"</tr>";


                            for($i=0;$i<$n;$i++){
                                $NurId = mysql_result($q,$i,"nur_id");
                                $NurName = mysql_result($q,$i,"nur_name");
                                $NurSpecialty = mysql_result($q,$i,"nur_specialty");
                                $NurDegree = mysql_result($q,$i,"nur_degree");
                                $NurPhone = mysql_result($q,$i,"nur_phone");
                                $RoomId = mysql_result($q,$i,"room_id");
                                $RoomName = mysql_result($q,$i,"room_name");
                                $RoomPlace = mysql_result($q,$i,"room_place");
                                $RoomType = mysql_result($q,$i,"room_type");
                                echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$NurId</td> <td style='border: 2px solid #ddd; padding:10px'>$NurName</td> <td style='border: 2px solid #ddd; padding:10px'>$NurSpecialty</td> 
                                <td style='border: 2px solid #ddd; padding:10px'>$NurDegree</td> <td style='border: 2px solid #ddd; padding:10px'>$NurPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td><td style='border: 2px solid #ddd; padding:10px'>$RoomType</td></tr>";
                            }

                            echo"</table>";
                            echo"</div>";
                        }

                        mysql_close($con);
                    }
            function RelationNurseAndRoomSelect(){
                        $RoomName = $_POST["Room_Name"];
                $NurseName = $_POST["Nurse_Name"];
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                $q = mysql_query("SELECT room_id FROM room where room_name = '$RoomName'");
                $e = mysql_query("SELECT nur_id FROM nursess where nur_name = '$NurseName'");
                $n = mysql_num_rows($q);
                $x = mysql_num_rows($e);
                if($n != 0){
                    $RoomId = mysql_result($q,0,"room_id");
                }
                else{
                    $RoomId = "" ;
                 }
                if($x != 0){
                    $NurseId = mysql_result($e,0,"nur_id");
                }
                else{
                    $NurseId = "" ;
                }
                mysql_close($con);
                        if($NurseId == "" && $RoomId == "")
                            echo "<script type='text/javascript'>alert('error you must full at least one input');</script>";
                        else{
                            @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                            $db = mysql_select_db("project")or die("error to connect to database");
                            if($NurseId != "" && $RoomId == ""){
                                $q = mysql_query("SELECT n.nur_id , n.nur_name, n.nur_specialty,n.nur_degree ,n.nur_phone , room.room_id ,room.room_name , room.room_place ,room.room_type FROM nursess n, room , relation_nursess_and_room r where r.nursess_id = n.nur_id and r.room_id = room.room_id and r.nursess_id = '$NurseId'");
                            }  
                            elseif($NurseId == "" && $RoomId != ""){
                                $q = mysql_query("SELECT n.nur_id , n.nur_name, n.nur_specialty,n.nur_degree ,n.nur_phone , room.room_id ,room.room_name , room.room_place ,room.room_type FROM nursess n, room , relation_nursess_and_room r where r.nursess_id = n.nur_id and r.room_id = room.room_id and r.room_id = '$RoomId'");
                            }
                            elseif($NurseId != "" && $RoomId != ""){
                                $q = mysql_query("SELECT n.nur_id , n.nur_name, n.nur_specialty,n.nur_degree ,n.nur_phone , room.room_id ,room.room_name , room.room_place ,room.room_type FROM nursess n, room , relation_nursess_and_room r where r.nursess_id = n.nur_id and r.room_id = room.room_id and r.nursess_id = '$NurseId' and 
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
                                echo"<th style='border: 2px solid #ddd; padding:5px'>nur_id</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>nur_name</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>nur_specialty</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>nur_degree</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>nur_phone</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_id</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_name</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_place</th>";
                                echo"<th style='border: 2px solid #ddd; padding:5px'>room_type</th>";
                                echo"</tr>";


                                for($i=0;$i<$n;$i++){
                                    $NurId = mysql_result($q,$i,"nur_id");
                                    $NurName = mysql_result($q,$i,"nur_name");
                                    $NurSpecialty = mysql_result($q,$i,"nur_specialty");
                                    $NurDegree = mysql_result($q,$i,"nur_degree");
                                    $NurPhone = mysql_result($q,$i,"nur_phone");
                                    $RoomId = mysql_result($q,$i,"room_id");
                                    $RoomName = mysql_result($q,$i,"room_name");
                                    $RoomPlace = mysql_result($q,$i,"room_place");
                                    $RoomType = mysql_result($q,$i,"room_type");
                                    echo"<tr> <td style='border: 2px solid #ddd; padding:10px'>$NurId</td> <td style='border: 2px solid #ddd; padding:10px'>$NurName</td> <td style='border: 2px solid #ddd; padding:10px'>$NurSpecialty</td> 
                                    <td style='border: 2px solid #ddd; padding:10px'>$NurDegree</td> <td style='border: 2px solid #ddd; padding:10px'>$NurPhone</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomId</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomName</td> <td style='border: 2px solid #ddd; padding:10px'>$RoomPlace</td><td style='border: 2px solid #ddd; padding:10px'>$RoomType</td></tr>";
                                }

                                echo"</table>";
                                echo"</div>";
                            }

                            mysql_close($con);
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
            elseif($DoctorId != "" && $RoomId == "" && $Date == ""){
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
        function CheckRepeat($FirstId,$SecondId,$Table){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                if($Table == "relation_accounts_and_room"){
                    $q = mysql_query("select * from relation_accounts_and_room where acc_id = '$FirstId' and room_id = '$SecondId'");
                }
                elseif($Table == "relation_nursess_and_room"){
                    $q = mysql_query("select * from relation_nursess_and_room where nursess_id = '$FirstId' and room_id = '$SecondId'");
                }
                elseif($Table == "relation_patient_and_room"){
                    $q = mysql_query("select * from relation_patient_and_room where patient_id = '$FirstId' and room_id = '$SecondId'");
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
                <form id="form-1" action="rel-rooms.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Account Name</label>
                            <input type="text" name="Account_Name" class="form-control">
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
                            <button type="submit" name="AccountRoomSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="AccountRoomDelete" class="btn btn-danger btn-lg col">Remove</button>
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
                
                

                
                <!-- ============= form2 ============= -->
                <form id="form-2" action="rel-rooms.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Nurse Name</label>
                            <input type="text" name="Nurse_Name" class="form-control">
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
                            <button type="submit" name="NurseRoomSelect" class="btn btn-primary btn-lg col">Select</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="NurseRoomShow" class="btn btn-dark btn-lg col">Show</button>
                        </div>
                        <div class="form-group col-6">
                            <button type="submit" name="NurseRoomUpdate" class="btn btn-warning btn-lg col">Update</button>
                        </div>
                    </div>
                    <!---->
                    
                    <!-- row 2 -->
                    <div class="form-row">
                        <div class="form-group col-3">
                            <button type="submit" name="NurseRoomSend" class="btn btn-success btn-lg col">Insert</button>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="NurseRoomDelete" class="btn btn-danger btn-lg col">Remove</button>
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
                                <option value="NurseId" selected>NurseName</option>
                                <option value="RoomId">RoomName</option>
                            </select>
                            <small> use only with update button</small>
                        </div>
                    </div>
                    <!---->
                   
                    <?php
                        if(isset($NurseRoomShow)){
                            RelationNurseAndRoomShow();
                        }
                        elseif(isset($NurseRoomSelect)){
                            RelationNurseAndRoomSelect();
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
                <form id="form-3" action="rel-rooms.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
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
                <option value="PatientId" selected>PatientName</option>
                <option value="RoomId">RoomName</option>
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
                
                
                
                
                   
                
                
                
                

                
                <!-- ============= form4 ============= -->
                <form id="form-4" action="rel-rooms.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Doctor Name</label> 
                            <input type="text" name="Doctor_Name" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Room Name</label>
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
                            <button type="submit" name="DoctorRoomSelect" class="btn btn-primary btn-lg col">Select</button>
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
                            <button type="submit" name="DoctorRoomSend" class="btn btn-success btn-lg col">Insert</button><br>
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" name="DoctorRoomDelete" class="btn btn-danger btn-lg col">Remove</button><br>
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