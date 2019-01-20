<?php declare(strict_types=1);

namespace Qlimix\Id\UUID\Generator;

use Qlimix\Id\UUID\RamseyUUID;
use Qlimix\Id\UUID\UUID;

final class RamseyUUIDGenerator implements UUIDGeneratorInterface
{
    public function generate(): UUID
    {
        return new RamseyUUID(\Ramsey\Uuid\Uuid::uuid4());
    }
}
