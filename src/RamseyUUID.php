<?php declare(strict_types=1);

namespace Qlimix\Id\UUID;

use Ramsey\Uuid\UuidInterface;

final class RamseyUUID implements UUID
{
    /** @var UuidInterface */
    private $uuid;

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public function equals(UUID $uuid): bool
    {
        return $this->uuid->toString() === $uuid->toString();
    }

    public function getBytes(): string
    {
        return $this->uuid->getBytes();
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}
