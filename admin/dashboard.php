<?php
 session_start();

 if(!isset($_SESSION['admin_id'])){
     header('location:../');
 }
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
    crossorigin="anonymous">
  <title>Dashboard - 30MinRecipes</title>
  <link rel="stylesheet" href="../resources/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/css/styles.css">
    <script src="../resources/js/sweetalert.min.js"></script>
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    <script src="../resources/Bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

<div id="headerSection" class="sticky-top">
    <!-- <div class="container" >
        <div class="row align-items-center">
            <div class="col-sm-10 text-center pt-3">
                <p id="brand">My Store</p>
            </div>
            <div class="col-sm-2 text-center pt-3">
                <h5><a style="color:white; text-decoration:none" href="logout.php">Logout <i class="fa fa-user-circle"></i></a></h5>
            </div>
        </div>
    </div> -->
</div>

<div id="bodySection">
    <div class="container">
    <div class="row pt-3">
        <div class="col-md-9 text-center">
            <h3>Add New Recipe</h3>
        </div>
        <div class="col-md-3 text-center">
            <a href="api/logout.php"><button class="btn btn-primary">Logout</button></a>
        </div>
    </div>
        <div class="row py-3">
                <div class="col-md-12">
                    <div id="products">
                        <form id="addRecipe" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <h5>Title :</h5>
                                </div>
                            </div>
                            <div class="form-row py-1">
                                <div class="form-group col-md-12">
                                    <input name="title" type="text" class="form-control" placeholder="Title" required>
                                </div>
                            </div>

                            <div id="ingrediants_field">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5>Add ingrediants :</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-10 form-group text-center">
                                        <input type="text" class="form-control" placeholder="Ingrediants" name="ingrediants[]" required/>
                                    </div>
                                    <div class="col-md-2 form-group text-center">
                                        <button type="button" class="btn btn-success" id="add_ingrediant">Add More <i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div id="steps_field">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5>Method :</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-10 form-group text-center">
                                        <input type="text" class="form-control" placeholder="Write step" name="steps[]" required/>
                                    </div>
                                    <div class="col-md-2 form-group text-center">
                                        <button type="button" class="btn btn-success" id="add_step">Add More <i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <h5>Description :</h5>
                                </div>
                            </div>
                            <div class="form-row py-1">
                                <div class="form-group col-md-12">
                                    <input name="description" type="text"class="form-control" placeholder="Add description" required>
                                </div>
                            </div>

                            <div class="form-row pb-3">
                                <div class="col-md-4">
                                    <h5>Category :</h5>
                                    <select name="category" class="form-control">
                                        <option value="1">Vegetarian</option>
                                        <option value="2">Non-Vegetarian</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h5>Servings :</h5>
                                    <input name="servings" type="text" class="form-control" placeholder="Add servings" required>
                                </div>
                                <div class="col-md-4">
                                    <h5>Time :</h5>
                                    <input name="timing" type="text" class="form-control" placeholder="Add timing" required>
                                </div>
                            </div>
                
                            <div id="images_field">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5>Add image :</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 form-group text-center">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" required>
                                            <label class="custom-file-label" for="pimage">Upload Image</label>
                                        </div>
                                    </div>    
                                </div>

                                <div class="form-row py-3">
                                    <div class="col-md-4 p-0 m-0"></div>
                                    <div class="col-md-4 form-group text-center">
                                        <button  style="border-radius:20px" type="submit" class="btn btn-success form-control"><h5>Add Recipe</h5></button>
                                    </div>
                                    <div class="col-md-4 p-0 m-0"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col-md-12 text-center">
                                    <h3>Recipes</h3><br>
                                    <div id="productList"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

<script>

    $(document).ready(function(){

        getRecipes();


        // add/remove ingrediants
        var ing_wrapper = $("#ingrediants_field");
        var add_ing = $("#add_ingrediant"); 
        var x = 1;
        $(add_ing).click(function(e){
            e.preventDefault();
                $(ing_wrapper).append('<div class="form-row"><div class="col-md-10 form-group text-center"><input type="text" class="form-control" placeholder="Ingrediants" name="ingrediants[]" required/></div><div class="col-md-2 form-group text-center"><button type="button" class="remove_ingrediant btn btn-danger">Remove</button></div></div>');
                x++;
        });
        
        $(ing_wrapper).on("click",".remove_ingrediant", function(e){
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); 
            x--;
        });

        // add/remove steps
        var steps_wrapper = $("#steps_field");
        var add_step  = $("#add_step"); 
        var y = 1;
        $(add_step).click(function(e){
            e.preventDefault();
                $(steps_wrapper).append('<div class="form-row"><div class="col-md-10 text-center form-group"><input type="text" class="form-control" placeholder="Write step" name="steps[]" required/></div><div class="col-md-2 form-group text-center"><button type="button" class="remove_step btn btn-danger">Remove</button></div></div>');
                x++;
        });
        
        $(steps_wrapper).on("click",".remove_step", function(e){
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); 
            x--;
        });

        // form submit
        $("#addRecipe").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url : 'api/recipe.php',
                type : 'POST',
                data : new FormData(this),
                contentType : false,
                cache : false,
                processData : false,
                success : function(data){
                    swal({
                            title: "Recipe Added!",
                            text: "New recipe added successfully!",
                            icon: "success",
                            button: "OK!",
                            
                        }).then((ok)=>{
                            if(ok){
                                location.reload();
                            }
                        });             
                }
            });
        });
    });


    function getRecipes(){
        $.ajax({
            url : 'api/recipes.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 1
            }),
            success : function(data){
                var sr = 1;
                var getProducts = '';
                var category = '';
                if(data==0){
                   $("#productList").html('<p>No products are available right now.</p>');
                }
                else{
                    $.each(data, function(i, d){
                        if(d.category==1){
                            category = 'Vegetarian';
                        }
                        else{
                            category = 'Non-Vegetarian';
                        }
                        getProducts+=   
                            '<tr>'+
                                '<th scope="row">'+sr+'</th>'+
                                '<td colspan="2">'+d.title+'</td>'+
                                '<td scope="col">'+category+'</td>'+
                                '<td scope="col"><button class="btn btn-danger" type="button" onclick="conFirm('+d.r_id+')">Remove</button></td>'+
                            '</tr>';
                            sr++;
                    });

                    $("#productList").html(  
                       '<div class="table-responsive-md" style="background-color:white">'+
                       '<table class="table table-hover">'+
                            '<thead>'+
                                '<tr>'+
                                '<th scope="col">Sr.no.</th>'+
                                '<th colspan="2">Name</th>'+
                                '<th scope="col">Category</th>'+
                                '<th scope="col">Action</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                            getProducts+
                            '</tbody>'+
                        '</table></div>'
                        );
                }
            }
            
        });
    }


    // Confirm 
    function conFirm(id){
        var id = id;
        swal({
            title: 'Are you sure?',
            text: "Confirm if you want to delete any product!",
            icon: "warning",
            buttons: ['Cancel', 'Confirm'],
            dangerMode: true,
            })
            .then((ok) => {
            if (ok) {
                deleteRecipe(id);
            } else {
                swal("Think again!");
            }
        });
    }


    // Delete recipe
    function deleteRecipe(id){
        $.ajax({
            url : 'api/recipes.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 2,
                id : id
            }),
            success : function(data){
                if(data==1){
                    getRecipes(); 
                }

            }
        });
    }

 
</script>

</body>

</html>