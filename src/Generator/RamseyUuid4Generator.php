<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid4;
use Ramsey\Uuid\UuidFactoryInterface;
use Throwable;

final class RamseyUuid4Generator implements Uuid4GeneratorInterface
{
    private UuidFactoryInterface $factory;

    public function __construct(UuidFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(): Uuid4
    {
        try {
            return new Uuid4($this->factory->uuid4()->toString());
        } catch (Throwable $exception) {
            throw new UuidGeneratorException('Failed to generate an UUID4', 0, $exception);
        }
    }
}
