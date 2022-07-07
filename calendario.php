<?php
session_start();

require 'lib/database.php';
require 'lib/Calendario.php';
require 'lib/Aiuti.php';
require 'config.php';

if(isset($_POST['filtra'])) {
    $corrente_mese = $_POST['mese'];
    $corrente_anno = $_POST['anno'];
} else {
	$corrente_mese = date("m");
    $corrente_anno = date("Y");
}


$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$allenamenti = trovaAllenamenti($corrente_anno, $corrente_mese, $connessione);

$calendario = new Calendario($corrente_anno,$corrente_mese);
$calendario->creaCalendario();

$anni = trovaAnniAllenamento($connessione);
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
    <script src="js/app.js" defer></script>
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
<section>
    <div class="centro">
        <h2 data-mese="<?php echo $corrente_mese; ?>">Calendario <?php echo $corrente_anno; ?> - <?php echo Aiuti::nomeMesi(($corrente_mese * 1) -1);  ?>( <?php echo count($allenamenti); ?> allenamenti)</h2>
    </div>
    <form action="calendario.php" method="POST">
        <select name="anno">
            <?php foreach ($anni as $anno): ?>
            <option value="<?php echo $anno; ?>"><?php echo $anno; ?></option>
            <?php endforeach; ?>
        </select>
        <select name="mese">
            <option value="01" id="1" >Gennaio</option>
            <option value="02" id="2">Febbraio</option>
            <option value="03" id="3">Marzo</option>
            <option value="04" id="4">Aprile</option>
            <option value="05" id="5">Maggio</option>
            <option value="06" id="6">Giugno</option>
            <option value="07" id="7">Luglio</option>
            <option value="08" id="8">Agosto</option>
            <option value="09" id="9">Settembre</option>
            <option value="10" id="10">Ottobre</option>
            <option value="11" id="11">Novembre</option>
            <option value="12" id="12">Dicembre</option>
        </select>
        <input type="submit" name="filtra" value="Filtra per data">
    </form>    
<table role="grid">
        <thead>
            <tr>
                <?php foreach ($calendario->getGiorniSettimana() as $nomeGiorno): ?>
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
                        <td class="<?php if(in_array($numero, $allenamenti)) echo"a";?>">
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

<?php
function trovaAllenamenti($anno, $mese, $connessione) {
	$cerca  = $anno.'-'.$mese.'-'.'01';
	$sql = "SELECT giorno, DAY(giorno) as giorno_settimana FROM carico_lavoro 
    WHERE MONTH(giorno)=MONTH('".$cerca."')";
    $stm = $connessione->query($sql);
    $dati = $connessione->resultSet($stm);
    
    $giorni = array_column($dati, 'giorno_settimana');

    return $giorni;
}

function trovaAnniAllenamento($connessione) {
    $sql = "SELECT DISTINCT YEAR(giorno) as anni FROM carico_lavoro";
    $stm = $connessione->query($sql);
    $dati = $connessione->resultSet($stm);
    $anni = array_column($dati, 'anni');

    return $anni;
}
?>