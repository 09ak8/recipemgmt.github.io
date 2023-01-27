<?php
    session_start();

    $json = json_decode(file_get_contents("php://input"),true);
    
    if($json['call'] == 1){
        
        $pid = $json['id'];
        $pass = $json['pass'];

        $id = 123;
        $password = 456;

        if( $id==$pid && $pass==$password){
            $_SESSION['admin_id'] = $id;
            echo json_encode($response['success'] = 1);
        }
        else{
            echo json_encode($response['success'] = 0);
        }

    }

?>