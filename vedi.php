<?php
session_start();

require 'lib/database.php';
require 'config.php';


$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$sql = $connessione->query("SELECT id,inizio,fine,rpe,allenamento,tipo, DATE_FORMAT(giorno, '%d %m %Y') as giorno,
 TIMEDIFF(fine,inizio) as durata
 FROM carico_lavoro
 ORDER BY giorno DESC");

$dati = $connessione->resultSet($sql);

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carico Lavoro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stile.css">
</head>
<body>
<header>
	<h1>Carico Lavoro</h1>
	<a href="index.php">Aggiungi</a>
</header>
<section class="messaggio">
    <?php if(!empty($_SESSION['messaggio'])): ?>
        <p class="messaggio__testo messaggio__testo-successo"><?php echo $_SESSION['messaggio'];  unset($_SESSION['messaggio']);?></p>
    <?php endif; ?>
</section>
<section class="tabella">
<table class="tabella__dati">
        <thead>
            <tr>
                <th>#</th>
                <th>Data</th>
                <th>Inizio</th>
                <th>Fine</th>
                <th>Durata Allenamento</th>
                <th>Rpe</th>
                <th>Allenamento</th>
                <th>Tipo</th>
                <th>Elimina</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dati as $wod):  ?>
                <tr>
                    <td><?php echo $wod->id ?></td>
                    <td><?php echo $wod->giorno ?></td>
                    <td><?php echo $wod->inizio ?></td>
                    <td><?php echo $wod->fine ?></td>
                    <td><?php echo $wod->durata?></td>
                    <td><?php echo $wod->rpe ?></td>
                    <td><?php echo $wod->allenamento ?></td>
                    <td><?php echo $wod->tipo ?></td>
                    <td><a href="elimina.php?id=<?php echo $wod->id ?>" data-id="<?php echo $wod->id ?>">Elimina</a></td>
				</tr>
            <?php endforeach;   ?>    
        </tbody>
    </table>
</section>

</body>
</html>

<?php

function calcolaTempo($inizio, $fine) {
    $inizio = strtotime($inizio);
    $fine = strtotime($fine);     
    $secondi = $fine - $inizio;                            
    $intervallo = ($secondi/3600);
    return $intervallo;
}

?>