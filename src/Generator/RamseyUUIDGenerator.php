<?php declare(strict_types=1);

namespace Qlimix\Id\UUID\Generator;

use Qlimix\Id\UUID\Generator\Exception\UUIDGeneratorException;
use Qlimix\Id\UUID\UUID;
use Ramsey\Uuid\UuidFactory;
use Throwable;

final class RamseyUUIDGenerator implements UUIDGeneratorInterface
{
    /** @var UuidFactory */
    private $factory;

    public function __construct(UuidFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritdoc
     */
    public function generate(): UUID
    {
        try {
            return new UUID($this->factory->uuid4()->toString());
        } catch (Throwable $exception) {
            throw new UUIDGeneratorException('Failed to generate an UUID', 0, $exception);
        }
    }
}
