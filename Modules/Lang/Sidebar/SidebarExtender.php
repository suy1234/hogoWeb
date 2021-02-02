<?php

namespace Modules\Lang\Sidebar;

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
            $group->item(trans('lang::sidebar.lang'), function (Item $item) {
                $item->weight(1);
                $item->icon('fa fa-language');
                $item->route('admin.langs.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.langs.index')
                );
            });
        });
    }
}
