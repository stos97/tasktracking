<?php

namespace App\Providers;

use App\Checklist;
use App\Policies\ChecklistPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use App\Project;
use App\Task;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Project::class   => ProjectPolicy::class,
        Checklist::class => ChecklistPolicy::class,
        Task::class      => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
