<?php 

    if(isset($_POST['login'])){
        login($_POST['email'],$_POST['password']);
    }
    
?>

<form action="index.php" method="post">
	
		<label for="email">Email</label> 
		<input type="email" name="email" id="email">
	
		<label for="password">Password</label> 
		<input type="password" name="password" id="password">
	
	
	 <input type="submit" name="login">
</form>
<p> <a href='content/signUp.php'>Non sei ancora registrato ?</a></p>