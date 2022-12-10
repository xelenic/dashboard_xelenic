<?php

use Carbon\Carbon;
use App\Models\Models\Settings;
use App\Models\Models\Upload;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Laravel Boilerplate');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     * @return Carbon
     *
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            }

            if (auth()->user()->isUser()) {
                return 'frontend.user.dashboard';
            }
        }

        return 'frontend.index';
    }
}





if (! function_exists('default_theme_view_path')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function default_theme_view_path($viewpath)
    {
        if(getSetting('default_theme')){
            $module = Module::find(getSetting('default_theme'));
            if($module){
                return  strtolower(getSetting('default_theme').'::'.$viewpath);
            }else{
                return strtolower($viewpath);
            }

        }else{
            return strtolower($viewpath);
        }
    }
}



if (! function_exists('my_asset')) {
    /*
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        return app('url')->asset(''.$path, $secure);
    }
}

if (!function_exists('uploaded_asset')) {

    /*
     * @param $id
     * @author: Sanjaya Senevirathne
     * @description:
     * @return string
     */
    function uploaded_asset($id)
    {
        if (($asset = Upload::find($id)) != null) {
            return my_asset($asset->file_name);
        }
        return url('/').'/img/no-image.jpg';
    }
}
