<?php

declare(strict_types=1);

namespace NNovosad19\AISolution\Providers;

use NNovosad19\AISolition\Providers\AISolutionProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;
use Spatie\ErrorSolutions\Contracts\SolutionProviderRepository;

class AISolutionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('ai-solution.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'ai-solution'
        );

        $this->app->bind(ClientInterface::class, Client::class);

        app(SolutionProviderRepository::class)
            ->registerSolutionProvider(AISolutionProvider::class);
    }
}