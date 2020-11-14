<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid;
use Qlimix\Id\Uuid\Uuid3;
use Ramsey\Uuid\UuidFactoryInterface;
use Throwable;

final class RamseyUuid3Generator implements Uuid3GeneratorInterface
{
    private UuidFactoryInterface $factory;

    public function __construct(UuidFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(Uuid $namespace, string $name): Uuid3
    {
        try {
            return new Uuid3($this->factory->uuid3($namespace->toString(), $name)->toString());
        } catch (Throwable $exception) {
            throw new UuidGeneratorException('Failed to generate an UUID3', 0, $exception);
        }
    }
}
