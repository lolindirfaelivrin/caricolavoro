<?php

class Session  
{
    private bool $sessionAttiva = false;

    //Controlla se una sessione è attiva
    public function attiva(): bool {

        $this->sessionAttiva = session_status() === PHP_SESSION_ACTIVE;

        return $this->sessionAttiva;
    }

    //Attiva una sessione se non lo è
    public function attivaSession(): bool {

        if($this->attiva) {
            return true;
        }

        if(session_status() === PHP_SESSION_ACTIVE) {
            $this->sessionAttiva = true;
            return true;
        }

        session_start();
        $this->sessionAttiva = true;
        return true;
    }

    //Imposta una chiave valore
    /*
    * $prodotto1 = 1;
    * $prodotto2 = 2;
    *
    *
    * set('carrello', [
        $prodotto1 => ['quantita' => 1, 'prezzo' => 123],
        $prodotto2 => ['quantita' => 3, 'prezzo' => 654]
    ]);
    *
    * O anche cose più semplici
    */
    public function aggiungi($chiave, $valore) {
        $_SESSION[$chiave] = $valore;
    }

    //Controlla se una determinata chiave esiste nella sessione
    public function contieneChiave($chiave) {

        return array_key_exsists($chiave, $_SESSION);

    }

    public function ottieniValoreChiave($chiave, $default = null) {

        if($this->contieneChiave($chiave)) {
            return $_SESSION[$chiave];
        }

        return $default;

    }

    public function elimina($chiave) {
        if($this->contieneChiave($chiave)) {
            unset($_SESSION[$chiave]);
        }

    }

    public function svuota() {
        $_SESSION = [];
    }
}


?>