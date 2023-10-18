<?php

namespace App\Providers;

use App\Repositories\Contract\EvaluationRepositoryContract;
use App\Repositories\Contract\ProfileRepositoryContract;
use App\Repositories\Contract\UserRepositoryContract;
use App\Repositories\EvaluationRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $repositories = [
        UserRepositoryContract::class => UserRepository::class,
        ProfileRepositoryContract::class => ProfileRepository::class,
        EvaluationRepositoryContract::class => EvaluationRepository::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Bind the repositories.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $contract => $class) {
            $this->app->bind($contract, $class);
        }
    }
}
