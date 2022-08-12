<?php
session_start();

require 'lib/Database.php';
require 'lib/Paginazione.php';
require 'lib/Aiuti.php';
require 'config.php';


$per_pagina =   ( isset( $_GET['per-pagina'] ) ) ? $_GET['per-pagina'] : ALLENAMENTI_PER_PAGINA;
$pagina     =   ( isset( $_GET['pagina'] ) ) ? $_GET['pagina'] : 1;
$links      =   ( isset( $_GET['links'] ) ) ? $_GET['links'] : 5;

$query = "SELECT id,inizio,fine,rpe,allenamento,tipo, DATE_FORMAT(giorno, '%d %m %Y') as giorno,
    TIMEDIFF(fine,inizio) as durata
    FROM carico_lavoro
    ORDER BY carico_lavoro.giorno DESC,
    carico_lavoro.inizio DESC";

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$Paginazione  = new Paginazione( $connessione->ottieniConnessione(), $query );
$dati = $Paginazione->getDati( $per_pagina, $pagina );

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carico Lavoro</title>
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
	<a href="calendario.php">Calendario</a>
</header>

<section class="messaggio">
    <?php if(!empty($_SESSION['messaggio'])): ?>
        <p class="messaggio__testo messaggio__testo-successo"><?php echo $_SESSION['messaggio'];  unset($_SESSION['messaggio']);?></p>
    <?php endif; ?>
</section>
<section>
    <form action="testvedi.php"  method="get">
        <label for="per-pagina">Visualizza elementi: </label>
        <select name="per-pagina" id="per-pagina">
            <option value="0">Tutti</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
            <option value="50">50</option>
        </select>
        <input type="submit" value="Filtra">
<table role="grid">
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
            <?php for( $i = 0; $i < count( $dati->data ); $i++ ): ?>
                <tr>
                    <td><?php echo $dati->data[$i]['id']; ?></td>
                    <td><?php echo $dati->data[$i]['giorno']; ?></td>
                    <td><?php echo $dati->data[$i]['inizio']; ?></td>
                    <td><?php echo $dati->data[$i]['fine']; ?></td>
                    <td><?php echo $dati->data[$i]['durata']; ?></td>
                    <td><?php echo $dati->data[$i]['rpe']; ?></td>
                    <td><?php echo $dati->data[$i]['allenamento']; ?></td>
                    <td><?php echo $dati->data[$i]['tipo']; ?></td>
                    <td><a href="elimina.php?id=<?php echo $wod->data[$i]['id'] ?>" data-id="<?php echo $wod->data[$i]['id'] ?>"><i class="gg-trash"></i></a></td>
				</tr>
            <?php endfor;   ?>   
        </tbody>
    </table>
</section>
<section>
    <p>
        <?php if ($per_pagina == 0) { echo "Mostrati: ".$Paginazione->totaleRighe()." Allenamenti"; } else { echo "Mostrati: ".$per_pagina." di ".$Paginazione->totaleRighe(); } ?> 
    </p>
    <p>
        <?php  if($per_pagina != 0) {echo $Paginazione->creaLink($links, 'paginazione');  }?>
    </p>
</section>
</main>
</body>
</html>