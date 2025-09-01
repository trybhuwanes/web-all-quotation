<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PortalController extends Controller
{
    //
    public function translations()
    {
        $lang    = config('app.locale');
        $strings = Cache::rememberForever('lang_' . $lang . '.js', function () use ($lang) {
            $files = [
                base_path('lang/' . $lang . '/menu.php'),
                base_path('lang/' . $lang . '/common.php'),
                base_path('lang/' . $lang . '/fields.php'),
                base_path('lang/' . $lang . '/notification.php'),
                base_path('lang/' . $lang . '/validation.php'),
                base_path('lang/' . $lang . '/menu.php'),
            ];
            $strings = [];

            foreach ($files as $file) {
                $name           = basename($file, '.php');
                $strings[$name] = require $file;
            }

            return $strings;
        });
        header('Content-Type: text/javascript');
        'window.i18n = ' . json_encode($strings) . ';';
        echo 'window.i18n = ' . json_encode($strings) . ';';
        exit();
    }
}
