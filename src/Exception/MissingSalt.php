<?php

namespace Circli\Extensions\Encryption\Exception;

use Throwable;

final class MissingSalt extends \InvalidArgumentException implements EncryptionExtensionException
{
    public function __construct(string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'You need to set a global salt value', $code, $previous);
    }
}