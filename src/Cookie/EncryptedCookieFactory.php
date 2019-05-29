<?php

namespace Circli\Extensions\Encryption\Cookie;

use Circli\WebCore\Contracts\CookieInterface;
use Circli\WebCore\Contracts\CookieFactory;

final class EncryptedCookieFactory implements CookieFactory
{
    public function getCookie(string $name): CookieInterface
    {
        // TODO: Implement getCookie() method.
    }
}