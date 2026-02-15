<?php
include 'database.php';

session_start();
$user = $_SESSION["username"];
$c = isset($_GET['categoria']) ? $_GET['categoria'] : 'Torte';
$r = "";
$sql = "SELECT * FROM dolce WHERE categoria = '$c'";
print($sql);
$result = $conn->query($sql);

foreach ($result as $row) {
    foreach ($row as $column => $value) {
        $r .= $value . " ";
    }
    $r .= "\n";
}


if($user) {
    print("
<html>
<body>
<h1>Home</h1>
Sei loggato come $user.<br>
<form action='' method='GET'>
Categoria: 
<select name='categoria'>
  <option value='Torte'>Torte</option>
  <option value='Gelato'>Gelato</option>
</select>
<input type='submit'>
</form>
Risultato:<br>
$r
</body>
</html>");
} else {
    header("error.html");
}

?>


