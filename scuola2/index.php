<?php
require_once "includes/init.php";

$db=new Db();

if(isset($_POST['logout'])){
    logout();
    header('Location:index.php?page=login');
} 
?>
<!DOCTYPE Html>
<html>
<head>
    
    
</head>
<body>
	<h1> Prova per login</h1>    
	<div>
        <form method='post' action='index.php'>
        	<input type=submit name='logout' value="logout">
        </form>
    </div>
    <?php
    
    
    $user = $_SESSION['user'];
    print_r($user);
    
    //print_r($db->getClassOfProf($user->getId())) ;    

        if(!isset($_SESSION['log'])){
            include 'content/login.php';
        }else{
            include 'content/home.php';
        }
    ?>

</body>
</html>