<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Generator;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Generator\RamseyUuid4Generator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuid4GeneratorTest extends TestCase
{
    private MockObject $factory;

    private RamseyUuid4Generator $generator;

    public function setUp(): void
    {
        $this->factory = $this->createMock(UuidFactoryInterface::class);
        $this->generator = new RamseyUuid4Generator($this->factory);
    }

    public function testShouldGenerateUuid(): void
    {
        $generatedUuid = Uuid::uuid4();

        $this->factory->expects($this->once())
            ->method('uuid4')
            ->willReturn($generatedUuid);

        $uuid = $this->generator->generate();

        $this->assertSame($generatedUuid->toString(), $uuid->toString());
    }

    public function testShouldThrowOnFactoryException(): void
    {
        $this->factory->expects($this->once())
            ->method('uuid4')
            ->willThrowException(new Exception());

        $this->expectException(UuidGeneratorException::class);

        $this->generator->generate();
    }
}
