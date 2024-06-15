<?php
/**
 * loadContent
 * Load the Content
 * @param $default
 */
function loadContent($where, $default='') {
  // Get the content from the url 
  // Sanitize it for security reasons
  $content = filter_input(INPUT_GET, $where, FILTER_SANITIZE_STRING);
  $default = filter_var($default, FILTER_SANITIZE_STRING);
  // If there wasn't anything on the url, then use the default
  $content = (empty($content)) ? $default : $content;
  // If you found have content, then get it and pass it back
  if ($content) {
  // sanitize the data to prevent hacking.
  $html = include 'content/'.$content.'.php';
  return $html;
  }
}

//----------------------------------------------------------------------------------

 function signUp($pdo,$nome,$cognome,$email,$psw,$psw2){
        
  try{
    
    if (empty($nome)||empty($cognome)||empty($email)||empty($psw)||empty($psw2)) {
        throw new Exception('Campi mancanti!'); 
    }    
    
    if ($psw!=$psw2) {
        throw new Exception('La password di conferma non corrisponde');
    }
    
    $sql="SELECT COUNT(*) FROM utenti WHERE email=:email";
    $stmt = $pdo->prepare($sql);        
    $stmt->execute(['email'=>$email]);
    $result = $stmt->fetchcolumn(); 
    if ($result>0) {
        throw new Exception('La mail è già in uso');
    }    
    $hash_psw = password_hash($psw, PASSWORD_DEFAULT);
    $sql2="INSERT INTO utenti (nome_utente,cognome_utente,email,password)
            VALUES(
            :nome,
            :cognome,
            :email,
            :psw
            )";    
    $stmt=$pdo->prepare($sql2);
    $stmt->execute([
        'nome'=>$nome,
        'cognome'=>$cognome,
        'email'=>$email,
        'psw'=>$hash_psw    
    ]);
    
  }catch (Exception $e){
      echo "<script>alert('Errore: '".$e->getMessage()."');</script>";
      exit();
  }
}

//----------------------------------------------------------------

function login($email,$password){
    //connessione a PDO
    $db = new Db;
    $pdo = $db -> connectDB();
    
    //quary
    $sql = 'SELECT nome_utente,cognome_utente,email,id_utente,id_ruolo,password,classe FROM utenti WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email'=>$email]);
    //TODO probabilmente era meglio usare FETCH_CLASS
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    
    foreach ($result as $value) {
        print_r($value).'</br>';
    }
    //risultato non trovato
    if ($stmt->rowCount() < 1) {
        echo  "<script>alert('Utente non trovato');</script>";
        return;
    }
    if(!password_verify($password,$result->password)){
        echo "<script>alert('Credenziali non valide');</script>";
        return;
    }//
    else{
    if (is_null($result->id_ruolo)) {
        $user = new User(
            $result->nome_utente,
            $result->cognome_utente,
            $result->id_utente,
            NULL,
            $result->email,
            $result->password
            );
    }elseif ($db->getRoleById($result->id_ruolo) === 'studente'){
        $user = new Studente(
            $result->nome_utente,
            $result->cognome_utente,
            $result->id_utente,
            $result->id_ruolo,
            $result->email,
            $result->password,
            $result=$db->getClassById($result->id_utente)
            );
        print_r($user);
    }elseif ($db->getRoleById($result->id_ruolo)==='docente'){
        
        $courses = $db->getCoursesProf($result->id_utente);
        $classes = $db->getClassOfProf($result->id_utente);
        
        $user = new Prof(
            $result->nome_utente,
            $result->cognome_utente,
            $result->id_utente,
            $result->id_ruolo,
            $result->email,
            $result->password,
//TODO capire se va tolto $result i coureses e classes
//$courses e $classes non appaiono come istanze nell'oggetto
//probabilmente perchè non estrapolate nella prima quary
//errore ?
            $result->$courses,
            $result->$classes
            );
    }
        $_SESSION['user'] = $user;
        $_SESSION['log'] = TRUE;
        header('Location:index.php?page=home');
        $db = null;
    }
    
}

function logout() {
    session_unset();
    session_destroy();
}
