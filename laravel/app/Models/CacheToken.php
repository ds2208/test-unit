<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CacheToken extends Model
{
    /**
     * Ime tabele uvek pisati
     */
    protected $table = 'cache_tokens';

    public $timestamps = false;

    /**
     * Mass assignment uvek pisati
     */
    protected $fillable = ['token','pagination_token'];

    //  KOD ZA REALACIJE
    public function cacheTokenEntities()
    {
        return $this->hasMany(CacheTokenEntity::class, 'cache_token_id','id');
    }

    public function scopeHasCacheToken($query,$token)
    {
        return $query->where('token','LIKE',$token);
    }

}
