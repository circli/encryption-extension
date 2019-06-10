<?php declare(strict_types=1);

namespace Circli\Extensions\Encryption;

use Circli\Contracts\ExtensionInterface;
use Circli\Contracts\PathContainer;
use Circli\Core\Config;
use ParagonIE\CipherSweet\Backend\ModernCrypto;
use ParagonIE\CipherSweet\CipherSweet;
use ParagonIE\CipherSweet\KeyProvider\StringProvider;
use ParagonIE\Halite\KeyFactory;
use Psr\Container\ContainerInterface;
use function DI\autowire;

final class Extension implements ExtensionInterface
{
    public function __construct(PathContainer $paths)
    {
    }

    public function configure(): array
    {
        return [
            [
                EncrypterInterface::class => static function(ContainerInterface $container) {
                    $config = $container->get(Config::class);
                    $keyFile = $config->get('encryption.key-file');
                    if (file_exists($keyFile)) {
                        $enc_key = KeyFactory::loadEncryptionKey($keyFile);
                    }
                    else {
                        $enc_key = KeyFactory::generateEncryptionKey();
                        KeyFactory::save($enc_key, $keyFile);
                    }

                    $salt = $config->get('encryption.salt');
                    \Circli\Extensions\Encryption\KeyFactory::setAccountSalt($salt);

                    return new HaliteEncrypter($enc_key);
                },
                CipherSweet::class => static function(ContainerInterface $container) {
                    $config = $container->get(Config::class);
                    $key = $config->get('encryption.cipher-sweet-key');
                    $provider = new StringProvider(
                        new ModernCrypto(),
                        $key
                    );

                    return new CipherSweet($provider);
                },
                FieldEncrypterFactoryInterface::class => autowire(CipherSweetFieldEncrypterFactory::class),
            ],
        ];
    }
}
