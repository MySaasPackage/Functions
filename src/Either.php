<?php

declare(strict_types=1);

namespace MySaasPackage\Support;

/**
 * @template TLeft
 * @template TRight
 */
interface Either
{
    /**
     * @return Either<TLeft, TRight>
     */
    public function getValue();

    public function isLeft(): bool;

    public function isRight(): bool;
}
