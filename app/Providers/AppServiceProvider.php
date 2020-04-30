<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 添加自定义验证规则
        Validator::extend('phone', function ($attr, $value, $params, $validator) {
            $reg = '/^\+86-1[3-9]\d{9}$/';
            $reg2 = '/^1[3-9]\d{9}$/';
            return preg_match($reg, $value) || preg_match($reg2, $value);
        });
    }
}
