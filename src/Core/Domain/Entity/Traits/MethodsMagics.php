<?php

namespace Core\Domain\Entity\Traits;

use Exception;

trait MethodsMagics
{
    public function __get($property)
    {
        if(isset($this->property))
            return $this->{$property};


        $className = get_class($this);
        throw new Exception("Propriedade {$property} não encontrado na classe {$className}!");
    }
}