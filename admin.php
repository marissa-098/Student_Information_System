
<link rel="icon" href="img/logo.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ICST-ADMIN</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>

  body{
     background-color: #9EABA0;
  }
  .container-box {
    width: 100%;
    max-width: 500px;
    background-color: transparent;
    padding: 10px;
  }

  @media (min-width: 768px) {
    .container-box {
      width: 500px;
      margin: 5px;
    }
  }
  .login-container {
      background-color: white;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
     .login-container1 {
      background-color: white;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .login-container h2 {
      margin-top: 0;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .login-container button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    .login-container button:hover {
      background-color: #45a049;
    }

    .login-container .show {
      text-align: left;
      margin-top: 10px;
    }
    .header-container {
      display: flex;
      align-items: center;
      width: 100%;
      height: 60px;
      padding: 20px 20px 0px 20px;
    }

    .header-container .material-symbols-outlined {
      font-size: 70px;
      color: #333;
      margin-right: 10px;
    }

    .header-container h2 {
      margin: 0;
      font-size: 24px;
      color: #333;
    } 
    .form{
      padding: 0px 20px 20px 20px;
    }
    .error-message{
    display: none;
    }
      
    .showalert {
    display: flex;
    align-items: center;
    background-color: #ffcccc;
    color: #ff0000;
    padding: 10px;
    border-radius: 4px;
  }

  .error-message i {
    margin-right: 8px;
  }

  .error-message .message {
    font-weight: bold;
  }
</style>


 <?php 
  include("config/conn.php");

  if(isset($_POST['submit'])){

            // $_SESSION['id'] = $_POST['fr_studid'];
            $query ="
            SELECT * FROM users
            WHERE username = :user
            ";

            $statement = $conn_PDO->prepare($query);
            $statement->execute(
              array( 
                'user'=> $_POST['fr_Username']
              )
            );
            $count = $statement->rowCount();
            if($count > 0 ){
              $result = $statement->fetchAll();
              foreach ($result as $row) {
          //check the password from form 
                $raw_password =$_POST["fr_password"];
                $hash_password = $row["password"];
                $_SESSION["admin_id"] = $row["admin_Id"];

                 if (password_verify($raw_password, $hash_password) || ($raw_password == $hash_password)){
                 ?>
                <script>
                     setTimeout((window.location.href="admin/index.php"),3000);
                 </script>     
                 <?php
          // make a global variable
                $log_id = $conn->lastInsertId();
                if(!empty($log_id)){
                  $_SESSION['type'] = $row['User_type'];
                  $_SESSION['Uname'] = $row['UName'];
                  $_SESSION['UID'] = $row['UID'];
                  $_SESSION['log_ID'] = $log_id;
                }
          // go to home.php
                
                header('Location:admin/index.php'); 
              }
              else{
                
                  $_SESSION['alert'] = "0";
                  ?>

                 <?php
                 }
              }
            }else{
                
                  $_SESSION['alert'] = "0";
                 }

           }
          ?>


<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container-box w-100 w-md-466px">
     
     <div class="login-container">
        <div style="background-color:#112515; width: 100%; height: 70px;">
            <img src="img/icstheader.png" alt="ICST Logo" style="max-width: 200px; margin-bottom: 20px;">
        </div>
        <div style="background-color:green; width: 100%; height: 5px;">
        </div>

         <div class="header-container">
          <span class="material-symbols-outlined">
            shield_lock
          </span>
          <h2>Sign In to Admin</h2>

        </div>
         <form method="post"> 
          <div class="form">
            <hr style="color: gray;">
            <?php
                    if (isset($_SESSION['alert'])) {
                      $alert = "showalert";
                      session_unset();
                    }
                    ?>
            <div class="error-message <?php echo $alert; ?>">
              <i class="fas fa-exclamation-circle"></i>
              <span class="message">Try Again: Wrong username or password.</span>
            </div>

            <input type="text" name="fr_Username" id="username"placeholder="Username" required>
            <input type="password" name="fr_password" id="password" placeholder="Password" required>
            <div class="show">
              <input type="checkbox" id="remember-me" onclick="myFunction()">
              <label for="remember-me">Show Password</label>
            </div>
            <button type="submit" name="submit">Sign In</button>
             <!--<a href="forgot/forgot1.php" >Forgot your password?</a>-->
          </div>
       </form>
    </div>
    </div>
  </div>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   </script>
        <script>
            function myFunction() {
              var x = document.getElementById("password");
              if (x.type === "password") {
                x.type = "text";
              } else {
                x.type = "password";
              }
            }
     </script>
</body>