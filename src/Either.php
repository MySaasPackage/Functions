<?php

declare(strict_types=1);

namespace MySaasPackage\Support;

interface Either
{
    public function getValue();

    public function isLeft(): bool;

    public function isRight(): bool;
}
