<h2>Inserimento Film</h2>
<form action='' method='GET'>
    Titolo: <input name='titolo'><br>
    Anno: <input type='number' name='anno'><br>
    Genere: <input name='genere'><br>
    
    Regista: <select name='codRegista'>
    <?php
    include 'database.php';
    // Carico i registi dal DB per popolare la select (come nella traccia)
    $sql = "SELECT CodRegista, Nome FROM Registi";
    $result = $conn->query($sql);
    foreach($result as $row) {
        print("<option value='". $row["CodRegista"] ."'>".$row["Nome"] ."</option>");
    }
    ?>
    </select><br>
    
    <input type='submit' value='Inserisci Film'>
</form>
<a href="index.php">Torna alla Home</a>

<?php
// Logica di inserimento
$titolo = isset($_GET['titolo']) ? $_GET['titolo'] : '';
$anno = isset($_GET['anno']) ? $_GET['anno'] : '';
$genere = isset($_GET['genere']) ? $_GET['genere'] : '';
$codRegista = isset($_GET['codRegista']) ? $_GET['codRegista'] : '';

if(!empty($titolo) && !empty($codRegista)) {
    $sql = "INSERT INTO Film (Titolo, Anno, Genere, CodRegista) VALUES
    ('$titolo', '$anno', '$genere', '$codRegista')";

    $result = $conn->query($sql);
    if($result == 1) {
        print("<h3>Film Inserito Correttamente!</h3>");
        header('Refresh: 3; URL=index.php'); 
    } else {
        print("<h3>C'è stato un problema!</h3>");
    }
}
?>