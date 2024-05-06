<?php

namespace Core\Infra\Persistence;

use Core\Domain\Interfaces\TransactionalInterface;
use Illuminate\Support\Facades\DB;

class EloquentTransactional implements TransactionalInterface
{
    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function commit()
    {
        DB::commit();
    }

    public function rollback()
    {
        DB::rollBack();
    }
}
