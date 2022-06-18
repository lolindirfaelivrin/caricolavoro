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
}


?>