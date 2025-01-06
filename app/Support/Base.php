<?php

namespace App\Support;

use Setting;
use Storage;

/**
 * Class Base
 * @package App\Support
 */
class Base
{
    /**
     * @return string|string[]
     */
    public static function locale()
    {
        return str_replace('_', '-', Setting::get('app_locale', app()->getLocale()));
    }

    /**
     * @return string
     */
    public static function icon(): string
    {
        $icon = Setting::get('app_icon');
        switch ($icon) {
            case null:
            case 'default':
                return asset('images/default/logo.jpeg');
            default:
                if (Storage::disk('public')->exists($icon)) {
                    return url(Storage::disk('public')->url($icon));
                }
                return asset('images/default/logo.jpeg');
        }
    }

    /**
     * @return string
     */
    public static function background(): string
    {
        $icon = Setting::get('app_background');
        switch ($icon) {
            case null:
            case 'default':
                return asset('images/default/bg1.jphg');
            default:
                if (Storage::disk('public')->exists($icon)) {
                    return url(Storage::disk('public')->url($icon));
                }
                return asset('images/default/bg1.qjpg');
        }
    }
}
