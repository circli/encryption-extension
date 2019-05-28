<?php

namespace Circli\Extensions\Encryption;

class NoneEncrypter implements FieldEncrypterInterface
{
    public function getBlindIndex(string $input)
    {
        return md5($input);
    }

    public function encrypt(string $input)
    {
        return $input;
    }

    public function decrypt(string $ciphertext)
    {
        return $ciphertext;
    }
}