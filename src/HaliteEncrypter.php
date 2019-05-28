<?php

namespace Circli\Extensions\Encryption;

use ParagonIE\Halite\HiddenString;
use ParagonIE\Halite\Symmetric\Crypto as Symmetric;
use ParagonIE\Halite\Symmetric\EncryptionKey;

final class HaliteEncrypter implements EncrypterInterface
{
    /** @var EncryptionKey */
    private $encryptionKey;

    public function __construct(EncryptionKey $encryptionKey)
    {
        $this->encryptionKey = $encryptionKey;
    }

    public function encrypt(string $input)
    {
        return Symmetric::encrypt(new HiddenString($input), $this->encryptionKey);
    }

    public function decrypt(string $ciphertext)
    {
        return Symmetric::decrypt($ciphertext, $this->encryptionKey)->getString();
    }
}