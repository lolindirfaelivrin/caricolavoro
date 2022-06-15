<?php
session_start();

require 'lib/database.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$ultimo = ultimoAllenamento($connessione);
$totali = totaliAllenamento($connessione);

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stile.css">
    <title>Carico Lavoro</title>
</head>
<body>
<header>
	<h1>Carico Lavoro</h1>
	<a href="vedi.php">Vedi Allenamenti</a>
</header>
    <main>
        <section>
            <p>Ciao, l'ultima volta ti sei allenato il giorno: <?php echo $ultimo->giorno; ?> per un totale di ore, 
            <?php echo $ultimo->durata; A?>
            con un carico di: <?php echo $ultimo->carico; ?></p>
            <p>Al momento hai uno storico di allenamenti per un totale di ore.</p>
        </section>
        <h2>Nuovo Carivo lavoro</h2>
        <section class="carico">
            <form action="salva.php" method="post">
            <div class="carico__data">
                <label for="carico-giorno">Giorno</label>
                <input type="date" name="carico-giorno" id="carico-giorno">
            </div>
            <div class="carico__ore">
                <label for="carico-inizio">Inizio</label>
                <input type="time" name="carico-inizio" id="carico-inizio">
                <label for="carico-inizio">Fine</label>
                <input type="time" name="carico-fine" id="carico-inizio">
            </div>
            <div class="carioco__dati">
                <label for="carico-rpe">Rpe</label>
                <select name="carico-rpe" id="carico-rep">
                    <option value="6">6</option>
                    <option value="6.5">6,5</option>
                    <option value="7">7</option>
                    <option value="7.5">7,5</option>
                    <option value="8">8</option>
                    <option value="8.5">8,5</option>
                    <option value="9">9</option>
                </select>
                <label for="carico-allenamento">Allenamento</label>
                <select name="carico-allenamento" id="carico-allenamento">
                    <option value="wl">WL</option>
                    <option value="pl">PL</option>
                    <option value="row">ROW</option>
                    <option value="run">RUN</option>
                    <option value="bike">BIKE</option>
                </select>
                <label for="carico-tipo">Tipo Allenamento</label>
                <select name="carico-tipo" id="carico-tipo">
                    <option value="allenamento" select>Allenamento</option>
                    <option value="gara">Gara</option>
                </select>
            </div>
                <input type="submit" value="salva" name="salva" id="salva">
            </form>
        </section>
    </main>
</body>
</html>


<?php

function ultimoAllenamento($connessione) {

    $sql = "SELECT rpe, DATE_FORMAT(giorno, '%d %m) as giorno, TIME_DIFF(fine, inizio) as tempo 
    FROM carico_lavoro 
    ORDER BY giorno DESC LIMIT 1 ";

    $stm = $coneessione->query($sql);

    $row = $stm->singleRow($stm);

    $dati = [
        "giorno" => $row->giorno,
        "durata" => $row->tempo,
        "carico" => $row->rpe * $row->tempo
    ]

    return $dati;
}

function totaliAllenamento($connessione) {
    $sql = "SELECT "
}

?>