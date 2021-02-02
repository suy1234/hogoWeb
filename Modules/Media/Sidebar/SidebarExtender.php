<?php

namespace Modules\media\Sidebar;

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
            $group->authorize(
                auth()->user()->hasAccess('admin.medias.index')
            );
            $group->item(trans('media::sidebar.media'), function (Item $item) {
                $item->weight(2);
                $item->icon('icon-images2');
                $item->route('admin.medias.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.medias.index')
                );
            });
        });
    }
}
