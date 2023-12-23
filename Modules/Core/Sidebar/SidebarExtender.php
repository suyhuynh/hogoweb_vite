<?php

namespace Modules\Core\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Core\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
    	$menu->group(trans('sidebar.system'), function (Group $group) {
            $group->weight(8);
            $group->item(trans('core::sidebar.system'), function (Item $item) {
                $item->icon('icon-gear fa-spin');
                $item->item(trans('core::sidebar.general_configuration'), function (Item $item) {
                    $item->route('admin.settings.index', ['general']);
                });
            });
            $group->item(trans('core::sidebar.utilities'), function (Item $item) {
                $item->icon('icon-hammer-wrench');
                $item->item(trans('core::sidebar.admin_app'), function (Item $item) {
                    $item->icon('icon-bucket');
                    $item->route('admin.settings.admin_app');
                });
                $item->item(trans('core::sidebar.package'), function (Item $item) {
                    $item->icon('icon-package');
                    $item->route('admin.settings.package');
                });
                $item->item(trans('core::sidebar.app'), function (Item $item) {
                    $item->icon('icon-puzzle4');
                    $item->route('admin.apps.index');
                });
                
            });
        });
    }
}
