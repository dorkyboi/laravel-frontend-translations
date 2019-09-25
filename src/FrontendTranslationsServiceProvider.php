<?php
namespace Dorkyboi\FrontendTranslations;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class FrontendTranslationsServiceProvider extends ServiceProvider
{
    /**
     * Path to current lang files
     *
     * @var string
     */
    protected $path;
    
    public function __construct($app)
    {
        parent::__construct($app);
        $this->path = resource_path('lang/' . app()->getLocale());
    }
    
    /**
     * Publishes configuration file.
     *
     * @return  void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . './translator.js' => public_path('js')
        ], 'translator');
    }

    /**
     * Make config publishment optional by merging the config from the package.
     *
     * @return  void
     */
    public function register()
    {
        Cache::rememberForever('translations', function () {
            return collect(File::allFiles($this->path))->flatMap(function ($file) {
                return [
                    ($translation = $file->getBasename('.php')) => trans($translation),
                ];
            })->toJson();
        });
    
        Blade::directive('frontendTranslations', function () {
            return "<script>window.translations = {!! Cache::get('translations') !!};</script><script src=\"/js/translator.js\"></script>";
        });
    }
}
