<?php

class Utilities {
    /*
     * making db conn
     */

    public function getConn() {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'cms';
        $mysql = new mysqli($host, $user, $password, $database);
        return $mysql;
    }
    
    /*
     * execute the given Query
     */
    function executeQuery($query){
        $mysql = $this->getConn();
        if($mysql->query($query)){
            return 1;
        }
        return 0;
    }

    /*
     * select the given Query
     */
    function selectQuery($query){
        $mysql = $this->getConn();
        $rows = [];
        if($result = $mysql->query($query)){
            if($result->num_rows > 0){
                return $result;
            }
        }
        return $rows;
    }

    /*
     * encryption
     */

    public function encrypt($string) {
        // Store the cipher method 
        $ciphering = "AES-256-CTR";

        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121';

        // Store the encryption key 
        $encryption_key = "JagreetiTextiles.com";

        // Use openssl_encrypt() function to encrypt the data 
        $encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption;
    }

    /*
     * decryption of given string
     */

    public function decrypt($string) {

        // Store the cipher method 
        $ciphering = "AES-256-CTR";

        $options = 0;

        // Non-NULL Initialization Vector for decryption 
        $decryption_iv = '1234567891011121';

        // Store the decryption key 
        $decryption_key = "JagreetiTextiles.com";

        // Use openssl_decrypt() function to decrypt the data 
        $decryption = openssl_decrypt($string, $ciphering, $decryption_key, $options, $decryption_iv);

        return $decryption;
    }

}
?>