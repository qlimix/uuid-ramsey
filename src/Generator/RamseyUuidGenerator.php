<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid;
use Ramsey\Uuid\UuidFactoryInterface;
use Throwable;

final class RamseyUuidGenerator implements UuidGeneratorInterface
{
    /** @var UuidFactoryInterface */
    private $factory;

    public function __construct(UuidFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(): Uuid
    {
        try {
            return new Uuid($this->factory->uuid4()->toString());
        } catch (Throwable $exception) {
            throw new UuidGeneratorException('Failed to generate an UUID', 0, $exception);
        }
    }
}
