<?php
	session_start();

    require "code/vendor/autoload.php";
    require "code/includes/database.php";

	$title = 'Demogram';

	$filename = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME );

	$pages = array(
		'trending' => 'Trending Photos',
		'friends' => 'Friends Photos',
		'upload' => 'Upload Photos',
		'categories' => 'Categories',
        'profile' => 'Profile'
	);

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <!--<html class="no-js">--> <!--<![endif]-->
    <head>
        
        
		<?php if (isset($pages[$filename])) : ?>
			<title><?php echo $pages[$filename] . ' | ' . $title; ?></title>
		<?php else : ?>
			<title><?php echo $title; ?> - Make your pictures known.</title>
		<?php endif; ?>
        

        
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	
    </head>
    <div id="header">
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#">Demogram</a></h1>
					<span>A place for friends to share</span>
				</div>
				
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li class="<?php echo ($filename === 'home') ? 'active' : ''; ?>"><a href="home.php">Home</a></li>
						<li class="<?php echo ($filename === 'trending') ? 'active' : ''; ?>"><a href="trending.php">Trending</a></li>
						<li class="<?php echo ($filename === 'friends') ? 'active' : ''; ?>"><a href="friends.php">Friends</a></li>
						<li class="<?php echo ($filename === 'categories') ? 'active' : ''; ?>"><a href="categories.php">Categories</a></li>
						<?php if(isset($_SESSION['user'])) : ?>
						<li><a href="signout.php" class="">Sign out, <?php echo $_SESSION['user']->user_first_name; ?></a></li>
						<?php else : ?>
						<li><a href="signin.php" class="">Sign in</a></li>
						<?php endif; ?>
					</ul>
				</nav>
			</div>
		</div>
    
