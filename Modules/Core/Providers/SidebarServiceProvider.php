<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Sidebar\SidebarManager;
use Modules\Core\Sidebar\AdminSidebar;
use Modules\Core\Http\ViewCreators\AdminSidebarCreator;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(SidebarManager $manager)
    {
        // if ($this->app['inBackend']) {
        //     $manager->register(AdminSidebar::class);
        // }

        View::creator('core::layouts.partials.sidebar', AdminSidebarCreator::class);
    }
}
