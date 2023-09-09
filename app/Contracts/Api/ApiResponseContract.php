<?php

namespace App\Contracts\Api;

interface ApiResponseContract
{
    /**
     * @return mixed
     */
    public function json(int $status = 200, string $message, $data = [], array $headers = [], $options = 0);

    /**
     * @return mixed
     */
    public function xml(int $httpStatus, array|object $payload);
}