<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SuccessfulEmailRepositoryInterface;
use App\Repositories\SuccessfulEmailRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(SuccessfulEmailRepositoryInterface::class, SuccessfulEmailRepository::class);
    }
}
