<?php
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\ThemeSettings;
use App\Models\SystemSettings;
use App\Models\User;
use App\Models\MediaManager;
use App\Models\Localization;
use App\Models\GeneralSetupLocalization;
use App\Models\Advertisement;


if( !function_exists('getThemeSetting') ) {
    function getThemeSetting( $key, $default = null )
    {        
        if (is_null($key)) {
            return new ThemeSettings();
        }

        $value = ThemeSettings::get($key);

        return is_null($value) ? $default : $value;
    }
}

if( !function_exists('getThemePath') )
{
    function getThemePath()
    {        
        $value = ThemeSettings::get('theme_name');

        return is_null($value) ? 'frontend.default-theme' : 'frontend.' . $value;
    }
}

if( !function_exists('getThemeName') )
{
    function getThemeName()
    {        
        $value = ThemeSettings::get('theme_name');
        return is_null($value) ? 'default-theme' : $value;
    }
}

if( !function_exists('getHeaderLogo') )
{
    function getHeaderLogo( $type = 'dark' )
    {
        if( $type == 'light') {
            $value = ThemeSettings::get('site_logo_light');
        }
        else {
            $value = ThemeSettings::get('site_logo_dark');
        }

        return env('APP_URL') . uploadedAsset($value);
    }
}

if( !function_exists('getFeaturedImage') )
{
    function getFeaturedImage( $mediaId = null )
    {
        if( $mediaId != null ) {
            return env('APP_URL') . uploadedAsset($mediaId);
        }            
        
        return env('APP_URL') . '/images/default-featured.jpg';
    }
}

if( !function_exists('getImage') )
{
    function getImage( $mediaId = null )
    {
        if( $mediaId != null ) {
            return env('APP_URL') . uploadedAsset($mediaId);
        }            
        
        return env('APP_URL') . '/images/default.jpg';
    }
}


if (!function_exists('getBlogCategories')) {
    function getBlogCategories($data)
    {
        $data = str_replace( array('[',']'), '', $data->pluck('name'));
        $data = str_replace( array('",'), ', ', $data);
        $data = str_replace( array('"'), '', $data);
        return $data;
    }
}


if (!function_exists('showAdvertise')) {
    function showAdvertise($id)
    {
        $advertisement = Advertisement::findOrFail($id);        
        return $advertisement->content;
    }
}


