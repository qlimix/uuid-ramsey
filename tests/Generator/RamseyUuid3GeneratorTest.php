<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Generator;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Generator\RamseyUuid3Generator;
use Qlimix\Id;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuid3GeneratorTest extends TestCase
{
    private MockObject $factory;

    private RamseyUuid3Generator $generator;

    public function setUp(): void
    {
        $this->factory = $this->createMock(UuidFactoryInterface::class);
        $this->generator = new RamseyUuid3Generator($this->factory);
    }

    public function testShouldGenerateUuid(): void
    {
        $namespace = Uuid::uuid4()->toString();
        $name = 'foo';

        $generatedUuid = Uuid::uuid3($namespace, $name);

        $this->factory->expects($this->once())
            ->method('uuid3')
            ->willReturn($generatedUuid);

        $uuid = $this->generator->generate(new Id\Uuid\Uuid($namespace), $name);

        $this->assertSame($generatedUuid->toString(), $uuid->toString());
    }

    public function testShouldThrowOnFactoryException(): void
    {
        $this->factory->expects($this->once())
            ->method('uuid3')
            ->willThrowException(new Exception());

        $this->expectException(UuidGeneratorException::class);

        $this->generator->generate(new Id\Uuid\Uuid(Uuid::uuid4()->toString()), 'foo');
    }
}
