<?php

/**
 * Taken from: http://php.net/manual/en/function.crypt.php
 * Make salting and put into db.
 */

function generate_hash($password){
        $salt = substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 22);
        return crypt($password,$salt);
}

/*
* Check the password against a hash generated by the generate_hash
* function.
*/
function validate_pw($password, $hash){
        /* Regenerating the with an available hash as the options parameter should
         * produce the same hash if the same password is passed.
         */
        return crypt($password, $hash)==$hash;
}
?>