<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Generator;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Generator\RamseyUuid2Generator;
use Qlimix\Id\Uuid\Uuid2\Domain;
use Ramsey\Uuid\Type\Integer;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;

final class RamseyUuid2GeneratorTest extends TestCase
{
    private MockObject $factory;

    private RamseyUuid2Generator$generator;

    public function setUp(): void
    {
        $this->factory = $this->createMock(UuidFactoryInterface::class);
        $this->generator = new RamseyUuid2Generator($this->factory);
    }

    public function testShouldGenerateUuid2(): void
    {
        $domain = Domain::createPerson();
        $identifier = 50;

        $generatedUuid = Uuid::uuid2($domain->toInt(), new Integer($identifier));

        $this->factory->expects($this->once())
            ->method('uuid2')
            ->willReturn($generatedUuid);

        $uuid = $this->generator->generate($domain, $identifier);

        $this->assertSame($generatedUuid->toString(), $uuid->toString());
    }

    public function testShouldThrowOnFactoryException(): void
    {
        $this->factory->expects($this->once())
            ->method('uuid2')
            ->willThrowException(new Exception());

        $this->expectException(UuidGeneratorException::class);

        $this->generator->generate(Domain::createPerson(), 50);
    }
}
