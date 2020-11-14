<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Generator;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Generator\RamseyUuid1Generator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuid1GeneratorTest extends TestCase
{
    private MockObject $factory;

    private RamseyUuid1Generator $generator;

    public function setUp(): void
    {
        $this->factory = $this->createMock(UuidFactoryInterface::class);
        $this->generator = new RamseyUuid1Generator($this->factory);
    }

    public function testShouldGenerateUuid(): void
    {
        $generatedUuid = Uuid::uuid1();

        $this->factory->expects($this->once())
            ->method('uuid1')
            ->willReturn($generatedUuid);

        $uuid = $this->generator->generate();

        $this->assertSame($generatedUuid->toString(), $uuid->toString());
    }


    public function testShouldThrowOnFactoryException(): void
    {
        $this->factory->expects($this->once())
            ->method('uuid1')
            ->willThrowException(new Exception());

        $this->expectException(UuidGeneratorException::class);

        $this->generator->generate();
    }
}
