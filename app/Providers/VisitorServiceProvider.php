<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Weboap\Visitor\VisitorServiceProvider as VS;
use App\Services\Course\Services\CourseVisitorService;
use App\Services\Course\Interfaces\CourseVisitorServiceInterface;

class VisitorServiceProvider extends VS
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 服务注册
        parent::register();
    }
    public function RegisterVisitor()
    {
        $this->app->singleton('visitor', function ($app) {
            return new CourseVisitorService(
                $app['Weboap\Visitor\Storage\VisitorInterface'],
                $app['Weboap\Visitor\Services\Geo\GeoInterface'],
                $app['ip'],
                $app['Weboap\Visitor\Services\Cache\CacheInterface']
            );
        });

        $this->app->bind(CourseVisitorService::class, function ($app) {
            return $app['visitor'];
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
