<?php

namespace Modules\Website\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.web'), function (Group $group) {
            $group->item(trans('website::sidebar.page'), function (Item $item) {
                $item->weight(2);
                $item->icon('icon-pagebreak');
                $item->route('admin.pages.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.pages.index')
                );
            });
            $group->item(trans('website::sidebar.post'), function (Item $item) {
                $item->weight(12);
                $item->icon('icon-certificate');
                $item->authorize(
                    auth()->user()->hasAccess('admin.posts.index')
                );
                $item->item(trans('website::sidebar.post'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.posts.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.posts.index')
                    );
                });

                $item->item(trans('website::sidebar.category'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.categorys.index', ['code' => 'post']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.categorys.index')
                    );
                });

                $item->item(trans('website::sidebar.group'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.groups.index', ['code' => 'post']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.groups.index')
                    );
                });
            });
            
            $group->item(trans('website::sidebar.setting'), function (Item $item) {
                $item->weight(12);
                $item->icon('icon-cog');
                $item->authorize(
                    auth()->user()->hasAccess('admin.menus.index') || 
                    auth()->user()->hasAccess('admin.widgets.index')
                );
                // $item->item(trans('website::sidebar.widget'), function (Item $item) {
                //     $item->weight(1);
                //     $item->icon('icon-atom2');
                //     $item->route('admin.widgets.index');
                //     $item->authorize(
                //         auth()->user()->hasAccess('admin.widgets.index')
                //     );
                // });
                
                $item->item(trans('website::sidebar.layout'), function (Item $item) {
                    $item->weight(1);
                    $item->icon('icon-puzzle2');
                    $item->route('admin.layouts.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.layouts.index')
                    );
                });
                $item->item(trans('website::sidebar.setting_theme'), function (Item $item) {
                    $item->weight(1);
                    $item->icon('icon-design');
                    $item->route('admin.themes.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.themes.index')
                    );
                });
                $item->item(trans('website::sidebar.menu'), function (Item $item) {
                    $item->weight(1);
                    $item->icon('icon-menu2');
                    $item->route('admin.menus.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.menus.index')
                    );
                });
            });
            
        });
    }
}
