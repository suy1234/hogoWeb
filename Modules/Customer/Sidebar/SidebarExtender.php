<?php

namespace Modules\Customer\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.main'), function (Group $group) {
            $group->weight(1);
            $group->authorize(
                auth()->user()->hasAccess('admin.customers.index')
            );
            $group->item(trans('customer::sidebar.customer'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-users4');
                $item->route('admin.customers.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.customers.index')
                );
            });
        });
    }
}
