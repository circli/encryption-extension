<?php

namespace Circli\Extensions\Encryption;

use ParagonIE\CipherSweet\CipherSweet;

class CipherSweetFieldEncrypterFactory implements FieldEncrypterFactoryInterface
{
    /** @var CipherSweet */
    protected $cipherSweet;

    public function __construct(CipherSweet $cipherSweet)
    {
        $this->cipherSweet = $cipherSweet;
    }

    public function getFieldEncrypter(string $fieldClass): FieldEncrypterInterface
    {
        $field = new $fieldClass($this->cipherSweet);

        return new CipherSweetFieldEncrypter($field);
    }
}