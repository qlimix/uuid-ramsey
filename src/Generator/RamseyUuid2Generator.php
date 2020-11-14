<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid2;
use Ramsey\Uuid\Type\Integer;
use Ramsey\Uuid\UuidFactoryInterface;
use Throwable;

final class RamseyUuid2Generator implements Uuid2GeneratorInterface
{
    private UuidFactoryInterface $factory;

    public function __construct(UuidFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(Uuid2\Domain $domain, int $identifier): Uuid2
    {
        try {
            return new Uuid2($this->factory->uuid2($domain->toInt(), new Integer($identifier))->toString());
        } catch (Throwable $exception) {
            throw new UuidGeneratorException('Failed to generate an UUID2', 0, $exception);
        }
    }
}
