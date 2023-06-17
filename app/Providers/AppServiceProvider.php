<?php

namespace App\Providers;

use App\Repositories\Task\TaskInterface;
use App\Services\Contracts\AttachmentInterface;
use App\Services\Contracts\CollaborationInterface;
use App\Services\Contracts\UserInterface;
use App\Services\Services\AttachmentService;
use App\Services\Services\CollaborationService;
use App\Services\Services\TaskService;
use App\Services\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(UserInterface::class,UserService::class);
//        $this->app->bind(TaskInterface::class,TaskService::class);
        $this->app->bind(CollaborationInterface::class,CollaborationService::class);
        $this->app->bind(AttachmentInterface::class,AttachmentService::class);


        $this->app->bind('UserService',function (){
            return new UserService();
        });

        $this->app->bind('TaskService',function (){
            return new TaskService();
        });

        $this->app->bind('CollaborationService',function (){
            return new CollaborationService();
        });

        $this->app->bind('AttachmentService',function (){
            return new AttachmentService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
