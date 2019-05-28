<?php

namespace Circli\Extensions\Encryption;

trait FieldEncrypterAwareTrait
{
    /** @var FieldEncrypterFactoryInterface */
    private $fieldFactory;

    public function setFieldEncrypterFactory(FieldEncrypterFactoryInterface $factory)
    {
        $this->fieldFactory = $factory;
    }

    public function getFieldEncrypter(string $fieldClass): FieldEncrypterInterface
    {
        if (!$this->fieldFactory) {
            return new NoneEncrypter();
        }

        return $this->fieldFactory->getFieldEncrypter($fieldClass);
    }
}
