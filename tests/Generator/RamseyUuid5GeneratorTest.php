<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Generator;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Id;
use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Generator\RamseyUuid5Generator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuid5GeneratorTest extends TestCase
{
    private MockObject $factory;

    private RamseyUuid5Generator $generator;

    public function setUp(): void
    {
        $this->factory = $this->createMock(UuidFactoryInterface::class);
        $this->generator = new RamseyUuid5Generator($this->factory);
    }

    public function testShouldGenerateUuid(): void
    {
        $namespace = Uuid::uuid4()->toString();
        $generatedUuid = Uuid::uuid5($namespace, 'foo');

        $this->factory->expects($this->once())
            ->method('uuid5')
            ->willReturn($generatedUuid);

        $uuid = $this->generator->generate(new Id\Uuid\Uuid($namespace), 'foo');

        $this->assertSame($generatedUuid->toString(), $uuid->toString());
    }

    public function testShouldThrowOnFactoryException(): void
    {
        $this->factory->expects($this->once())
            ->method('uuid5')
            ->willThrowException(new Exception());

        $this->expectException(UuidGeneratorException::class);

        $this->generator->generate(new Id\Uuid\Uuid(Uuid::uuid4()->toString()), 'foo');
    }
}
