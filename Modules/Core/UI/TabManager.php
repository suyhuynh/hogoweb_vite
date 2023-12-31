<?php

namespace Modules\Core\Ui\Facades;

use Illuminate\Support\Facades\Facade;

class TabManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Modules\Core\Ui\TabManager::class;
    }
}
