<?php

namespace Core\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;

class CompanyId
{
    public function __construct(
        protected string $id_company
    ){}

    public static function generate(): CompanyId
    {
        return new self(Uuid::uuid4()->toString());
    }
}
