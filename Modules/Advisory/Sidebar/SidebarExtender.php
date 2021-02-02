<?php

namespace Modules\Bank\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.main'), function (Group $group) {
            $group->authorize(
                auth()->user()->hasAccess('admin.interest_rates.index')
            );
            $group->item(trans('advisory::sidebar.advisory'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-bubbles9');
                $item->item(trans('advisory::sidebar.advisory'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.advisorys.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.advisorys.index')
                    );
                });
                // $item->item(trans('bank::sidebar.bank'), function (Item $item) {
                //     $item->weight(1);
                //     $item->route('admin.banks.index');
                //     $item->authorize(
                //         auth()->user()->hasAccess('admin.banks.index')
                //     );
                // });
                
            });
        });
    }
}
