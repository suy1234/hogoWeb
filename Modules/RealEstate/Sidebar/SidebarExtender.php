<?php

namespace Modules\RealEstate\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.real_estate'), function (Group $group) {
            $group->weight(1);
            $group->authorize(
                // auth()->user()->hasAccess('admin.products.index')
            );
            
            
        });
    }
}
