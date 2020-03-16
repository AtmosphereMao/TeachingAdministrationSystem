<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Providers;

use Carbon\Carbon;
use App\Meedu\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\Base\Providers\BaseServiceRegisterProvider;
use App\Services\Order\Providers\OrderServiceRegisterProvider;
use App\Services\Other\Providers\OtherServiceRegisterProvider;
use App\Services\Course\Providers\CourseServiceRegisterProvider;
use App\Services\Member\Providers\MemberServiceRegisterProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // 数据库
        Schema::defaultStringLength(191);
        // 自定义配置同步
        $this->app->make(Setting::class)->sync();
        // 多模板注册
        $this->registerViewNamespace();
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->environment(['dev', 'local'])) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        // 服务注册
        $this->app->register(BaseServiceRegisterProvider::class);
        $this->app->register(MemberServiceRegisterProvider::class);
        $this->app->register(CourseServiceRegisterProvider::class);
        $this->app->register(OtherServiceRegisterProvider::class);
        $this->app->register(OrderServiceRegisterProvider::class);
    }

    /**
     * 注册视图.
     */
    protected function registerViewNamespace()
    {
        $this->loadViewsFrom(config('meedu.system.theme.path'), config('meedu.system.theme.use'));
    }
}
