<?php

declare(strict_types=1);

namespace MySaasPackage\Support;

/**
 * @template T
 *
 * @implements Either<T>
 */
class Left implements Either
{
    public function __construct(
        protected readonly mixed $value
    ) {
    }

    /**
     * @return T
     */
    public function getValue()
    {
        return $this->value;
    }

    public function isLeft(): bool
    {
        return true;
    }

    public function isRight(): bool
    {
        return false;
    }
}
