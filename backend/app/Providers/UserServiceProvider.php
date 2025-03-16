<?php

namespace App\Providers;

use App\Interpreters\User\UserFilterInterpreter;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public $bindings = [
        \App\Services\User\UserServiceInterface::class => \App\Services\User\UserService::class,
        \App\Repositories\User\UserRepositoryInterface::class => \App\Repositories\User\UserRepository::class,
        \App\Adapters\User\UserAdapterInterface::class => \App\Adapters\User\UserAdapter::class,
        \App\Adapters\User\UserFilterAdapterInterface::class => \App\Adapters\User\UserFilterAdapter::class,
    ];

    public function register()
    {
        $this->app->bind(UserFilterInterpreter::class, function ($app) {
            return new UserFilterInterpreter();
        });
    }
}
