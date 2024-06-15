<?php

include_once '../includes/functions.php';
include_once '../includes/classes/Db.php';

if (isset($_POST['sign_up'])) {
    try {
        $db = new Db();
        $pdo=$db->connectDB();
        signUp($pdo,$_POST['nome'],$_POST['cognome'],$_POST['email'],$_POST['psw'],$_POST['psw2']);        
        header('Location:../index.php');
    } catch (Exception $e) {
        echo "<script>alert('Errore nella funzione di signUp');</script>";
    }finally {
        
        $pdo = null;
    }
}

?>

<h2>SIGN UP</h2>
<form action="signUp.php" method="post">
		<label for="nome">Nome</label> 
		<input type="text" name="nome" id="nome">
		<br>
		<label for="cognome">Cognome</label> 
		<input type="text" name="cognome" id="cognome">
		<br>
		<label for="email">Email</label> 
		<input type="email" name="email" id="email">
		<br>
		<label for="psw">Password</label> 
		<input type="password" name="psw" id="psw">
		<br>
		<label for="psw2">Ripeti password</label> 
		<input type="password" name="psw2" id="psw2">
		<br>
	<input type="submit" name="sign_up">
</form>
<p><a href="../index.php?page=login">Hai gi&agrave un account?</a></p>
