<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CacheTokenEntity extends Model
{

    /**
     * Ime tabele uvek pisati
     */
    protected $table = 'cache_token_entities';

    public $timestamps = false;
    
    /**
     * Mass assignment uvek pisati
     */
    protected $fillable = ['cache_token_id', 'entity_table'];


    //  KOD ZA REALACIJE
    public function cacheToken()
    {
        return $this->belongsTo(CacheToken::class, 'cache_token_id');
    }

    public function scopeHasEntity($query,$entityTable)
    {
        $queryEntity = $query->where('entity_table',$entityTable);
        
        return $queryEntity;
    }
}
