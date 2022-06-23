<?php

class Calendario extends DateTime 
{
    protected $anno;
    protected $numeroMese;
    protected $giorniSettimana = [
        'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'
    ];
    protected $settimane = [];

    public function __construct($anno, $mese) {
        $this->anno = $anno;
        $this->numeroMese = $mese;

    }
    
    public function getAnno() {
        return $this->anno;
    }

    public function getNumeroMese() {
        return $this->numeroMese;
    }

    public function getSettimane() {
        return $this->settimane;
    }

    public function getGiorniSettima() {
        return $this->giorniSettimana;
    }

    public function creaCalendario() {

        $date = $this->setDate($this->getAnno, $this->getNumeroMese, 1);
        $giorniNelMese =  $date->format('t');
        $giornoInizioMese = $date->format('N');

        $giorni = array_fill(0, ($giornoInizioMese -1), '');

        for ($i=1; $i < $giorniNelMese; $i++) { 
                $giorni[] = $i;
        }

        $this->settimane = array_chunk($giorni, 7);


    }
}


?>