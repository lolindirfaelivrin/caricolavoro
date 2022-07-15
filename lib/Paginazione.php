<?php

class Paginazione
{
    private $conenssione;
    private $per_pagina;
    private $pagina;
    private $query;
    private $totale_righe;

    public function __construct($connessione, $query) {
        $this->conenssione = $connessione;
        $this->query = $query;

        $stm = $this->conenssione->query($this->query);
        $this->totale_righe = $stm->rowCount();
    }

    public function getDati($per_pagina = 10, $pagina = 1) {
        $this->per_pagina = $per_pagina;
        $this->pagina = $pagina;

        if($this->per_pagina == "all") {
            $query = $this->quuery;
        } else {
            $query = $this->query . " LIMIT " . (($this->pagina - 1) * $this->per_pagina) . ", $this->per_pagina";
        }

        $stm = $this->conenssione->query($query);

        while ( $row = $rs->fetch_assoc() ) {
            $results[]  = $row;
        }
     
        $result         = new stdClass();
        $result->pagina   = $this->pagina;
        $result->per_pagina  = $this->per_pagina;
        $result->totale_righe  = $this->totale_righe;
        $result->data   = $results;
     
        return $result;

    }

    public function creaLink($collegamenti_per_pagina, $stile_css) {
        if ( $this->per_pagina == 'all' ) {
            return '';
        }
     
        $last       = ceil( $this->totale_righe / $this->per_pagina );
     
        $start      = ( ( $this->per_pagina - $collegamenti_per_pagina ) > 0 ) ? $this->per_pagina - $collegamenti_per_pagina : 1;
        $end        = ( ( $this->per_pagina + $collegamenti_per_pagina ) < $last ) ? $this->per_pagina + $collegamenti_per_pagina : $last;
     
        $html       = '';
     
        $class      = ( $this->per_pagina == 1 ) ? "disabled" : "";
        $html       .= '<a href="?limit=' . $this->per_pagina . '&page=' . ( $this->pagina - 1 ) . '">&laquo;</a>';
     
        if ( $start > 1 ) {
            $html   .= '<a href="?limit=' . $this->per_pagina . '&page=1">1</a>';
            $html   .= '<a class="disabled"><span>...</span></a>';
        }
     
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class  = ( $this->per_pagina == $i ) ? "active" : "";
            $html   .= '<a href="?limit=' . $this->per_pagina . '&page=' . $i . '">' . $i . '</a>';
        }
     
        if ( $end < $last ) {
            $html   .= '<a class="disabled"><span>...</span></a>';
            $html   .= '<a href="?limit=' . $this->per_pagina . '&page=' . $last . '">' . $last . '</a></li>';
        }
     
        $class      = ( $this->pagina == $last ) ? "disabled" : "";
        $html       .= '<a href="?limit=' . $this->per_pagina . '&page=' . ( $this->pagina + 1 ) . '">&raquo;</a>';
     
        return $html;
    }
}

/**
* 
*   require_once 'Paginator.class.php';
*
*   $connessione       = new mysqli( '127.0.0.1', 'root', 'root', 'world' );
*
*   $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
*   $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
*   $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
*   $query      = "SELECT City.Name, City.CountryCode, Country.Code, Country.Name AS Country, Country.Continent, Country.Region FROM City, Country WHERE City.CountryCode = Country.Code";
*
*   $Paginazione  = new Paginazione( $connessione, $query );
*
*   $results    = $Paginazione->getDati( $page, $limit );
*
*   MOSTRO I DATI
*
*   <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
*        <tr>
*                <td><?php echo $results->data[$i]['Name']; ?></td>
*                <td><?php echo $results->data[$i]['Country']; ?></td>
*                <td><?php echo $results->data[$i]['Continent']; ?></td>
*                <td><?php echo $results->data[$i]['Region']; ?></td>
*        </tr>
*   <?php endfor; ?>
*
*   <?php echo $Paginazione->creaLink( $links, 'pagination pagination-sm' ); ?> 
* 
*/

?>
