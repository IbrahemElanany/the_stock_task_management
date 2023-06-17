<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class TaskFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TaskService';
    }
}
