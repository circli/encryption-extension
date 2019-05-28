<?php

namespace Circli\Extensions\Encryption;

use Circli\Extensions\Encryption\Exception\MissingSalt;
use ParagonIE\Halite\HiddenString;
use ParagonIE\Halite\KeyFactory as BaseFactory;
use ParagonIE\Halite\Symmetric\EncryptionKey;

class KeyFactory
{
    private static $salt;
    
    public static function setAccountSalt(string $salt)
    {
        self::$salt = $salt;
    }

    public static function deriveEncryptionKeyFromSecret(HiddenString $secret): EncryptionKey
    {
        if (!self::$salt) {
            $q = new MissingSalt();
            echo '<pre>';
            echo json_encode($q->getTrace(), JSON_PRETTY_PRINT);
            exit;
            throw $q;
        }

        return BaseFactory::deriveEncryptionKey($secret, self::$salt);
    }
}