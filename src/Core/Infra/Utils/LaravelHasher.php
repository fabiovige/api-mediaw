<?php

namespace Core\Infra\Utils;

use Core\Domain\Interfaces\HasherInterface;
use Illuminate\Support\Facades\Hash;

class LaravelHasher implements HasherInterface {
    public function make(string $value): string {
        return Hash::make($value);
    }
}
