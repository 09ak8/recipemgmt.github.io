<?php
 session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <title>Admin - 30MinRecipes</title>
  
    <link rel="stylesheet" href="../resources/css/styles.css">
    
    <script src="../resources/Jquery/jquery-3.5.1.js"></script>
    
</head>

<body bgcolor="yellow">

<div id="bodySection">
   
       
            
                <center><h3>Admin Login</h3><center><br>
                <div id="adminSection" >
                    <form>
                        
                            
                            <input type="text" id="id" placeholder="Admin ID"><br><br>
                         
                        
                        
                            <input id="pass" type="password"  placeholder="Password"><br><br>
                    
              
                        
                            <input type="button" onclick="loginFun()" id="loginbtn"  value="Login">
                    
                        
                            <a href="index.php" >Back</a>   
                           
                  
                    </form>
                </div>
          
</div>

<script>

    function loginFun(){
        var id = $("#id").val();
        var pass = $("#pass").val();

        if(id=='' || pass==''){
            alert('Fields cannot be blank!');
        }
        else{
            $.ajax({
            url : 'api/login.php',
            type : 'POST',
            dataType : 'json',
            contentType : 'application/json',
            data : JSON.stringify({
                call : 1,
                id : id,
                pass : pass,
            }),
            success : function(data){
                if(data==0){
                    swal({
                            title: "Invalid Credentials!",
                            text: "ID or Password is invalid!",
                            icon: "error",
                            button: "OK!",
                    });
                }
                else{
                   window.location = 'dashboard.php';
                }
            }
            
        });
        }

    }

 
</script>

</body>

</html>