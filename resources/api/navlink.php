<?php
include('connect.php');
session_start();
$json = json_decode(file_get_contents("php://input"),true);

if($json['call']==1){

    if(isset($_SESSION['user'])){
        $uid = $_SESSION['user'];
        $cart = mysqli_query($con,"SELECT DISTINCT r_id FROM shopping_list WHERE u_id='$uid'");
        $cart = mysqli_num_rows($cart);
        $saved = mysqli_query($con,"SELECT * FROM saved WHERE u_id='$uid'");
        $saved = mysqli_num_rows($saved);
        echo json_encode([$cart, $saved]);
    }
    else{
        echo json_encode(0);
    }

}

?>