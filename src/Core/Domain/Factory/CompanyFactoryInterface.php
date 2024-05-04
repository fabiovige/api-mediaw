<?php

namespace Core\Domain\Factory;

use Core\Domain\Entity\Company;

interface CompanyFactoryInterface
{
    public function create(string $name, string $cnpj): Company;
}
