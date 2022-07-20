<?php
session_start();

require 'lib/database.php';
require 'lib/Aiuti.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_POST)) {

    $datiCarico = [
        "caricoGiorno" => $_POST['carico-giorno'],
        "caricoInizio" => $_POST['carico-inizio'],
        "caricoFine" => $_POST['carico-fine'],
        "caricoRpe" => filter_var($_POST['carico-rpe'], FILTER_SANITIZE_NUMBER_INT),
        "caricoAllenamento" => filter_var($_POST['carico-allenamento'], FILTER_SANITIZE_STRING),
        "caricoTipo" => filter_var($_POST['carico-tipo'], FILTER_SANITIZE_STRING)
    ];

    if(salvaCarico($datiCarico, $connessione)) {

        $_SESSION['messaggio'] = 'Carico Lavoro salvato correttamente';

        header("Location: http://demonation.altervista.org/minisiti/allenamento/carico/vedi.php");
    }

}



function salvaCarico($valori, $satabase) {
    $satabase->query('INSERT INTO carico_lavoro (giorno,inizio,fine,rpe,allenamento,tipo) VALUES(:giorno, :inizio, :fine, :rpe, :allenamento, :tipo)');

    $satabase->bind(':giorno', $valori['caricoGiorno']);
    $satabase->bind(':inizio', $valori['caricoInizio']);
    $satabase->bind(':fine', $valori['caricoFine']);
    $satabase->bind(':rpe', $valori['caricoRpe']);
    $satabase->bind(':allenamento', $valori['caricoAllenamento']);
    $satabase->bind(':tipo', $valori['caricoTipo']);

    if ($satabase->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }

  ?>