<?php
include 'database.php';
$u = isset($_POST['username']) ? $_POST['username'] : '';
$p = isset($_POST['password']) ? $_POST['password'] : '';

// Trasformo la password in md5 
$p = md5($p);

// Preparo la ricerca sicura
$sql = "SELECT * FROM users WHERE username=? and password=?";
$stmt = $conn->prepare($sql);

// Inserisco utente e password
$stmt->bind_param("ss", $u, $p);

//  Eseguo la ricerca
$stmt->execute();


$result = $stmt->get_result(); 

// Controllo se l'utente esiste (uguale al tuo)
if($result->num_rows == 1) {
    // Va alla home
    header("Location: home.php");
    die();
}

// Non trovato, va alla pagina di errore
header("Location: error.html");
?>