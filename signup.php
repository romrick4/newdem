<?php
	session_start();
	require "code/vendor/autoload.php";
    require "code/includes/database.php";
	$post = $_POST;
	

				
			if(isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])){

				
				if(strlen($_POST['password']) < 6){
                    $_SESSION['message'] = '';
                    $_SESSION['message'] .= '<div class="alert alert-danger" role="alert">';
                    $_SESSION['message'] .= '<strong>Error!</strong> Your password must be at least 6 characters long';
                    $_SESSION['message'] .= '</div>';
                        if(isset($_SESSION["message"]))
                        {
                            echo $_SESSION["message"];
                            unset($_SESSION["message"]);
                        }
                }elseif($_POST['password'] != $_POST['confirm_password']){
                    $_SESSION['message'] = '';
                    $_SESSION['message'] .= '<div class="alert alert-danger" role="alert">';
                    $_SESSION['message'] .= '<strong>Error!</strong> Your passwords do not match.';
                    $_SESSION['message'] .= '</div>';
                    if(isset($_SESSION["message"]))
                    {
                        echo $_SESSION["message"];
                        unset($_SESSION["message"]);
                    }
                }else{
				
				 $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
				
				$query = $db->getQuery(true);
					
				$query->insert('#__users');
				$query->set('user_first_name = ' . $db->quote($_POST['firstname']));
				$query->set('user_last_name = ' . $db->quote($_POST['lastname']));
				$query->set('user_username = ' . $db->quote($_POST['username']));
				$query->set('user_email = ' . $db->quote($_POST['email']));
				$query->set('user_password= ' . $db->quote($hash_pass));
				$query->set('user_creation_date = NOW()');
				
				$db->setQuery($query);
				
				try{
					$result = $db->execute();
					
					if($result){
						$user_id = $db->insertid();
						$_SESSION['logged_in_status'] = 1;
                        header('Location: index.php');
                        $_SESSION['message'] = '';
                        $_SESSION['message'] .= '<div class="alert alert-success" role="alert">';
                        $_SESSION['message'] .= '<strong>Congratulations!</strong> Your account was successfully created. Please sign in.';
                        $_SESSION['message'] .= '</div>';
					}
				} catch(RuntimeException $e){
					$e->getCode() . ' ' . $e->getMessage();
				}
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
			<div>Sign Up<span> Here</span></div>
		</div>
		<br>
		<div class="login">
		<form method="post" role="form">
 				<input type="text" name="firstname" class="form-control" placeholder="First Name" required autofocus><br>
				<input type="text" name="lastname" class="form-control" placeholder="Last Name" required autofocus><br>
				<input type="text" name="username" class="form-control" placeholder="User Name" required autofocus><br>
				<input type="email" name="email" class="form-control" placeholder="Email address" required autofocus><br>
				<input type="password" name="password" class="form-control" placeholder="Password" required><br>
				<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required><br>
				<input type="submit" value="Create Account">
				</form>
		</div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

</body>

</html>
