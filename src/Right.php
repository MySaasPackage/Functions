<?php

declare(strict_types=1);

namespace MySaasPackage\Support;

/**
 * @template T
 *
 * @implements Either<T>
 */
class Right implements Either
{
    public function __construct(
        protected readonly mixed $value
    ) {
    }

    /**
     * @return T
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    public function isLeft(): bool
    {
        return false;
    }

    public function isRight(): bool
    {
        return true;
    }
}