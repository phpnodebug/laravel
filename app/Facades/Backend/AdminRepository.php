<?php

namespace App\Facades\Backend;

use Illuminate\Support\Facades\Facade;

/**
 * This is the menu repository facade class
 */
class AdminRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'adminrepository';
    }
}
