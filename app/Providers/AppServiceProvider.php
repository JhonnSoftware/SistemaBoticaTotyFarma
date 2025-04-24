<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;

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
        View::composer('layouts.plantilla', function ($view) {
            // Obtener las notificaciones no leídas
            $notificaciones = Notification::where('is_read', false)->get();
            // Pasar las notificaciones a la vista plantilla
            $view->with('notificaciones', $notificaciones);
        });
    }
}
