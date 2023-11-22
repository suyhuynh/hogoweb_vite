<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'Modules\Lang\Events\LanguageCreated' => [
            'Modules\Core\Listeners\AddColumnDatabase',
        ],
    ];
}