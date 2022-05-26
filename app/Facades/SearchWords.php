<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getUniqueStemWords(string $string):array
 */
class SearchWords extends Facade
{

    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'searchWord';
    }
}
