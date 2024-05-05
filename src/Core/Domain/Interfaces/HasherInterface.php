<?php

namespace Core\Domain\Interfaces;

interface HasherInterface {
    public function make(string $value): string;
}
