<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\ProjectInterface;
use App\Contracts\TaskInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Services\RegisterService;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private bool $registered = false;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);
        $this->app->bind(TaskInterface::class, TaskRepository::class);

        $this->app->bind(Client::class, function () {
            $cookieJar = new CookieJar();
            $cookieJar->setCookie(new \GuzzleHttp\Cookie\SetCookie([
                'BITRIX_SM_TZ' => 'Asia/Singapore',
            ]));

            return new Client([
                'base_uri' => 'https://syntactics.bitrix24.com/rest/29/pu2m3yb4epvrdw95/',
                'cookies' => $cookieJar,
            ]);
        });

        if (! $this->registered) {
            $this->app->singleton(RegisterService::class, function ($app) {
                $httpClient = new Client();

                return new RegisterService($httpClient);
            });

            $this->app->booting(
                function (): void {
                    $this->app->make(RegisterService::class)->registerService();
                }
            );

            $this->registered = true;
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());
    }
}
