<?php

namespace Circli\Extensions\Encryption;

interface FieldEncrypterAwareInterface
{
    public function setFieldEncrypterFactory(FieldEncrypterFactoryInterface $factory);

    public function getFieldEncrypter(string $fieldClass): FieldEncrypterInterface;
}