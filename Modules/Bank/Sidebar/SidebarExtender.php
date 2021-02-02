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
                auth()->user()->hasAccess('admin.interest_rates.index') || auth()->user()->hasAccess('admin.banks.index')
            );
            $group->item(trans('bank::sidebar.bank'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-library2');
                $item->item(trans('bank::sidebar.interest_rate'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.interest_rates.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.interest_rates.index')
                    );
                });
                $item->item(trans('bank::sidebar.bank'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.banks.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.banks.index')
                    );
                });
                $item->item(trans('bank::sidebar.category'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.categorys.index', ['code' => 'bank']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.categorys.index')
                    );
                });

                $item->item(trans('bank::sidebar.group'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.groups.index', ['code' => 'bank']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.groups.index')
                    );
                });
            });
        });
    }
}
