<?php

declare(strict_types=1);

namespace MySaasPackage;

/**
 * @template T
 */
class Option
{
    public function __construct(
        protected readonly mixed $value = null
    ) {
    }

    /**
     * @return T
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    public function isSome(): bool
    {
        return null !== $this->value;
    }

    public function isNone(): bool
    {
        return null === $this->value;
    }
}
