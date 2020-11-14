<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid;
use Qlimix\Id\Uuid\Uuid5;
use Ramsey\Uuid\UuidFactoryInterface;
use Throwable;

final class RamseyUuid5Generator implements Uuid5GeneratorInterface
{
    private UuidFactoryInterface $factory;

    public function __construct(UuidFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(Uuid $namespace, string $name): Uuid5
    {
        try {
            return new Uuid5($this->factory->uuid5($namespace->toString(), $name)->toString());
        } catch (Throwable $exception) {
            throw new UuidGeneratorException('Failed to generate an UUID5', 0, $exception);
        }
    }
}
