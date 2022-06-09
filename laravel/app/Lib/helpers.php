<?php

/*
|--------------------------------------------------------------------------
| Helper Funstions - Standard
|--------------------------------------------------------------------------
|   Helper functions may be added to this file if they solve a unique problem,
|   and are used multiple times in the application codebase.
|   The problem that they solve must be simple enough, so that it doesn't
|   require assistance from other classes or traits.
|   This file is autoloaded via composer, under the files key.
|
|   Rules:
|       #1 if (!function_exists('method_name')) is a must
|       #2 documentation is a must
|       #3 no repeating functions are allowed, if a function solves a
|           problem the same way & returns a value the same as another function
|           it is considered a duplicate
|
|   Existing Functions:
|       
|       slug_case
|       array_to_string
|       
|       make_cache_token
|       make_filter_cache_token
|       make_pagination_cache_token
|
|       available_colors
*/

use Illuminate\Support\Str;
use App\Lib\CacheManagement;
use App\Lib\CachedEntities;

if (!function_exists('slug_case')) {
    /**
     * Convert a string to slug case.
     *
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    function slug_case($value, $delimiter = '-')
    {
        return Str::slug($value, $delimiter);
    }
}

if (!function_exists('array_to_string')) {
    /**
     * Function return a slug case format from a given array
     * @param  array  $arr A multidimensional array whose keys are entity table names and page
     * and whose values ​​represent the array of entity ids and page number
     * @param  boolean $no_pagination If the value is false there is no page key.
     * @return string
     */
    function array_to_string($arr, $no_pagination = false)
    {
        $arrForStr = [];

        if (empty($arr) || !is_array($arr)) {
            throw new \Exception('Data for cache token is required and must be array!');
        }
        foreach ($arr as $key => $item) {
            if ($no_pagination && $key == 'page') {
                continue;
            }
            if (is_string($key)) {
                $arrForStr[] = $key;
            }
            if (is_array($item)) {
                $arrForStr[] = array_to_string($item, $no_pagination);
            } else {
                $arrForStr[] = $item;
            }
        }
        return implode('_', $arrForStr);
    }
}

if (!function_exists('make_cache_token')) {
    /**
     * Function return a generete token on md5 format
     * @param  string  $param Token name
     * @return string
     */
    function make_cache_token($param)
    {
        return CacheManagement::makeCacheToken($param);
    }
}

if (!function_exists('make_filter_cache_token')) {
    /**
     * Function return a generete token on md5 format
     * @param  array  $dataForCacheToken A multidimensional array whose keys are entity table names
     * and whose values ​​represent the array of entity ids
     * @return string
     */
    function make_filter_cache_token($dataForCacheToken)
    {
        return CacheManagement::makeCacheToken('filter_' . array_to_string($dataForCacheToken));
    }
}

if (!function_exists('make_pagination_cache_token')) {
    /**
     * Function return a generete token on md5 format
     * @param  array  $dataForCacheToken A multidimensional array whose keys are entity table names and page
     * and whose values ​​represent the array of entity ids and page number
     * @return string
     */
    function make_pagination_cache_token($dataForCacheToken)
    {
        return CacheManagement::makeCacheToken('filter_' . array_to_string($dataForCacheToken, true));
    }
}

if (!function_exists('available_colors')) {
    /**
     * Function return a collection of all active sliders
     * @return object
     */
    function available_colors()
    {
        return CachedEntities::aColors();
    }
}