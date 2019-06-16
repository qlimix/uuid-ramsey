<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Generator;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Generator\RamseyUuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuidGeneratorTest extends TestCase
{
    /** @var MockObject */
    private $factory;

    /** @var RamseyUuidGenerator */
    private $generator;

    public function setUp(): void
    {
        $this->factory = $this->createMock(UuidFactoryInterface::class);
        $this->generator = new RamseyUuidGenerator($this->factory);
    }

    /**
     * @test
     */
    public function shouldGenerateUuid(): void
    {
        $generatedUuid = Uuid::uuid4();

        $this->factory->expects($this->once())
            ->method('uuid4')
            ->willReturn($generatedUuid);

        $uuid = $this->generator->generate();

        $this->assertSame($generatedUuid->toString(), $uuid->toString());
    }

    /**
     * @test
     */
    public function shouldThrowOnFactoryException(): void
    {
        $this->factory->expects($this->once())
            ->method('uuid4')
            ->willThrowException(new Exception());

        $this->expectException(UuidGeneratorException::class);

        $this->generator->generate();
    }
}
