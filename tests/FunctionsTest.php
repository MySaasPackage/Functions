<?php

declare(strict_types=1);

namespace MySaasPackage;

use stdClass;
use Exception;
use SplFileObject;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

use function MySaasPackage\Functions\left;
use function MySaasPackage\Functions\none;
use function MySaasPackage\Functions\some;
use function MySaasPackage\Functions\right;
use function MySaasPackage\Functions\ensure;

class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {
    }
}

class UserRepository
{
    /**
     * @return Either<Exception, User>
     */
    public function findOneOrError(int $id): Either
    {
        if ($id > 1) {
            return left(new Exception('User not found'));
        }

        return right(new User(1, 'John Doe'));
    }

    /**
     * @return Option<User>
     */
    public function findOneOrNull(int $id): Option
    {
        if ($id > 1) {
            return none();
        }

        return some(new User(1, 'John Doe'));
    }
}

class FunctionsTest extends TestCase
{
    public function testEnsureSuccessfully(): void
    {
        $result = ensure(new stdClass(), stdClass::class);

        $this->assertInstanceOf(stdClass::class, $result);
    }

    public function testEnsureThrownException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ensure(new stdClass(), SplFileObject::class);
    }

    public function testEitherRight(): void
    {
        $userRepository = new UserRepository();

        $result = $userRepository->findOneOrError(1);
        $this->assertTrue($result->isRight());
        $this->assertFalse($result->isLeft());
        /** @var User */
        $value = $result->getValue();
        $this->assertInstanceOf(User::class, $value);
        $this->assertEquals(1, $value->id);
        $this->assertEquals('John Doe', $value->name);
    }

    public function testEitherLeft(): void
    {
        $userRepository = new UserRepository();

        $result = $userRepository->findOneOrError(2);
        $this->assertInstanceOf(Exception::class, $result->getValue());
        $this->assertFalse($result->isRight());
        $this->assertTrue($result->isLeft());
    }
}
