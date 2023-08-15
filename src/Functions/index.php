<?php

declare(strict_types=1);

namespace MySaasPackage\Functions;

use Throwable;
use InvalidArgumentException;
use MySaasPackage\Left;
use MySaasPackage\Right;
use MySaasPackage\Option;

/**
 * @template T
 *
 * @param class-string<T> $className
 *
 * @return T
 */
function ensure(object $object, string $className): object
{
    if ($object instanceof $className) {
        return $object;
    }

    throw new InvalidArgumentException(sprintf('Expected instance of %s, got %s', $className, get_class($object)));
}

function catchable(callable $callable, mixed ...$args): mixed
{
    try {
        return $callable(...$args);
    } catch (Throwable $e) {
        return $e;
    }
}

function none(): Option
{
    return new Option();
}

function some(mixed $value): Option
{
    return new Option($value);
}

function left(mixed $value): Left
{
    return new Left($value);
}

function right(mixed $value): Right
{
    return new Right($value);
}
