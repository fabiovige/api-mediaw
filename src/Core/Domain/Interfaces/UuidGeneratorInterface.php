<?php
namespace Core\Domain\Interfaces;

interface UuidGeneratorInterface {
    public function generate(): string;
}