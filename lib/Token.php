<?php

class Token {

    protected $token;

    public function __construct($token_value = null) {

        if($token_value) {
            $this->token = $token_value;
            return;
        } else {
            //16 bytes = 128 bits = 32 hex char
            $this->token = bin2hex(random_bytes(16));
        }
    }

    public function getToken() {
        return $this->token;
    }

    public function getHash() {
        //64 Caratteri
        //Chiave salfata in config.php generata da https://randomkeygen.com/ con codifica CodeIgniter Encryption Keys
        return hash_hmac('sha256', $this->token, CHIAVE_SEGRETA);
    }
}