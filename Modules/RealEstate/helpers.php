<?php
if (! function_exists('brands')) {
    function brands()
    {
        return \Modules\Product\Entities\Brand::select('title', 'id')->get()->pluck('title', 'id');
    }
}