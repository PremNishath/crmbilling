<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/invoice.css">
    <script src="js/bootstrap-datepicker.js"></script>    
    <style>
.navbar-custom {
  background-color: #0072e7; /* Replace with your desired color */
}
.read-more-button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #20B2AA; /* Replace with your desired button color */
  color: #F4F1F0;
  text-decoration: none;
  border-radius: 5px;
}
</style>
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #0072e7;
   color: white;
   text-align: right;
}
</style>
</head>

<body style="font-family: Segoe UI light;">
    <div class="table-responsive">
        <nav class="navbar navbar-default card navbar-custom">
            <div class="container-fluid">
                <div class="navbar-header" >
                    <div class="col-xl-4 col-lg-9 col-md-6 col-sm-9 col-9"> 
                        <a href="#"><img src="img/logo1.png" class="img-fluid mainlogo" style="width:80px;height:60px;color: white;"> 
                        <span style="color: white;">Medical</span>
                        <span style="color: red;">Shop</span></a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Log In</div>
                </div>     

                <div style="padding-top:30px" class="panel-body">
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <form action="#" id="loginform" class="form-horizontal" role="form" method="POST">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username">                                        
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                <button type="submit" class="btn btn-large btn-success" title="Log In" name="login" value="Admin Login">Login</button>
                            </div>
                        </div>
                    </form>     
                </div>                     
            </div>  
        </div>  
    </div>

    <div class="footer">
        <p>@ Developed by techpark</p>
    </div>

    <?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the form is submitted

        include('db_config.php'); // Include the database connection file

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate the user credentials
        // Perform the database query to check the username and password
        $query = "SELECT * FROM login WHERE username = :username AND password = :password";
        $statement = $connect->prepare($query);
        $statement->execute([
            'username' => $username,
            'password' => $password
        ]);

        $count = $statement->rowCount();

        if ($count > 0) {
            // If the login credentials are correct, set the session variable
            $_SESSION['username'] = $username;
            header("location: invoice.php"); // Redirect to the desired page
            exit;
        } else {
            // If the login credentials are incorrect, display an error message
            echo "<div class='container alert alert-danger alert-dismissible' role='alert'>
                Invalid Username and Password
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
        }
    }
    ?>

</body>
</html>
