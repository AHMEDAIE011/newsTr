<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $getSetting = Setting::firstOr(function(){
        return Setting::create([
            'site_name'=>'NKM',
            'logo'=>'/img/logo.png',
            'favicon'=>'default',
            'email'=>'NKM@gmail.com',
            'facebook'=>'https://www.facebook.com/',
            'twitter'=>'https://www.twitter.com/',
            'insagram'=>'https://www.instagram.com/',
            'youtupe'=>'https://www.youtupe.com/',
            'country'=>'Egypt',
            'city'=>' New Cairo',
            'street'=>'El Banafseg 8, 153 Al Sadat Axis , village 175',
            'phone'=>'01222333434',
            'small_desc'=>'23 of PARAGE is equality of condition, blood, or dignity; specifically : equality between persons (as brothers) one of whom holds a part of a fee ',
        ]);
    });

    $getSetting->whatsapp = "https://wa.me/".$getSetting->phone;
    view()->share([
        'getSetting'=>$getSetting,
    ]);
    }
}
