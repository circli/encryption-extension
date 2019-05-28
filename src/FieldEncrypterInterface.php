<?php

namespace Circli\Extensions\Encryption;

interface FieldEncrypterInterface extends EncrypterInterface
{
    public function getBlindIndex(string $input);
}