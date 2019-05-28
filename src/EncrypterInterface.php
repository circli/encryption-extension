<?php

namespace Circli\Extensions\Encryption;

interface EncrypterInterface
{
    public function encrypt(string $input);
    public function decrypt(string $ciphertext);
}
