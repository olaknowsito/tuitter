<?php  
    require 'config/config.php';
    include("includes/classes/User.php");
	include("includes/classes/Post.php");
	include("includes/classes/Message.php");

        // if this session variasnble is set, make the user loggedin = username
    if (isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
        // returns all information of user logged in
        $user = mysqli_fetch_array($user_details_query);
    } else {
        // send back to the register page if not log in
        header('Location: register.php');
    }
?>


<!DOCTYPE html>
<html>
<head>
<title>Tuitter</title>
    <!-- jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- js bootsrap  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/demo.js"></script>
    <script src="assets/js/jquery.jcrop.js"></script>
    <script src="assets/js/jcrop_bits.js"></script>



    <!-- css boostrap -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>
    <div class="top-bar">
        <div class="logo">
            <a href="index.php" style="color:white">Tuitter</a>
        </div>

        <nav>
            <a href="<?php echo $userLoggedIn?>">
                <?php echo $user['first_name']; ?>
            </a>
            <a href="index.php">
                <i class="fa fa-home fa-lg"></i>
            </a>
            <a href="messages.php">
                <i class="fa fa-envelope fa-lg"></i>
            </a>
            <a href="">
                <i class="fa fa-bell fa-lg"></i>
            </a>
            <a href="requests.php">
                <i class="fa fa-users fa-lg"></i>
            </a>
            <a href="upload.php">
                <i class="fa fa-cog fa-lg"></i>
            </a>
            <a href="includes/handlers/logout.php">
                <i class="fa fa-sign-out-alt fa-lg"></i>
            </a>
        </nav>

    </div>
    
    <div class="wrapper">