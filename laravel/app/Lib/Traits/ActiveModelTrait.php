<?php

namespace App\Lib\Traits;


trait ActiveModelTrait
{

    /**
     * Function returns if object is active or not.
     * 
     * @return bool
     */
    public function isActive()
    {
        return $this->status ? true : false;
    }

    /**
     * Function returns if object is not active or yes.
     * 
     * @return bool
     */
    public function isInactive()
    {
        return $this->status ? false : true;
    }

    /**
     * Scope for active entities.
     * 
     * @return query
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope for inactive entities.
     * 
     * @return query
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
    
    /**
     * Function change entity status.
     * 
     * @return entity
     */
    public function changeStatus()
    {
        $this->update([
            'status' => !$this->status,
        ]);
        return $this;
    }
}