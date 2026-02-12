<?php
include 'database.php';

$codFilm = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($codFilm)) {
    $sql = "DELETE FROM Film WHERE CodFilm=$codFilm";
    $result = $conn->query($sql);
    
    if($result == 1) {
        print("<h3>Film cancellato!</h3>");
        header('Refresh: 3; URL=index.php');
    } else {
        print("<h3>Errore: ID non trovato o problema nel database!</h3>");
    }
} else {
    print("<h3>Nessun ID fornito.</h3>");
    header('Refresh: 3; URL=index.php');
}
?>