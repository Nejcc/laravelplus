<?php

namespace App\Helpers\Api;

use App\Contracts\Api\ApiResponseContract;
use http\Client\Response;

final class ApiResponse implements ApiResponseContract
{

    public function json($status = 200, string $message, $data = [], array $headers = [], $options = 0) : Response
    {
        return response()->json($this->getPayload($data, $status, $message), $status, $headers, $options);
    }

    public function xml(int $httpStatus, object|array $payload)
    {
        // TODO: Implement xml() method.
    }

    /**
     * @param mixed $data
     * @param mixed $status
     * @param string $message
     * @return array
     */
    private function getPayload(mixed $data, mixed $status, string $message): array
    {
        return [
            $data,
            'status' => $status,
            'msg'    => $message,
        ];
    }
}