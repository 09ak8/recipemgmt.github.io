<?php
include('connect.php');
session_start();
$json = json_decode(file_get_contents("php://input"),true);


if($json['call']==1){

    $uid = $_SESSION['user'];
    $query = mysqli_query($con, "SELECT saved.r_id, recipe.title, images.name from saved LEFT JOIN recipe ON saved.r_id=recipe.r_id LEFT JOIN images ON saved.r_id=images.img_id WHERE saved.u_id='$uid'");
    if(mysqli_num_rows($query)>0){
        $items = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $empty = mysqli_free_result($query);
        echo json_encode($items);
    }
    else{
        echo json_encode($response['success'] = 0);
    }
    
}

if($json['call']==2){
    $uid = $_SESSION['user'];
    $rid = $json['id'];

    $delete = mysqli_query($con, "DELETE FROM saved WHERE r_id='$rid' AND u_id='$uid'");
    if($delete){
        echo json_encode($response['success'] = 1);
    }
    else{
        echo json_encode($response['success'] = 0);
    }
}

?>