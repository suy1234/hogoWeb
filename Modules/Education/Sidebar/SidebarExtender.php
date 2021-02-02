<?php

namespace Modules\Education\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\App\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('sidebar.education'), function (Group $group) {
            $group->authorize(
                auth()->user()->hasAccess('admin.subjects.index') || 
                auth()->user()->hasAccess('admin.courses.index')
            );
            $group->item(trans('education::sidebar.class'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-graduation2');
                $item->route('admin.classs.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.classs.index')
                );
            });
            $group->item(trans('education::sidebar.student'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-users4');
                $item->route('admin.students.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.students.index')
                );
            });
            $group->item(trans('education::sidebar.schedule'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-calendar22');
                $item->route('admin.schedules.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.schedules.index')
                );
            });
            $group->item(trans('education::sidebar.checkin'), function (Item $item) {
                $item->weight(1);
                $item->icon('icon-user-check');
                $item->route('admin.checkins.index');
                $item->authorize(
                    auth()->user()->hasAccess('admin.checkins.index')
                );
            });
            $group->item(trans('sidebar.education'), function (Item $item) {
                $item->weight(2);
                $item->item(trans('education::sidebar.subject'), function (Item $item) {
                    $item->weight(1);
                    $item->icon('icon-bookmark');
                    $item->route('admin.subjects.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.subjects.index')
                    );
                });
                $item->item(trans('education::sidebar.course'), function (Item $item) {
                    $item->weight(1);
                    $item->icon('icon-calendar22');
                    $item->route('admin.courses.index');
                    $item->authorize(
                        auth()->user()->hasAccess('admin.courses.index')
                    );
                });
                $item->item(trans('education::sidebar.unit'), function (Item $item) {
                    $item->weight(1);
                    $item->icon('icon-bookmarks');
                    $item->route('admin.units.index', ['code' => 'question']);
                    $item->authorize(
                        auth()->user()->hasAccess('admin.units.index')
                    );
                });
            });
        });
    }
}
