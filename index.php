<?php
session_start();

require 'lib/database.php';
require 'lib/Aiuti.php';
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
            <!-- STATISTICHE ULTIMO ALLENAMENTO -->
            <h3>Statistiche ultima sessione di allenamento</h3>
            <p>Ciao, l'ultima volta ti sei allenato il giorno: <b><?php echo $ultimo['giorno']; ?></b> (<i><?php echo $ultimo['giorno_indietro']; ?></i> fa) per una durata di:
            <b><?php echo $ultimo['durata']; ?></b> ore, ad un <b>RPE</b> di: <?php echo $ultimo['rpe']; ?>
            che corrisponde a un <i>carico di lavoro</i> di: <b><?php echo $ultimo['carico']; ?></b>.</p>
            <!-- TOTALI ALLENAMENTO -->
            <h3>Storico allenamenti</h3>
            <p>Al momento hai uno storico di <b><?php echo $totali['allenamenti']; ?> allenamenti</b>. La media dei tuoi <b>RPE</b> si assesta a: <?php echo $totali['rpe']; ?>.</p>
        </section>
        <h2>Aggiungi nuovo carico lavoro</h2>
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
                    <option value="weight lifting">Weight Lifting</option>
                    <option value="power lifting">Power Lifting</option>
                    <option value="row">Row</option>
                    <option value="corsa">Corsa</option>
                    <option value="bici">Bici</option>
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

    $sql = "SELECT rpe, DATE_FORMAT(giorno, '%d/%m') as giorno, TIMEDIFF(fine, inizio) as tempo, 
    DATEDIFF(CURDATE(), giorno) as giorni_indietro
    FROM carico_lavoro ORDER BY carico_lavoro.giorno DESC LIMIT 1";

    $stm = $connessione->query($sql);
    $row = $connessione->singleRow($stm);

    $dati = [
        "giorno" => $row->giorno,
        "durata" => $row->tempo,
        "giorno_indietro" => Aiuti::giorni($row->giorni_indietro),
        "carico" => $row->rpe * Aiuti::daOreaMinuti($row->tempo),
        "rpe" => $row->rpe
    ];

    return $dati;
}

function totaliAllenamento($connessione) {
    $sql = "SELECT COUNT(*) as totale, AVG(`rpe`) as rpe_medio FROM carico_lavoro";

    $stm = $connessione->query($sql);
    $row = $connessione->singleRow($stm);

    $totali  = [
        "allenamenti" => $row->totale,
        "rpe" => round($row->rpe_medio)
    ];

    return $totali;

}

?>