<?php

namespace LarsKlopstra\Envelop;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LarsKlopstra\Envelop\Atomic\Atomic;

class EnvelopServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Atomic::class, fn () => new Atomic);
    }

    public function boot(): void
    {
        Blade::componentNamespace('LarsKlopstra\\Envelop\\Components', 'envelop');
    }
}
