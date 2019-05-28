<?php

namespace Circli\Extensions\Encryption;

interface FieldEncrypterFactoryInterface
{
    public function getFieldEncrypter(string $fieldClass): FieldEncrypterInterface;
}