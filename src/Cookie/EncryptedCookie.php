<?php

namespace Circli\Extensions\Encryption\Cookie;

use Circli\WebCore\Contracts\CookieInterface;
use ParagonIE\Halite\Cookie;

final class EncryptedCookie implements CookieInterface
{
    /** @var string */
    private $name;
    /** @var mixed */
    private $value;
    /** @var int */
    private $expire = 0;
    /** @var Cookie */
    private $cookie;

    public function __construct(string $name, Cookie $cookie)
    {
        $this->name = $name;
        $this->cookie = $cookie;
    }

    public function setName(string $name): CookieInterface
    {
        $this->name = $name;
        return $this;
    }

    public function setValue($value): CookieInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param \DateTimeInterface|\DateInterval|int $expire
     * @return EncryptedCookie
     */
    public function setExpire($expire): CookieInterface
    {
        if ($expire instanceof \DateTimeInterface) {
            $expire = $expire->getTimestamp();
        }
        elseif ($expire instanceof \DateInterval) {
            $expire = (new \DateTime())->add($expire)->getTimestamp();
        }

        if (!is_int($expire)) {
            throw new \InvalidArgumentException('Invalid value for expire. $expire must be of type "int"');
        }

        $this->expire = $expire;
        return $this;
    }

    public function delete(): bool
    {
        return $this->cookie->store($this->name, '', time() - 3600);
    }

    public function save(): bool
    {
        return $this->cookie->store($this->name, $this->value, $this->expire);
    }

    public function exits(): bool
    {
        return isset($_COOKIE[$this->name]);
    }

    public function getValue(): string
    {
        return $this->cookie->fetch($this->name);
    }
}