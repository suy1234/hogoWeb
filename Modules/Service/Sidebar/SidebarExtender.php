<?php

namespace Modules\Service\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.service'), function (Group $group) {
            $group->weight(2);
            $group->authorize(
                auth()->user()->hasAccess('admin.service.index')
            );
            $group->item(trans('service::sidebar.service'), function (Item $item) {
                $item->weight(2);
                $item->icon('icon-images2');
                $item->route('admin.services.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.services.index')
                );
            });
        });
    }
}
