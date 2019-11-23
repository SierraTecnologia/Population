<?php
/**
 * Nao é usado 
 */

namespace Siravel\Providers\Exemplos;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 *
 * @package Siravel\Providers
 */
class HomeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPackageServices();

        $this->registerLibServices();

        $this->registerAppServices();

        $this->registerApiV1Services();
    }

    /**
     * Register "package" services.
     *
     * @return void
     */
    protected function registerPackageServices(): void
    {
        $this->app->bind(
            \GuzzleHttp\ClientInterface::class,
            \GuzzleHttp\Client::class
        );

        $this->app->bind(
            \Imagine\Image\ImagineInterface::class,
            \Imagine\Imagick\Imagine::class
        );

        $this->app->singleton('HTMLPurifier', function (Application $app) {
            $filesystem = $app->make('filesystem')->disk('local');
            $cacheDirectory = 'cache/HTMLPurifier_DefinitionCache';
            if (!$filesystem->exists($cacheDirectory)) {
                $filesystem->makeDirectory($cacheDirectory);
            }
            $config = \HTMLPurifier_Config::createDefault();
            $config->set('Cache.SerializerPath', storage_path("app/{$cacheDirectory}"));
            return new \HTMLPurifier($config);
        });
    }

    /**
     * Register "lib" services.
     *
     * @return void
     */
    protected function registerLibServices(): void
    {
        $this->app->bind(
            \SiObject\Mount\Rss\Contracts\Builder::class,
            \SiObject\Mount\Rss\Builder::class
        );

        $this->app->bind(
            \SiObject\Mount\SiteMap\Contracts\Builder::class,
            \SiObject\Mount\SiteMap\Builder::class
        );
    }

    /**
     * Register "app" services.
     *
     * @return void
     */
    protected function registerAppServices(): void
    {
        $this->app->bind(
            \Core\Contracts\LocationManager::class,
            \SiObject\Manipule\Managers\Location\ARLocationManager::class
        );

        $this->app->bind(
            \Core\Contracts\PostManager::class,
            \SiObject\Manipule\Managers\Post\ARPostManager::class
        );

        $this->app->bind(
            \Core\Contracts\PhotoManager::class,
            \SiObject\Manipule\Managers\Photo\ARPhotoManager::class
        );

        $this->app->bind(
            \Core\Contracts\SubscriptionManager::class,
            \SiObject\Manipule\Managers\Subscription\ARSubscriptionManager::class
        );

        $this->app->bind(
            \Core\Contracts\TagManager::class,
            \SiObject\Manipule\Managers\Tag\ARTagManager::class
        );

        $this->app->bind(
            \Core\Contracts\UserManager::class,
            \SiObject\Manipule\Managers\User\ARUserManager::class
        );

        $this->app->bind(
            \SiFinder\Services\Image\Contracts\ImageProcessor::class,
            \SiFinder\Services\Image\ImagineImageProcessor::class
        );

        $this->app->when(\SiFinder\Services\Image\ImagineImageProcessor::class)
            ->needs('$config')
            ->give(function (Application $app) {
                return [
                    'thumbnails' => $app->make('config')->get('main.photo.thumbnails'),
                ];
            });

        $this->app->bind(
            \Siravel\Services\Writelabel\Manifest\Contracts\Manifest::class,
            \Siravel\Services\Writelabel\Manifest\AppManifest::class
        );

        $this->app->bind(
            \Siravel\Services\Writelabel\SiteMap\Contracts\SiteMapBuilder::class,
            \Siravel\Services\Writelabel\SiteMap\AppSiteMapBuilder::class
        );

        $this->app->bind(
            \Siravel\Services\Writelabel\Rss\Contracts\RssBuilder::class,
            \Siravel\Services\Writelabel\Rss\AppRssBuilder::class
        );

        $this->app->bind(
            \SiObject\Manipule\Rules\ReCaptchaRule::class,
            function () {
                return new \SiObject\Manipule\Rules\ReCaptchaRule(env('GOOGLE_RECAPTCHA_SECRET_KEY'));
            }
        );
    }

    /**
     * Register "api.v1" services.
     *
     * @return void
     */
    protected function registerApiV1Services(): void
    {
        $this->app->bind(
            \SiObject\Http\Proxy\Contracts\OAuthProxy::class,
            \SiObject\Http\Proxy\CookieOAuthProxy::class
        );
    }
}
