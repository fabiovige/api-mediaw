<?php

namespace Core\Domain\Interfaces;

interface TransactionalInterface
{
    public function beginTransaction();
    public function commit();
    public function rollback();
}
