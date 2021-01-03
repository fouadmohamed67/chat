<?php
   session_start();
   include "connect.php";

   if(isset($_SESSION['name']))
   {
       header('location: index.php');
       exit();
   }
   else
   { 
      if($_SERVER['REQUEST_METHOD']=='POST')
      {
          $name=$_POST['name'];
          $password=$_POST['password'];
          
         
          $statement=$conn->prepare("SELECT name,id FROM users WHERE name= ? AND password=? ");
          $statement->execute(array($name,$password));
          $row=$statement->fetch();
          $count=$statement->rowCount();
           
              if($count>0)
              {
                  
                  $_SESSION['name']=$row['name'];
                  $_SESSION['id']=$row['id'];
                  
                   
                      header('location: index.php');
                      exit();
                  
                  
                  
              }
              else {
                header('location: login.php');
                exit();
              }
      }
                
            
      
    }
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <title> login page</title>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    </head>
    <body>
        
                

            <div class="container">
                
                <div class="card card_login d-flex justify-content-center" >
                    <div class="card-header">
                        <div class="h1 d-flex justify-content-center">login now</div>
                    </div>
                    <div class="card-body">
            
                        <form action="" method="POST" name="form" class="form" onsubmit = "return(validation_login());">
                            <div class="form-group">
                                <label for="name">name : </label>
                                <input type="text" class="form-control" name="name" >
                            </div>
                           
                            
            
            
                            <div class="form-group">
                                <label for="password">password : </label>
                                <input type="password" class="form-control" name="password" >
                            </div>
                             
                            
            
            
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" id="">   
                            </div>
                        </form>
                        
            
                    </div>
                </div>
            </div>
            
            </div>
  </body>
  </html>


  

 
  

 


