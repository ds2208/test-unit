<?php

namespace App\Lib\Traits;


trait ActiveModelTrait
{
    public function isActive()
    {
        return $this->active ? true : false;
    }

    public function isInactive()
    {
        return $this->active ? false : true;
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('active', 0);
    }
    
}