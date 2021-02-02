<?php

namespace Modules\Core\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
    	$menu->group(trans('sidebar.help'), function (Group $group) {
            $group->weight(2);
            $group->item(trans('core::sidebar.admin_app'), function (Item $item) {
                $item->weight(3);
                $item->icon('icon-bucket');
                $item->route('admin.settings.admin_app');
            });
            $group->item(trans('core::sidebar.package'), function (Item $item) {
                $item->weight(3);
                $item->icon('icon-puzzle4');
                $item->route('admin.settings.package');
            });
        });
    }
}
