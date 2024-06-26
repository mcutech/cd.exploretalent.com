<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Application Debug Mode
  |--------------------------------------------------------------------------
  |
  | When your application is in debug mode, detailed error messages with
  | stack traces will be shown on every error that occurs within your
  | application. If disabled, a simple generic error page is shown.
  |
   */

    'debug' => true,

  /*
  |--------------------------------------------------------------------------
  | Application URL
  |--------------------------------------------------------------------------
  |
  | This URL is used by the console to properly generate URLs when using
  | the Artisan command line tool. You should set this to the root of
  | your application so that it is used when running Artisan tasks.
  |
   */

    'url' => 'http://localhost',

  /*
  |--------------------------------------------------------------------------
  | Application Timezone
  |--------------------------------------------------------------------------
  |
  | Here you may specify the default timezone for your application, which
  | will be used by the PHP date and date-time functions. We have gone
  | ahead and set this to a sensible default for you out of the box.
  |
   */

    'timezone' => 'UTC',

  /*
  |--------------------------------------------------------------------------
  | Application Locale Configuration
  |--------------------------------------------------------------------------
  |
  | The application locale determines the default locale that will be used
  | by the translation service provider. You are free to set this value
  | to any of the locales which will be supported by the application.
  |
   */

    'locale' => 'en',

  /*
  |--------------------------------------------------------------------------
  | Application Fallback Locale
  |--------------------------------------------------------------------------
  |
  | The fallback locale determines the locale to use when the current one
  | is not available. You may change the value to correspond to any of
  | the language folders that are provided through your application.
  |
   */

    'fallback_locale' => 'en',

  /*
  |--------------------------------------------------------------------------
  | Encryption Key
  |--------------------------------------------------------------------------
  |
  | This key is used by the Illuminate encrypter service and should be set
  | to a random, 32 character string, otherwise these encrypted strings
  | will not be safe. Please do this before deploying an application!
  |
   */

    'key' => env('APP_KEY', 'SomeRandomString'),

    'cipher' => MCRYPT_RIJNDAEL_128,

  /*
  |--------------------------------------------------------------------------
  | Logging Configuration
  |--------------------------------------------------------------------------
  |
  | Here you may configure the log settings for your application. Out of
  | the box, Laravel uses the Monolog PHP logging library. This gives
  | you a variety of powerful log handlers / formatters to utilize.
  |
  | Available Settings: "single", "daily", "syslog", "errorlog"
  |
   */

    'log' => 'daily',

  /*
  |--------------------------------------------------------------------------
  | Autoloaded Service Providers
  |--------------------------------------------------------------------------
  |
  | The service providers listed here will be automatically loaded on the
  | request to your application. Feel free to add your own services to
  | this array to grant expanded functionality to your applications.
  |
   */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\ConfigServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

  /*
  |--------------------------------------------------------------------------
  | Class Aliases
  |--------------------------------------------------------------------------
  |
  | This array of class aliases will be registered when this application
  | is started. However, feel free to register as many as you wish as
  | the aliases are "lazy" loaded so they don't hinder performance.
  |
   */

    'aliases' => [

        'App'       => Illuminate\Support\Facades\App::class,
        'Artisan'   => Illuminate\Support\Facades\Artisan::class,
        'Blade'     => Illuminate\Support\Facades\Blade::class,
        'Config'    => Illuminate\Support\Facades\Config::class,
        'File'      => Illuminate\Support\Facades\File::class,
        'Input'     => Illuminate\Support\Facades\Input::class,
        'Log'       => Illuminate\Support\Facades\Log::class,
        'Redirect'  => Illuminate\Support\Facades\Redirect::class,
        'Request'   => Illuminate\Support\Facades\Request::class,
        'Response'  => Illuminate\Support\Facades\Response::class,
        'Route'     => Illuminate\Support\Facades\Route::class,
        'URL'       => Illuminate\Support\Facades\URL::class,
        'View'      => Illuminate\Support\Facades\View::class,

    ],

];
