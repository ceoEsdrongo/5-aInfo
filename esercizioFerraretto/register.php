<?php
include 'database.php';
$u = isset($_POST['username']) ? $_POST['username'] : '';
$p = isset($_POST['password']) ? $_POST['password'] : '';

// Trasformo la password in hash MD5, esattamente come facevi tu
$p = md5($p);

// Preparo la scatola sicura per INSERIRE i dati
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// ss significa che sono due stringhe/parole
$stmt->bind_param("ss", $u, $p);

// Spedisco la scatola al database
$stmt->execute();

// Finito! Ti rimando alla pagina di login
header("Location: login.html");
?>