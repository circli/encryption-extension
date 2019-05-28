<?php

namespace Circli\Extensions\Encryption\Cookie;

use Circli\Extension\WebCore\Contracts\CookieFactory;
use Circli\Extension\WebCore\Contracts\CookieInterface;

class EncryptedCookieFactory implements CookieFactory
{
    public function getCookie(string $name): CookieInterface
    {
        // TODO: Implement getCookie() method.
    }
}