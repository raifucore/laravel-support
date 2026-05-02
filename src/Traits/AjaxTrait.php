<?php

namespace RaifuCore\Support\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

trait AjaxTrait
{
    protected array $ajaxVars = [
        'status' => true,
        'error' => null,
        'message' => null
    ];

    /**
     * @throws Exception
     */
    protected function ajaxRequired(?Request $request = null): void
    {
        $request = $request ?? request();
        if (!$request->ajax()) {
            throw new Exception('Ajax required');
        }
    }

    protected function ajaxResponseJson(array $data = [], int $code = 200): JsonResponse
    {
        return response()
            ->json($data ?: array_filter($this->ajaxVars, fn($v) => $v !== null))
            ->setStatusCode($code)
            ->header('Content-Type', 'application/json');
    }

    protected function ajaxResponseSuccess(string $message = null, int $code = 200): JsonResponse
    {
        $this->ajaxVars['status'] = true;
        $this->ajaxVars['message'] = $message;

        return $this->ajaxResponseJson(code: $code);
    }

    protected function ajaxResponseError(string $error, int $code = 400): JsonResponse
    {
        $this->ajaxVars['status'] = false;
        $this->ajaxVars['error'] = $error;

        return $this->ajaxResponseJson(code: $code);
    }

    protected function ajaxResponseException(Throwable $e, bool $withLog = true): JsonResponse
    {
        $shortError = $e->getMessage() ?: get_class($e);

        $parts = [];
        $parts[] = $shortError;

        if ($e->getFile()) {
            $parts[] = 'in ' . $e->getFile();
        }

        if ($e->getLine()) {
            $parts[] = '(line ' . $e->getLine() . ')';
        }

        $error = implode(' ', $parts);

        if ($withLog) {
            Log::error($error);
        }

        return $this->ajaxResponseError($shortError);
    }
}
