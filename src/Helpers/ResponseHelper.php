<?php

namespace RaifuCore\Support\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RaifuCore\Support\Exceptions\BaseException;
use Throwable;

class ResponseHelper
{
    public static function exception(Throwable $e): JsonResponse
    {
        return self::error($e->getCode(), $e->getMessage(), $e);
    }

    public static function exceptionWithLogAndError(Throwable $e, string $error, int $code = 400): JsonResponse
    {
        $parts = [
            $e->getMessage() ?: get_class($e)
        ];

        if ($e->getFile()) {
            $parts[] = 'in ' . $e->getFile();
        }

        if ($e->getLine()) {
            $parts[] = '(line ' . $e->getLine() . ')';
        }

        Log::error(implode(' ', $parts));

        return self::error($code, $error);
    }

    public static function error(int|string $code, string $error, ?Throwable $ex = null): JsonResponse
    {
        $response = [
            'status' => false,
            'error' => $error,
        ];

        if ($ex) {
            $response['ex'] = get_class($ex);
        }

        if ($ex instanceof BaseException && $ex->getData()) {
            $response['data'] = $ex->getData();
        }

        if ($ex instanceof ValidationException) {
            $firstError = null;
            $errors = [];
            foreach ($ex->errors() ?: [] as $field => $error) {
                $firstError = $firstError ?? $error[0];
                $errors[$field] = $error;
            }
            $response['error'] = $firstError ?? 'One or more fields contain errors';
            $response['errors'] = $errors;
        }

        $code = is_numeric($code) && $code >= 100 && $code < 600
            ? $code
            : 400;

        return response()
            ->json($response)
            ->setStatusCode($code)
            ->header('Content-Type', 'application/json');
    }

    public static function success(?array $data = null, ?string $message = null, ?int $code = null): JsonResponse
    {
        $code = $code ?? 200;
        $response = [
            'status' => true,
        ];

        if (!is_null($message)) {
            $response['message'] = $message;
        }

        return response()
            ->json(array_merge($response, $data ?? []))
            ->setStatusCode($code)
            ->header('Content-Type', 'application/json');
    }
}
