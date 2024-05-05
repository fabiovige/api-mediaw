<?php

namespace Core\Infra\Utils;

use Core\Domain\Interfaces\UuidGeneratorInterface;
use Ramsey\Uuid\Uuid;

class RamseyUuidGenerator implements UuidGeneratorInterface {
    public function generate(): string {
        return Uuid::uuid4()->toString();
    }
}
