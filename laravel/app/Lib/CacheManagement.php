<?php

namespace App\Lib;

use Illuminate\Support\Facades\DB;
use App\Models\CacheToken;
use App\Models\CacheTokenEntity;
use Illuminate\Support\Facades\Cache;

class CacheManagement
{
    
    public static function updateDB($token,$tableNames,$pagination_token = NULL)
    {
        
        DB::transaction(function () use($token,$tableNames,$pagination_token){

            $cacheToken = CacheToken::with(['cacheTokenEntities'])->hasCacheToken($token)->firstOrNew();
            if($cacheToken->exists){
                $cacheToken->cacheTokenEntities()->delete();
            }else{
                $cacheToken->fill([
                    'token' => $token,
                    'pagination_token' => $pagination_token,
                ]);
                $cacheToken->save();
            }

            foreach($tableNames as $tableName){

                $cacheToken->cacheTokenEntities()->create([
                    'entity_table' => $tableName
                ]);                           
            }
        });       
        
    }

    public static function makeCacheToken($cacheToken)
    {
        
        if(empty($cacheToken)){
            throw new \InvalidArgumentException("Parameter is required");
        }
        return md5($cacheToken);
        
    }

    public static function forgetCacheTokenForEntity($entityParameter)
    {
        /* token ids from entities */
        $cacheTokenIds = CacheTokenEntity::hasEntity($entityParameter)->get()->unique('cache_token_id')->pluck('cache_token_id')->toArray();
        
        /* tokens for ids */
        $cacheTokens = CacheToken::whereIn('id',$cacheTokenIds)->get()->pluck('token')->toArray();

        /* not-null pagination tokens for given tokens($cacheTokens)*/
        $paginationTokens = CacheToken::whereNotNull('pagination_token')->whereIn('token',$cacheTokens)->get()->pluck('pagination_token')->toArray();

        /* tokens for a given pagination tokens($paginationTokens) except for already added tokens in $cacheTokens*/
        $cacheTokensWithPagination = CacheToken::whereIn('pagination_token',$paginationTokens)->whereNotIn('id',$cacheTokenIds)->get()->pluck('token')->toArray();
        
        if(count($cacheTokens)){
            foreach($cacheTokens as $cacheToken){
                Cache::forget($cacheToken);
            }
        } 
        if(count($cacheTokensWithPagination)){
            foreach($cacheTokensWithPagination as $cacheToken){
                Cache::forget($cacheToken);
            }
        } 
    }
    
}
