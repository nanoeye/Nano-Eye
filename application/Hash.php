<?php

define('HASH_KEY', '57c1d48ba721a');
class Hash
{
    public static function getHash($data)
    {
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(HASH_KEY), $data, MCRYPT_MODE_CBC, md5(md5(HASH_KEY))));
        return ($qEncoded);
    }

    public static function getReal($data)
    {
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(HASH_KEY), base64_decode($data), MCRYPT_MODE_CBC, md5(md5(HASH_KEY))), "\0");
        return ($qDecoded);
    }

}
