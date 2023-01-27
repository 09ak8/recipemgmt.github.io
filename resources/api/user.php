<?php
session_start();
include('connect.php');
$json = json_decode(file_get_contents("php://input"),true);

if($json['call']==1){

    $name = $json['name'];
    $email = $json['email'];
    $mobile = $json['mobile'];
    $pass = $json['pass'];
    $date = date('d-F-Y');

    $check = mysqli_query($con, "SELECT * FROM user WHERE email='$email' OR mobile='$mobile'");
    if(mysqli_num_rows($check)>0){
        echo json_encode($response['success'] = 2);
    }
    else{
        $insert = mysqli_query($con, "INSERT INTO user (name, email, mobile, password, created_at) VALUES('$name','$email','$mobile','$pass','$date')");
        if($insert){
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 0);
        }
    }

}

if($json['call']==2){

    $id = $json['id'];
    $pass = $json['pass'];

    $check = mysqli_query($con, "SELECT * FROM user WHERE (email='$id' OR mobile='$id') AND password='$pass' ");
    if(mysqli_num_rows($check)>0){
        while($row = mysqli_fetch_array($check)){
            $userid = $row['id'];
        }
        $_SESSION['user'] = $userid;
        echo json_encode($response['success'] = 1);
    }
    else{
        echo json_encode($response['success'] = 0);
    }

}

?>