<?php

namespace Modules\Widget\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.widget'), function (Group $group) {
             $group->item(trans('widget::sidebar.widget'), function (Item $item) {
                $item->weight(20);
                $item->icon('icon-atom2');
                $item->authorize(
                    auth()->user()->hasAccess('admin.widget_themes.index')
                );
                $item->item(trans('widget::sidebar.widget_theme'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.widget_themes.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.widget_themes.index')
                    );
                });
            });            
        });
    }
}
