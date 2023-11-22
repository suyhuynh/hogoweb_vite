<?php

namespace Modules\User\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.help'), function (Group $group) {
            $group->weight(7);
            $group->authorize(
                auth()->user()->hasAccess('admin.users.index') 
                || auth()->user()->hasAccess('admin.positions.index')
                || auth()->user()->hasAccess('admin.departments.index')
                || auth()->user()->hasAccess('admin.roles.index')
            );
            $group->item(trans('user::sidebar.user_role'), function (Item $item) {
                $item->icon('icon-users');
                $item->item(trans('user::sidebar.user'), function (Item $item) {
                    $item->route('admin.users.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.users.index')
                    );
                });

                $item->item(trans('user::sidebar.position'), function (Item $item) {
                    $item->route('admin.positions.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.positions.index')
                    );
                });

                $item->item(trans('user::sidebar.department'), function (Item $item) {
                    $item->route('admin.departments.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.departments.index')
                    );
                });

                $item->item(trans('user::sidebar.role'), function (Item $item) {
                    $item->route('admin.roles.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.roles.index')
                    );
                });

                // $item->item(trans('user::sidebar.timekeeper'), function (Item $item) {
                //     $item->route('admin.users.index');
                //     $item->authorize(
                //         auth()->user()->hasAccess('admin.users.index')
                //     );
                // });

            });
        });
    }
}
