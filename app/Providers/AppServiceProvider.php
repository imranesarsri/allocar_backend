<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        $this->loadMigrationsFrom($this->getMigrationPaths());
    }

    /**
     * Get all migration paths.
     *
     * @return array
     */
    protected function getMigrationPaths(): array
    {
        $migrationsPath = database_path('migrations');
        return $this->getAllSubdirectoriesOptimized($migrationsPath);
    }

    /**
     * Get all subdirectories.
     *
     * @param string $dir
     * @return array
     */
    protected function getAllSubdirectoriesOptimized(string $dir): array
    {
        $subdirectories = [];
        $items = scandir($dir);

        foreach ($items as $item) {
            if ($item !== '.' && $item !== '..') {
                $path = $dir . DIRECTORY_SEPARATOR . $item;
                if (is_dir($path)) {
                    $subdirectories[] = $path;
                    $subdirectories = array_merge($subdirectories, $this->getAllSubdirectoriesOptimized($path));
                }
            }
        }

        return $subdirectories;
    }
}
