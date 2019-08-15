<?php

namespace Circli\Extensions\Encryption\Cookie;

use Circli\WebCore\Contracts\CookieInterface;
use Circli\WebCore\Contracts\CookieFactory;
use ParagonIE\Halite\Cookie;

final class EncryptedCookieFactory implements CookieFactory
{
    private $loadedCookies = [];
    /** @var Cookie */
    private $cookie;

    public function __construct(Cookie $cookie)
    {
        $this->cookie = $cookie;
    }

    public function getCookie(string $name): CookieInterface
    {
        if (!isset($this->loadedCookies[$name])) {
            $this->loadedCookies[$name] = new EncryptedCookie($name, $this->cookie);
        }
        return $this->loadedCookies[$name];
    }
}
