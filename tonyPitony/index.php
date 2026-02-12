<h2>Ricerca Regista</h2>
<form action='' method='GET'>
    Nome Regista: <input name='nomeRegista'>
    <input type='submit' value='Cerca Regista'>
</form>

<h2>Film di un Regista</h2>
<form action='' method='GET'>
    Nome Regista (per film): <input name='registaPerFilm'>
    <input type='submit' value='Cerca Film'>
</form>

<h2>Film di un Attore</h2>
<form action='' method='GET'>
    Nome Attore: <input name='nomeAttore'>
    <input type='submit' value='Cerca Film'>
</form>

<h2>Cinema per Città</h2>
<form action='' method='GET'>
    Città: <input name='citta'>
    <input type='submit' value='Cerca Cinema'>
</form>

<hr>
<h2>Risultati</h2>

<?php
include 'database.php';

// Recupero i parametri GET
$nomeRegista = isset($_GET['nomeRegista']) ? $_GET['nomeRegista'] : '';
$registaPerFilm = isset($_GET['registaPerFilm']) ? $_GET['registaPerFilm'] : '';
$nomeAttore = isset($_GET['nomeAttore']) ? $_GET['nomeAttore'] : '';
$citta = isset($_GET['citta']) ? $_GET['citta'] : '';

// 1. Ricerca Regista
if(!empty($nomeRegista)) {
    $sql = "SELECT * FROM Registi WHERE Nome LIKE '%" . $nomeRegista . "%'";
    $result = $conn->query($sql);
    print("<h3>Registi trovati: " . $result->num_rows . "</h3>");
    print("<table><tr><th>ID</th><th>Nome</th></tr>");
    foreach($result as $row) {
        print("<tr><td>" . $row["CodRegista"] . "</td><td>" . $row["Nome"] . "</td></tr>");
    }
    print("</table>");
}

// 2. Film di un Regista
if(!empty($registaPerFilm)) {
    // Join tra Film e Registi
    $sql = "SELECT Film.CodFilm, Film.Titolo, Film.Anno, Registi.Nome as NomeRegista 
            FROM Film 
            JOIN Registi ON Film.CodRegista = Registi.CodRegista 
            WHERE Registi.Nome LIKE '%" . $registaPerFilm . "%'";
    
    $result = $conn->query($sql);
    print("<h3>Film diretti da " . $registaPerFilm . ": " . $result->num_rows . "</h3>");
    print("<table><tr><th>Titolo</th><th>Anno</th><th>Regista</th><th>Azioni</th></tr>");
    foreach($result as $row) {
        // Aggiungo il link per cancellare come in orders.php
        print("<tr><td>" . $row["Titolo"] . "</td><td>" . $row["Anno"] . "</td><td>" . $row["NomeRegista"] . "</td>
        <td><a href='deleteFilm.php?id=". $row["CodFilm"] ."'>Cancella</a></td></tr>");
    }
    print("</table>");
}

// 3. Film di un Attore
if(!empty($nomeAttore)) {
    // Join tra Film, Recita (o tabella di mezzo) e Attori
    $sql = "SELECT Film.Titolo, Film.Anno, Attori.Nome as NomeAttore 
            FROM Film 
            JOIN Recita ON Film.CodFilm = Recita.CodFilm 
            JOIN Attori ON Recita.CodAttore = Attori.CodAttore 
            WHERE Attori.Nome LIKE '%" . $nomeAttore . "%'";
            
    $result = $conn->query($sql);
    print("<h3>Film con " . $nomeAttore . ": " . $result->num_rows . "</h3>");
    print("<table><tr><th>Titolo</th><th>Anno</th><th>Attore</th></tr>");
    foreach($result as $row) {
        print("<tr><td>" . $row["Titolo"] . "</td><td>" . $row["Anno"] . "</td><td>" . $row["NomeAttore"] . "</td></tr>");
    }
    print("</table>");
}

// 4. Cinema per Città
if(!empty($citta)) {
    $sql = "SELECT * FROM Cinema WHERE Citta LIKE '%" . $citta . "%'";
    $result = $conn->query($sql);
    print("<h3>Cinema a " . $citta . ": " . $result->num_rows . "</h3>");
    print("<table><tr><th>Nome Cinema</th><th>Città</th></tr>");
    foreach($result as $row) {
        print("<tr><td>" . $row["Nome"] . "</td><td>" . $row["Citta"] . "</td></tr>");
    }
    print("</table>");
}
?>