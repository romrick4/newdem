<?php
	session_start();
	require "code/vendor/autoload.php";
    require "code/includes/database.php";
	$post = $_POST;
	

				
			if(isset($_POST['email'], $_POST['password'])){

				
				
				
				 $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
				
				$query = $db->getQuery(true);
				$query->select('*');
				$query->from('#__users');
				$query->where('user_email = ' . $db->quote($_POST['email']));
				
				
				$db->setQuery($query);
				
				try{
					$user = $db->loadObject();
					
					if($user){						
						if(password_verify($_POST['password'], $user->user_password)){
							$_SESSION['logged_in_status'] = 1;
							$_SESSION['user'] = $user;
							header("Location: home.php");
						}else{
							$_SESSION['logged_in_status'] = 0;

                            if($_SESSION['logged_in_status'] == 0){
                                $_SESSION['message'] = '';
                                $_SESSION['message'] .= '<div class="alert alert-danger" role="alert">';
                                $_SESSION['message'] .= '<strong>Oops!</strong> Either your username or password are incorrect';
                                $_SESSION['message'] .= '</div>';
                                    if(isset($_SESSION["message"]))
                                    {
                                        echo $_SESSION["message"];
                                        unset($_SESSION["message"]);
                                    }
                            }


                        }


					}
				} catch(RuntimeException $e){
					$e->getCode() . ' ' . $e->getMessage();
				}
				//echo print_r($db);
				
			}	
				
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Sign in to Demogram</title>

    <style>
@import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url(http://ginva.com/wp-content/uploads/2012/07/city-skyline-wallpapers-008.jpg);
	background-size: cover;
	-webkit-filter: blur(5px);
	z-index: 0;
}

.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-family: inherit;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: #5379fa !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: inherit;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=email]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: inherit;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: inherit;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=submit]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: inherit;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=submit]:hover{
	opacity: 0.8;
}

.login input[type=submit]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
</style>

    <script src="js/prefixfree.min.js"></script>

</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Sign In<span> Here</span></div>
		</div>
		<br>
		<div class="login">
		<form method="post" role="form">
 				<input name="email" type="email" placeholder="Email address" required autofocus><br>
				<input name="password" type="password" placeholder="Password" required><br>
				<input type="submit" value="Login">
				</form>
				<h2>Don't have an account? Sign up <a href="signup.php">here</a>!</h2>
		</div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

</body>

</html>
