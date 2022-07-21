<?php
session_start();

require 'lib/Database.php';
require 'lib/Paginazione.php';
require 'lib/Aiuti.php';
require 'config.php';


$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 5;
$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 10;
$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 5;

//SQL FREQUENZA SELECT `inizio`, COUNT(*) AS freq FROM carico_lavoro GROUP BY `inizio`
$query = "SELECT id,inizio,fine,rpe,allenamento,tipo, DATE_FORMAT(giorno, '%d %m %Y') as giorno,
    TIMEDIFF(fine,inizio) as durata
    FROM carico_lavoro
    ORDER BY carico_lavoro.giorno DESC,
    carico_lavoro.inizio DESC";
$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$Paginazione  = new Paginazione( $connessione->ottieniConnessione(), $query );
$dati = $Paginazione->getDati( $page, $limit );

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
                <th>elemina</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dati as $wod): ?>
                <tr>
                    <td><?php echo $wod->id ?></td>
                    <td><?php echo $wod->giorno ?></td>
                    <td><?php echo $wod->inizio ?></td>
                    <td><?php echo $wod->fine ?></td>
                    <td><?php echo $wod->durata?></td>
                    <td><?php echo $wod->rpe ?></td>
                    <td><?php echo $wod->allenamento ?></td>
                    <td><?php echo $wod->tipo ?></td>
                    <td><a href="elimina.php?id=<?php echo $wod->id ?>" data-id="<?php echo $wod->id ?>"><i class="gg-trash"></i>/a></td>
				</tr>
            <?php endforeach;   ?>   
        </tbody>
    </table>
    <?php  echo $Paginazione->creaLink($links, 'pagination pagination-sm'); ?>
</body>
</html>