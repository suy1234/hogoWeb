<?php
if (! function_exists('groups')) {
    function groups($type)
    {
        return \Modules\Core\Entities\Groups::where('type', $type)->select('title', 'id')->get()->pluck('title', 'id');
    }
}
if (! function_exists('group_types')) {
    function group_types($type)
    {
        return \Modules\Core\Entities\GroupTypes::where('type', $type)->select('title', 'id')->get()->pluck('title', 'id');
    }
}
if (! function_exists('categories')) {
    function categories($type)
    {
        return \Modules\Core\Entities\Category::where('type', $type)->select('title', 'id')->get()->pluck('title', 'id');
    }
}
if (! function_exists('update_setting')) {
    function update_setting($type, $input = [])
    {
        $setting = \Modules\Core\Entities\Setting::where('type', $type)->first();
        if(!empty($setting) && !empty($setting->config)){
        	$input = array_merge($setting->config, $input);
        }
        return \Modules\Core\Entities\Setting::updateOrCreate([
        	'type' => $type
        ],[
        	'type' => $type,
        	'config' => $input
        ]);
    }
}
if (! function_exists('get_setting')) {
    function get_setting($type)
    {
        return \Modules\Core\Entities\Setting::where('type', $type)->first();
    }
}