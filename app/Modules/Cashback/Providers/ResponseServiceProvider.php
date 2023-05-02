<?php

namespace App\Modules\Cashback\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->descriptiveResponseMethods();
    }

    protected function descriptiveResponseMethods()
    {
        $instance = $this;
        Response::macro('ok', function ($data = []) {
            return Response::json(['data' => $data], 200);
        });

        Response::macro('created', function ($message = 'Successfully Created', $data = []) {
            if (count($data)) {
                return Response::json(['message' => $message, 'data' => $data], 201);
            }

            return Response::json(['message' => $message], 201);
        });

        Response::macro('noContent', function ($data = []) {
            return Response::json([], 204);
        });

        Response::macro('badRequest', function ($message = 'Validation Failure.', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 400);
        });

        Response::macro('unauthorized', function ($message = 'User unauthorized', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 401);
        });

        Response::macro('forbidden', function ($message = 'Access denied', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 403);
        });

        Response::macro('notFound', function ($message = 'Resource not found.', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 404);
        });

        Response::macro('conflict', function ($message = 'Request could not be completed due to a conflict with the current state of the resource', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 409);
        });

        Response::macro('validationError', function ($message = 'Validation Error.', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 422);
        });

        Response::macro('internalServerError', function ($message = 'Internal Server Error.', $errors = []) use ($instance) {
            return $instance->handleErrorResponse($message, $errors, 500);
        });
    }

    public function handleErrorResponse($message, $errors, $status)
    {
        $response = [
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return Response::json($response, $status);
    }
}
