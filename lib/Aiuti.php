<?php

class Aiuti  
{
    public static function reIndirizza($pagina) {
        header("Location: http://demonation.altervista.org/minisiti/allenamento/carico/vedi.php");
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

      public static function dump($variabile, $esci = true) {
        if($esci) {
            echo "<pre style=\"border: 1px solid #000; height: 9em; overflow: auto; margin: 0.5em; padding: 0.5em;\">";
            var_dump($variabile);
            echo "</pre>\n";
            exit;
        } else {
            echo "<pre style=\"border: 1px solid #000; height: 9em; overflow: auto; margin: 0.5em; padding: 0.5em;\">";
            var_dump($variabile);
            echo "</pre>\n";            
        }
      }

}


?>