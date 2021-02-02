<?php

namespace Modules\Product\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.product'), function (Group $group) {
            $group->weight(1);
            $group->authorize(
                auth()->user()->hasAccess('admin.products.index')
            );
            $group->item(trans('product::sidebar.product'), function (Item $item) {
                $item->icon('icon-price-tags2');
                $item->item(trans('product::products.product'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.products.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.products.index')
                    );
                });

                $item->item(trans('product::sidebar.category'), function (Item $item) {
                    $item->weight(2);
                    $item->route('admin.categorys.index', ['code' => 'product']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.categorys.index')
                    );
                });

                $item->item(trans('product::sidebar.group'), function (Item $item) {
                    $item->weight(3);
                    $item->route('admin.groups.index', ['code' => 'product']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.groups.index')
                    );
                });

                $item->item(trans('product::sidebar.brand'), function (Item $item) {
                    $item->weight(4);
                    $item->route('admin.brands.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.brands.index')
                    );
                });

                $item->item(trans('product::sidebar.attribute'), function (Item $item) {
                    $item->weight(4);
                    $item->route('admin.attributes.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.attributes.index')
                    );
                });
                $item->item(trans('product::sidebar.unit'), function (Item $item) {
                    $item->weight(4);
                    $item->route('admin.units.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.units.index')
                    );
                });
            });
            
        });
    }
}
