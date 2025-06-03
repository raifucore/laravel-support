<?php

namespace RaifuCore\Support;

use Illuminate\Support\Facades\Context;
use Illuminate\Support\Str;
use RaifuCore\Support\Services\Layout\Layout;

class RaifuCoreServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Layout::class, static function () {
            return new Layout;
        });
    }

    public function boot(): void
    {
        Context::add('_rc_start_microtime', microtime(1));
        Context::add('_rc_trace_id', Str::uuid()->toString());
        Context::add('_rc_url', request()->url());

        $this->_loadLang();
        $this->_loadViews();
    }

    private function _loadLang(): void
    {
        $langPath = __DIR__ . '/../resources/lang';

        // Load
        $this->loadTranslationsFrom($langPath, 'raifucore');

        // Publish
        $this->publishes([
            $langPath => resource_path('lang/vendor/raifucore'),
        ], 'lang');
    }

    private function _loadViews(): void
    {
        $viewsPath = __DIR__ . '/../resources/views';

        // Load
        $this->loadViewsFrom($viewsPath, 'raifucore');

        // Publish
        $this->publishes([
            $viewsPath => resource_path('views/vendor/raifucore'),
        ], 'views');
    }
}
