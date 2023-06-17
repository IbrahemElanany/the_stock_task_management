<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class AttachmentFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AttachmentService';
    }
}
