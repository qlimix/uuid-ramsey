<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid1;
use Ramsey\Uuid\UuidFactoryInterface;
use Throwable;

final class RamseyUuid1Generator implements Uuid1GeneratorInterface
{
    private UuidFactoryInterface $factory;

    public function __construct(UuidFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(): Uuid1
    {
        try {
            return new Uuid1($this->factory->uuid1()->toString());
        } catch (Throwable $exception) {
            throw new UuidGeneratorException('Failed to generate an UUID1', 0, $exception);
        }
    }
}
