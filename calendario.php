<?php
session_start();

require 'lib/database.php';
require 'lib/calendario.php';
require 'config.php';


//$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$calendario = new Calendario('2022', '6');

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Carico Lavoro</title>
    <link href='https://css.gg/trash.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stile.css">
</head>
<body>
    <main>


<header>
	<h1>Carico Lavoro</h1>
	<a href="index.php">Aggiungi</a>
	<a href="vedi.php">Vedi allenamenti</a>
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
                <?php foreach ($calendario->getGiorniSettimana as $nomeGiorno): ?>
                    <th>
                        <?php echo $nomeGiorno; ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($calendario->getSettimane() as $settimana):  ?>
                <tr>
                    <?php foreach($settimana as $numero):  ?>
                        <td>
                            <?php echo $numero; ?>
                        </td>
                    <?php endforeach; ?>

				</tr>
            <?php endforeach;   ?>    
        </tbody>
    </table>
</section>
</main>
</body>
</html>