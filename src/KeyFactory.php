<?php

namespace Circli\Extensions\Encryption;

use Circli\Extensions\Encryption\Exception\MissingSalt;
use ParagonIE\Halite\HiddenString;
use ParagonIE\Halite\KeyFactory as BaseFactory;
use ParagonIE\Halite\Symmetric\EncryptionKey;

final class KeyFactory
{
    private static $salt;
    
    public static function setAccountSalt(string $salt): void
    {
        self::$salt = $salt;
    }

    public static function deriveEncryptionKeyFromSecret(HiddenString $secret): EncryptionKey
    {
        if (!self::$salt) {
            throw new MissingSalt();
        }

        return BaseFactory::deriveEncryptionKey($secret, self::$salt);
    }
}