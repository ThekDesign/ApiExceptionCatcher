<?php

namespace ThekDesign\ApiExceptionCatcher;

use App\Exceptions\Handler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ExceptionProvider extends ServiceProvider
{
    protected $exception;

    public function __construct(Application $app) {

        $this->exception = new Handler(app());

        parent::__construct($app);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app('Dingo\Api\Exception\Handler')->register(function (
            \Exception $exception
        ) {
            $this->exception->report($exception);

            return $this->exception->render(request(), $exception);
        });
    }
}
