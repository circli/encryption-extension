<?php

namespace Circli\Extensions\Encryption;

use ParagonIE\CipherSweet\EncryptedField;

final class CipherSweetFieldEncrypter implements FieldEncrypterInterface
{
    /** @var EncryptedField */
    private $encryptedField;

    public function __construct(EncryptedField $encryptedField)
    {
        $this->encryptedField = $encryptedField;
    }

    public function encrypt(string $input)
    {
        return $this->encryptedField->encryptValue($input);
    }

    public function decrypt(string $ciphertext)
    {
        return $this->encryptedField->decryptValue($ciphertext);
    }

    public function getBlindIndex(string $input)
    {
        $index = $this->encryptedField->getAllBlindIndexes($input);
        return array_values($index)[0]['value'];
    }
}