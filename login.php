<?php
session_start();
	
	if(isset($_POST['submit'])){
		try{
			include('connect.php');
			$user_email = $_POST['user_email'];
			$user_password = $_POST['user_password'];
			$login = "SELECT user_email,user_password FROM info WHERE user_email='$user_email' && user_password='$user_password'";
			$object = new connect;
			$login_data = $object->login($login);
			$_SESSION['loginError'] = 1;
		}catch(exception $error){
			$_SESSION['user'] = $user_email;
			header('location:personal.php');
		}
	}

?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
     <form action="" method="post">
        <h1>Login</h1>       
        <fieldset>
            <?php if (isset($_SESSION['loginError']) == 1){?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> Wrong Email and Password.
                </div>
            <?php unset($_SESSION['loginError']);}?>
          <legend><span class="number">1</span>Please Log In Here</legend>
          <label for="mail">Email:</label>
          <input required type="email" id="mail" name="user_email">
          
          <label for="password">Password:</label>
          <input required type="password" id="password" name="user_password">
          <button type="submit" name="submit">Login</button>
          <center><a style="text-decoration:none;color:#5fcf99;" href="index.php">Register Here</a></center>
        </fieldset>   
      </form>
    </body>
</html>


