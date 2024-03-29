<?php

class Aiuti  
{
    public static function reIndirizza($pagina) {
        //header("Location: http://demonation.altervista.org/minisiti/allenamento/carico/vedi.php");
        header("Location: APP_WEB_ROOT."/".$pagina");
    }

    //  "1:45" nel numero totale di minuti, "105".
    public static function daOreaMinuti($ore) {
        $minuti = 0; 
        if (strpos($ore, ':') !== false) 
        { 
            // Split hours and minutes. 
            list($ore, $minuti) = explode(':', $ore); 
        } 
        return $ore * 60 + $minuti;        
    }

    // "105" in ore "1:45".
    public static function daMinutiaOre($minuti) {
        $ore = (int)($minuti / 60); 
        $minuti -= $ore * 60; 
        return sprintf("%d:%02.0f", $ore, $minuti);       
    }

    public static function creaURL($parti) {
        $indirizzo = APP_WEB_ROOT . "?" . http_build_query($parti);  
        
        return $indirizzo;
    }

    //https://dev.to/jeremysawesome/php-get-first-and-last-day-of-week-by-week-number-3pcd
    public static function inizioEfineData($week, $year) {
        $dateTime = new DateTime();
        $dateTime->setISODate($year, $week);
        $result['start_date'] = $dateTime->format('d-M-Y');
        $dateTime->modify('+6 days');
        $result['end_date'] = $dateTime->format('d-M-Y');
        return $result;
      }

      public static function dump($variabile, $messaggio = '', $esci = true) {
        if($esci) {
            echo "<p><b>".$messaggio."</b></p>";
            echo "<pre style=\"border: 1px solid #000; height: 9em; overflow: auto; margin: 0.5em; padding: 0.5em;\">";
            var_dump($variabile);
            echo "</pre>\n";
            exit;
        } else {
            echo "<p><b>".$messaggio."</b></p>";
            echo "<pre style=\"border: 1px solid #000; height: 9em; overflow: auto; margin: 0.5em; padding: 0.5em;\">";
            var_dump($variabile);
            echo "</pre>\n";            
        }
      }

      //Crea uno script javascript per scrivere un messaggio nella console
      //https://stackify.com/how-to-log-to-console-in-php/ 
      public static consoleLog($messaggio, $script = true) {
        
        $codice = 'console.log('.json_encode($messaggio, JSON_HEX_TAG).')';

        if($script) {
            $codice = '<script>'.$codice.'</script>';
        }

        echo $codice;
      }

      public static function nomeMesi($mese) {
        $mesi = ['Gennaio', 'Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
            return $mesi[$mese];
      }

      public static function nomeGiorni($giorno) {
        $giorni = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];
        return $giorni['$giorno'];
      }

      public static function giorni($numero) {
        if($numero == 0) {
            return 'oggi';
        }
        if($numero == 1) {
            return '1 giorno fa';
        }
        if($numero > 1) {
            return "{$numero} giorni fa";
        }
      }

}


?>