<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class CollaborationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CollaborationService';
    }
}
