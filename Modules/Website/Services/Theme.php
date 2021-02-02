<?php

namespace Modules\Website\Services;
use Illuminate\Support\Facades\File;
use Modules\Core\Entities\Setting;
use Modules\Website\Entities\Theme as EntityTheme;

class Theme
{
	public static function buildTheme($content, $folder, $file_name)
	{
		$theme = EntityTheme::where('status', 1)->select('id')->first();
		$config = Setting::where('type', 'activation_date')->first();
		$folder_config = 'kh/'.$config->config['folder'].'/'.$theme->id;
		$dir = public_path($folder_config).'/'.$folder;
        self::createFolder($dir);
        return file_put_contents($dir.'/'.$file_name, $content);
	}

	private static function createFolder($dir)
	{
		if( is_dir($dir) === false )
		{
			return File::makeDirectory($dir, 0777, true, true);
		}
		return false;
	}

	public static function readFile($folder = 'css')
	{
		$theme = EntityTheme::where('status', 1)->select('id')->first();
		$config = Setting::where('type', 'activation_date')->first();
		$folder_config = 'kh/'.$config->config['folder'].'/'.$theme->id;
		$filename = public_path($folder_config).'/css/style.css';
		if(is_dir($filename)){
			return File::get($filename);
		}
		return false;
	}
}