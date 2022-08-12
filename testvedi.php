<?php
session_start();

require 'lib/Database.php';
require 'lib/Paginazione.php';
require 'lib/Aiuti.php';
require 'config.php';


$per_pagina =   ( isset( $_GET['per-pagina'] ) ) ? $_GET['per-pagina'] : ALLENAMENTI_PER_PAGINA;
$pagina     =   ( isset( $_GET['pagina'] ) ) ? $_GET['pagina'] : 1;
$links      =   ( isset( $_GET['links'] ) ) ? $_GET['links'] : 5;

//SQL FREQUENZA SELECT `inizio`, COUNT(*) AS freq FROM carico_lavoro GROUP BY `inizio`
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Paginazione</title>
</head>
<body>
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
    </form>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Data</th>
                <th>Inizio</th>
                <th>fine</th>
                <th>Durata</th>
                <th>rpe</th>
                <th>Allenamento</th>
                <th>tipo</th>
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
				</tr>
            <?php endfor;   ?>   
        </tbody>
    </table>
    <p><?php if($per_pagina == 0) : $Paginazione->totaleRighe() ? $per_pagina; ?> di <?php echo $Paginazione->totaleRighe(); ?></p>
    <?php  echo $Paginazione->creaLink($links, 'paginazione'); ?>
</body>
</html>