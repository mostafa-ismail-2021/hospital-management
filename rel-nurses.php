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
            @$DoctorNurseSend = $_POST["DoctorNurseSend"];
            @$DoctorNurseDelete = $_POST["DoctorNurseDelete"];
            @$DoctorNurseUpdate = $_POST["DoctorNurseUpdate"];
            @$DoctorNurseSelect = $_POST["DoctorNurseSelect"];
            @$DoctorNurseShow = $_POST["DoctorNurseShow"];
            @$NurseRoomSend = $_POST["NurseRoomSend"];
            @$NurseRoomDelete = $_POST["NurseRoomDelete"];
            @$NurseRoomUpdate = $_POST["NurseRoomUpdate"];
            @$NurseRoomSelect = $_POST["NurseRoomSelect"];
            @$NurseRoomShow = $_POST["NurseRoomShow"];
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
                        $NurseId = mysql_result($e,0,"app_id");
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
            function CheckRepeat($FirstId,$SecondId,$Table){
                @$con = mysql_connect("localhost","root","")or die("error in connect to server");
                $db = mysql_select_db("project")or die("error to connect to database");
                if($Table == "relation_doctors_nursess"){
                    $q = mysql_query("select * from relation_doctors_nursess where doc_id = '$FirstId' and nur_id = '$SecondId'");
                }
                else{
                    $q = mysql_query("select * from relation_nursess_and_room where nursess_id = '$FirstId' and room_id = '$SecondId'");
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
                <form id="form-1" action="rel-nurses.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
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
                
                
                
                 
                <!-- ============= form2 ============= -->
                <form id="form-2" action="rel-nurses.php" method="post" style="border:2px solid #BBB;padding:20px;display:none;">
                    
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
        
        

        
        
        
        
        
        
                
        
        <script src="js/jquery-3.4.0.min.js"></script>
        <script src="js/popper.min.js"></script> <!-- Dropdowns for displaying and positioning -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>        
        
        