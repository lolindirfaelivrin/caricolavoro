<?php
session_start();

require 'lib/database.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_GET['id'])) {

    if (filer_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) && $_GET['id'] < $LIMIT)   {
        # code...

        $datiCarico = [
            "caricoId" => filter_var( $_GET['id'], FILTER_SANITIZE_NUMBER_INT)
        ];
    } else {
        $_SESSION['messaggio'] = 'Allenamento non valido, verifica!';
        //Reindirizzo
    }

    if(eliminaWod($datiCarico, $connessione)) {

        $_SESSION['messaggio'] = 'Allenamento eliminato correttamente';

        header("Location: http://demonation.altervista.org/minisiti/allenamento/carico/vedi.php");
    } else {
        $_SESSION['messaggio'] = 'Non è stato possibile eliminare i dati di allenamento';

        header("Location: http://demonation.altervista.org/minisiti/allenamento/carico/vedi.php");        
    }

}



function eliminaWod($valori, $satabase) {
    $satabase->query('DELETE FROM carico_lavoro WHERE id = :id');

    $satabase->bind(':id', $valori['caricoId']);

    if ($satabase->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }
