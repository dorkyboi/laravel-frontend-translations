# Frontend javascript translations for Laravel projects

## Installing

1. Get this package with `composer require dorkyboi/laravel-frontend-translations`
2. Publish `translator.js` file to your public folder by running `php artisan vendor:publish --tag=translator`
3. Add `@frontendTranslations` blade directive to your master blade. This will add code that will load cached copy of laravel's translation files:
   ```blade
   <script>
       window.translations = {!! Cache::get('translations') !!};
   </script>
   <script src="/js/translator.js"></script>
   ```
   
## Usage
Use translation function in the same way as you use `__()` function, 
e.g. `translate('auth.failed')`
