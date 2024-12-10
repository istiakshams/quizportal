<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ThemeSettings extends Model
{
    protected $guarded  = ['id'];

    /**
     * Add a theme settings value
     *
     * @param $key
     * @param $val
     * @param string $type
     * @return bool
     */
    public static function add($key, $value)
    {
        if( self::has($key) ) {
            return self::set($key, $value);
        }

        $value = empty($value) ? '' : $value;

        return self::create(['name' => $key, 'value' => $value]) ? $value : false;
    }

    /**
     * Get a theme settings value
     *
     * @param $key
     * @param null $default
     * @return bool|int|mixed
     */
    public static function get($key, $default = null)
    {
        if( self::has($key) ) {
            $setting = self::getAllThemeSettings()->where('name', $key)->first();

            return $setting->value;
        }

        return false;
    }

    /**
     * Set a value for theme setting
     *
     * @param $key
     * @param $val
     * @param string $type
     * @return bool
     */
    public static function set($key, $value)
    {        
        if( $setting = self::getAllThemeSettings()->where('name', $key)->first() ) {
            $value = empty($value) ? '' : $value;
            return $setting->update(['name' => $key, 'value' => $value]) ? $value : false;
        }

        return self::add($key, $value);
    }

    /**
     * Remove a theme setting
     *
     * @param $key
     * @return bool
     */
    public static function remove($key)
    {
        if( self::has($key) ) {
            return self::whereName($key)->delete();
        }

        return false;
    }

    /**
     * Get all theme settings
     *
     * @return mixed
     */
    public static function getAllThemeSettings()
    {
        return Cache::rememberForever('themesettings', function() {
          return self::all();
        });
    }


    /**
     * Check if theme setting exists
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return (boolean) self::getAllThemeSettings()->whereStrict('name', $key)->count();
    }


    /**
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('themesettings');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function() {
            self::flushCache();
        });
    }    
}
