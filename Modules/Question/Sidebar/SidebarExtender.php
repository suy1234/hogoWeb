<?php

namespace Modules\Question\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.question'), function (Group $group) {
            $group->authorize(
                auth()->user()->hasAccess('admin.questions.index')
            );

            $group->item(trans('question::sidebar.question'), function (Item $item) {
                $item->weight(12);
                $item->icon('icon-question4');
                
                $item->item(trans('question::sidebar.question'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.questions.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.questions.index')
                    );
                });

                $item->item(trans('question::sidebar.category'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.categorys.index', ['code' => 'question']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.categorys.index')
                    );
                });

                $item->item(trans('question::sidebar.group'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.groups.index', ['code' => 'question']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.groups.index')
                    );
                });

                $item->item(trans('question::sidebar.exam'), function (Item $item) {
                    $item->weight(1);
                    $item->route('admin.group_types.index', ['code' => 'question']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.group_types.index')
                    );
                });
            });
        });
    }
}
