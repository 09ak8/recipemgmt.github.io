<?php
include('connect.php');
session_start();
$json = json_decode(file_get_contents("php://input"),true);

// Get recipes
if($json['call']==1){
    $getRecipes = mysqli_query($con, "SELECT * FROM recipe");
    if(mysqli_num_rows($getRecipes)>0){
        $recipes = mysqli_fetch_all($getRecipes, MYSQLI_ASSOC);
        $empty = mysqli_free_result($getRecipes);
        echo json_encode($recipes);
        
    }
    else{
        echo json_encode($response['success'] = 0);
    }
}

// Delete recipe
if($json['call']==2){
    $rid = $json['id'];

    $delete = mysqli_query($con, "DELETE FROM recipe WHERE r_id='$rid'");
    if($delete){
        echo json_encode($response['success'] = 1);
    }
    else{
        echo json_encode($response['success'] = 0);
    }
}
?>